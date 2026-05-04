<?php
// Standalone one-shot maintenance script.
// Re-runs the same sanitizer used by AdminController::sanitizeTraduzione
// against existing traduzioni_pagine rows. Dry-run by default; pass --apply to write.
// On --apply, writes a per-row UPDATE backup SQL file before touching anything.
//
// Usage:
//   php tools/sanitize-traduzioni.php                      # dry-run, prints before/after
//   php tools/sanitize-traduzioni.php --apply              # backup + UPDATE
//   php tools/sanitize-traduzioni.php --revert <file.sql>  # restore from backup

$envPath = __DIR__ . '/../.env';
if (!is_file($envPath)) { fwrite(STDERR, "Missing .env\n"); exit(1); }
$env = [];
foreach (file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
    if ($line[0] === '#' || !str_contains($line, '=')) continue;
    [$k, $v] = array_map('trim', explode('=', $line, 2));
    $env[$k] = trim($v, "\"'");
}

$dsn  = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
    $env['DB_HOST'], $env['DB_PORT'] ?? 3306, $env['DB_DATABASE']);
$pdo  = new PDO($dsn, $env['DB_USERNAME'], $env['DB_PASSWORD'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

function sanitizeTraduzione(?string $html): ?string
{
    if ($html === null || $html === '') return $html;
    $allowed = '<br><b><strong><i><em><u><a>';
    $clean   = strip_tags($html, $allowed);
    $clean = preg_replace_callback(
        '/<([a-zA-Z]+)\b([^>]*)>/',
        function ($m) {
            $tag = strtolower($m[1]);
            if ($tag === 'a') {
                $attrs = '';
                if (preg_match('/\bhref\s*=\s*"([^"]*)"/i', $m[2], $hm)
                    && preg_match('#^(https?:|mailto:|tel:|/|\#)#i', $hm[1])) {
                    $href = htmlspecialchars($hm[1], ENT_QUOTES, 'UTF-8');
                    $attrs .= " href=\"{$href}\"";
                }
                if (preg_match('/\btarget\s*=\s*"([^"]*)"/i', $m[2], $tm)) {
                    $target = htmlspecialchars($tm[1], ENT_QUOTES, 'UTF-8');
                    $attrs .= " target=\"{$target}\"";
                }
                return "<a{$attrs}>";
            }
            return "<{$tag}>";
        },
        $clean
    );
    $clean = preg_replace('#<br\s*/?>#i', '<br>', $clean);
    $clean = preg_replace('/\r\n?/', "\n", $clean);
    $clean = str_replace("\n", '<br>', $clean);
    $clean = preg_replace('#(<br>){3,}#', '<br><br>', $clean);
    $clean = preg_replace('/[ \t]+/', ' ', $clean);
    return trim($clean);
}

// ─── Revert mode ────────────────────────────────────────────────────────────
$revertIdx = array_search('--revert', $argv, true);
if ($revertIdx !== false) {
    $file = $argv[$revertIdx + 1] ?? null;
    if (!$file || !is_file($file)) {
        fwrite(STDERR, "Usage: php tools/sanitize-traduzioni.php --revert <backup-file.sql>\n");
        exit(1);
    }
    $sql = file_get_contents($file);
    // Split on lines ending with ; that start an UPDATE — naive but safe for our generated file
    $statements = array_filter(array_map('trim', preg_split('/;\s*\n/', $sql)));
    $pdo->beginTransaction();
    $count = 0;
    try {
        foreach ($statements as $stmt) {
            if (stripos($stmt, 'UPDATE') !== 0) continue;
            $pdo->exec($stmt);
            $count++;
        }
        $pdo->commit();
    } catch (Throwable $e) {
        $pdo->rollBack();
        fwrite(STDERR, "Revert FAILED, rolled back: " . $e->getMessage() . "\n");
        exit(1);
    }
    echo "Reverted $count row(s) from $file\n";
    exit(0);
}

// ─── Dry-run / apply mode ───────────────────────────────────────────────────
$apply = in_array('--apply', $argv, true);
$rows  = $pdo->query("SELECT id, pagina, chiave, it, en, es FROM traduzioni_pagine")->fetchAll(PDO::FETCH_ASSOC);

$changedRows = []; // [{r, newIt, newEn, newEs}]
foreach ($rows as $r) {
    $newIt = sanitizeTraduzione($r['it']);
    $newEn = sanitizeTraduzione($r['en']);
    $newEs = sanitizeTraduzione($r['es']);
    $diff  = ($newIt !== $r['it']) || ($newEn !== $r['en']) || ($newEs !== $r['es']);
    if (!$diff) continue;

    $changedRows[] = ['r' => $r, 'newIt' => $newIt, 'newEn' => $newEn, 'newEs' => $newEs];

    echo "─────────────────────────────────────────────────────\n";
    echo "id={$r['id']}  {$r['pagina']} / {$r['chiave']}\n";
    foreach (['it', 'en', 'es'] as $loc) {
        $before = $r[$loc] ?? '';
        $after  = ${"new" . ucfirst($loc)} ?? '';
        if ($before !== $after) {
            echo "  [{$loc}] BEFORE (" . strlen($before) . " chars):\n" . $before . "\n";
            echo "  [{$loc}] AFTER  (" . strlen($after)  . " chars):\n" . $after  . "\n";
        }
    }
}

$changed = count($changedRows);
echo "─────────────────────────────────────────────────────\n";

if (!$apply) {
    echo "DRY-RUN — would change $changed row(s).\n";
    if ($changed > 0) echo "Re-run with --apply to write changes.\n";
    exit(0);
}

if ($changed === 0) {
    echo "Nothing to apply.\n";
    exit(0);
}

// Write backup BEFORE applying — per-row UPDATEs that restore the original it/en/es values
$stamp      = date('Ymd-His');
$backupPath = __DIR__ . '/backup-traduzioni-' . $stamp . '.sql';
$backup     = "-- Backup of traduzioni_pagine rows BEFORE sanitizer apply at " . date('c') . "\n";
$backup    .= "-- " . count($changedRows) . " row(s). Restore by running:\n";
$backup    .= "--   php tools/sanitize-traduzioni.php --revert " . basename($backupPath) . "\n\n";
$backup    .= "START TRANSACTION;\n";
foreach ($changedRows as $row) {
    $r = $row['r'];
    $backup .= sprintf(
        "UPDATE traduzioni_pagine SET it = %s, en = %s, es = %s WHERE id = %d;\n",
        $pdo->quote($r['it'] ?? ''),
        $pdo->quote($r['en'] ?? ''),
        $pdo->quote($r['es'] ?? ''),
        (int) $r['id']
    );
}
$backup .= "COMMIT;\n";
if (file_put_contents($backupPath, $backup) === false) {
    fwrite(STDERR, "Failed to write backup file at $backupPath — aborting apply.\n");
    exit(1);
}
echo "Backup written: $backupPath  (" . strlen($backup) . " bytes)\n";

// Now apply, all-or-nothing
$update = $pdo->prepare("UPDATE traduzioni_pagine SET it = :it, en = :en, es = :es WHERE id = :id");
$pdo->beginTransaction();
try {
    foreach ($changedRows as $row) {
        $update->execute([
            ':id' => $row['r']['id'],
            ':it' => $row['newIt'],
            ':en' => $row['newEn'],
            ':es' => $row['newEs'],
        ]);
    }
    $pdo->commit();
} catch (Throwable $e) {
    $pdo->rollBack();
    fwrite(STDERR, "Apply FAILED, rolled back: " . $e->getMessage() . "\n");
    fwrite(STDERR, "DB state is unchanged. Backup file is still at $backupPath\n");
    exit(1);
}

echo "APPLIED: $changed row(s) updated.\n";
echo "To revert: php tools/sanitize-traduzioni.php --revert " . $backupPath . "\n";
