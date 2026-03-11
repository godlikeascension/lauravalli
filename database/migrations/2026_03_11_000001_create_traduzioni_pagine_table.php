<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('traduzioni_pagine', function (Blueprint $table) {
            $table->id();
            $table->string('pagina', 50);
            $table->string('chiave', 100);
            $table->text('it')->nullable();
            $table->text('en')->nullable();
            $table->text('es')->nullable();
            $table->timestamps();
            $table->unique(['pagina', 'chiave']);
        });

        $now = now();
        $rows = [];

        $add = function (string $pagina, string $chiave, string $it) use (&$rows, $now) {
            $rows[] = [
                'pagina'     => $pagina,
                'chiave'     => $chiave,
                'it'         => $it,
                'en'         => null,
                'es'         => null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        };

        // ── NAVBAR ────────────────────────────────────────────────────────────
        $add('navbar', 'home',         'Home');
        $add('navbar', 'opere',        'Opere');
        $add('navbar', 'commissioni',  'Commissioni');
        $add('navbar', 'gift_card',    "Regala un'opera");
        $add('navbar', 'chi_sono',     'Chi Sono');

        // ── HOMEPAGE ──────────────────────────────────────────────────────────
        $add('home', 'hero_titolo',      'Sono le imperfezioni a renderti unico');
        $add('home', 'hero_testo',       "Dipingo per dare voce a ciò che non sempre sappiamo comunicare a parole. Ogni quadro è un invito a guardarti dentro, a riconoscere le tue imperfezioni come la vera radice della tua unicità.");
        $add('home', 'hero_cta',         'Invia un messaggio');
        $add('home', 'bio_label',        'The Artist');
        $add('home', 'bio_titolo',       "Dipingo per dare voce all'animo umano");
        $add('home', 'bio_testo',        "Parlo della fragilità.<br><br>Non come debolezza,<br>ma come verità.<br>Come quella crepa che si apre nell'anima…<br>e finalmente lascia entrare la luce.<br><br>La fragilità non finge.<br>Non recita.<br>Non cerca approvazione.<br>È AUTENTICA. Nuda. Reale.<br><br>È lì che le maschere cadono.<br>È lì che scopriamo chi siamo davvero.<br><br>Siamo fatti di crepe.<br>Di cicatrici.<br>Di parti rotte che, invece di distruggerci,<br>ci ricompongono in forme nuove.<br>Più vere. Più armoniche.<br>Più nostre.<br><br>La fragilità non ci limita.<br>Ci libera.<br>È da lì che tutto comincia.<br>È da lì che rinasciamo.");
        $add('home', 'bio_citazione',    '"Il coraggio sta in ciò che ti permetti di manifestare con autenticità."');
        $add('home', 'bio_cta',          'Invia un messaggio');
        $add('home', 'collezione_titolo', 'Ultima Collezione');
        $add('home', 'collezione_vuota', 'Le opere della collezione verranno presto aggiornate.');
        $add('home', 'commissioni_label', 'Commissioni');
        $add('home', 'commissioni_titolo', "Trasforma un'emozione in un'opera che parla di te");
        $add('home', 'commissioni_testo', "Un dipinto su commissione è lo specchio della tua anima. Non importa se parti da un'immagine precisa o da un'emozione confusa: insieme possiamo trasformarla in un'opera autentica, fatta solo per te. Uno spazio che parla di chi sei, delle tue visioni, dei tuoi desideri.");
        $add('home', 'commissioni_cta',  'Invia un messaggio');
        $add('home', 'gift_card_label',  'Buono regalo');
        $add('home', 'gift_card_titolo', "Regala un'opera unica nata dal cuore");
        $add('home', 'gift_card_testo',  "E se il prossimo quadro non fosse per te… ma per qualcuno che ami? Con un buono regalo non doni solo un dipinto: regali un viaggio interiore. È la possibilità di trasformare un ricordo, un'emozione, un frammento di vita in un'opera unica. Un'esperienza da vivere, un riflesso autentico dell'anima… da custodire per sempre.");
        $add('home', 'gift_card_cta',    'Invia un messaggio');
        $add('home', 'opere_label',      'Le Opere');
        $add('home', 'opere_titolo',     "Ogni dipinto racconta una storia che aspetta di incontrare la tua");
        $add('home', 'opere_testo',      "Esplora le collezioni e lasciati guidare dalle emozioni. Ogni opera nasce da un momento vissuto, da un'emozione autentica, da un desiderio di lasciare un segno. Forse una di esse parla già di te.");
        $add('home', 'opere_cta',        'Esplora le opere');
        $add('home', 'form_label',       'Invia un messaggio');
        $add('home', 'form_titolo',      'Per qualsiasi domanda o richiesta, scrivimi. Sarò felice di ascoltarti.');

        // ── OPERE (collezioni-pubblica) ───────────────────────────────────────
        $add('opere', 'section_label',  'Le Opere');
        $add('opere', 'section_titolo', 'Esplora le Collezioni');

        // ── OPERA SINGOLA ─────────────────────────────────────────────────────
        $add('opera', 'commissione',  'Opera su commissione');
        $add('opera', 'altre_opere',  'Altre opere della collezione');

        // ── COMMISSIONI ───────────────────────────────────────────────────────
        $add('commissioni', 'hero_titolo',        'Opere su commissione.');
        $add('commissioni', 'hero_intro',         "Ogni opera su commissione è una storia da raccontare. La <strong>tua</strong> storia. Che tu abbia già in mente un'idea precisa o che tu parta solo da un'emozione, sarò felice di accompagnarti passo dopo passo nella creazione di un dipinto unico e personalizzato.<br><br><strong>Questa pagina è uno spazio dedicato a te.</strong>");
        $add('commissioni', 'come_funziona_label', 'Come funziona il lavoro su commissione');
        $add('commissioni', 'come_funziona_titolo', "Diamo vita a un'opera che nasce dal tuo sentire più autentico");
        $add('commissioni', 'step1_titolo',        'Consulenza gratuita');
        $add('commissioni', 'step1_testo',         "Il primo passo è entrare in connessione: inizieremo con una chiacchierata conoscitiva, dove mi racconterai ciò che vorresti esprimere, i colori che ti rappresentano, le emozioni da cui partire e le dimensioni del quadro. Andremo dunque a definire il budget e ti guiderò con cura nella tua proposta personalizzata.");
        $add('commissioni', 'step2_titolo',        'Scelta di ogni dettaglio');
        $add('commissioni', 'step2_testo',         "Prima di iniziare la commissione, riceverai un bozzetto digitale basato sulla tua ispirazione. Potrai darmi il tuo feedback e solo dopo la tua approvazione definitiva passeremo alla fase di pittura.");
        $add('commissioni', 'step3_titolo',        "Realizzazione dell'opera");
        $add('commissioni', 'step3_testo',         "Dopo l'approvazione del bozzetto, inizio la lavorazione del tuo quadro ad olio. Durante la realizzazione ti invierò aggiornamenti visivi, così potrai seguire la nascita della tua opera passo dopo passo. A questo punto non saranno possibili modifiche.");
        $add('commissioni', 'recensioni_label',    'Recensioni');
        $add('commissioni', 'recensioni_titolo',   'Cosa dicono di me');
        $add('commissioni', 'recensioni_vuote',    'Al momento non ci sono ancora recensioni visibili.');
        $add('commissioni', 'form_titolo',         'Pronto a iniziare?');
        $add('commissioni', 'form_sottotitolo',    'Compila il formulario di seguito, sarà un piacere accompagnarti in questo processo!');
        $add('commissioni', 'faq_label',           'Domande frequenti');
        $add('commissioni', 'faq_titolo',          'Se hai altre domande, non esitare a contattarmi');
        $add('commissioni', 'faq_vuote',           'Nessuna domanda frequente al momento.');
        $add('commissioni', 'label_trasmettere',   'Cosa ti piacerebbe che questa opera trasmettesse?');
        $add('commissioni', 'opt_forza',           'Forza e rinascita');
        $add('commissioni', 'opt_tenerezza',       'Tenerezza e dolcezza');
        $add('commissioni', 'opt_mistero',         'Mistero e introspezione');
        $add('commissioni', 'opt_non_so',          'Non lo so ancora');
        $add('commissioni', 'label_raffigurare',   'Cosa desideri che questa opera raffiguri?');
        $add('commissioni', 'opt_astratto',        'Un tema astratto');
        $add('commissioni', 'opt_ritratto_persona', 'Un ritratto di una persona');
        $add('commissioni', 'opt_ritratto_animale', 'Un ritratto di animale');
        $add('commissioni', 'opt_paesaggio',       'Un paesaggio');
        $add('commissioni', 'label_colori',        'Ci sono colori che vorresti predominassero?');
        $add('commissioni', 'opt_caldi',           'Tonalità calde e avvolgenti');
        $add('commissioni', 'opt_freddi',          'Colori freddi e profondi');
        $add('commissioni', 'opt_entrambi',        'Entrambi');
        $add('commissioni', 'label_destinazione',  "A chi è destinata quest'opera?");
        $add('commissioni', 'opt_me_stesso',       'A me stessa/o');
        $add('commissioni', 'opt_persona_cara',    'A una persona cara');
        $add('commissioni', 'opt_studio',          'Studio/lavoro');
        $add('commissioni', 'label_motivo',        "Cosa ti ha spinto a richiedere un'opera su misura?");
        $add('commissioni', 'opt_mi_rappresenti',  'Qualcosa che mi rappresenti');
        $add('commissioni', 'opt_significato',     'Significato profondo');
        $add('commissioni', 'opt_regalo',          'Regalo unico');
        $add('commissioni', 'opt_ispirato',        'Ispirato dal tuo lavoro');
        $add('commissioni', 'opt_impulso',         'Impulso');
        $add('commissioni', 'label_messaggio',     'Vuoi aggiungere qualcosa? (opzionale)');
        $add('commissioni', 'placeholder_messaggio', "Raccontami la tua idea, un ricordo, un'emozione… ogni dettaglio mi aiuta a creare qualcosa di davvero tuo.");

        // ── GIFT CARD ─────────────────────────────────────────────────────────
        $add('gift_card', 'hero_titolo',          'Il regalo perfetto è quello che si sceglie col cuore.');
        $add('gift_card', 'hero_citazione',       'Sorprendi chi ami con un dono che sceglierà da sé.');
        $add('gift_card', 'hero_intro',           "Con una gift card puoi donare a chi ami l'esperienza di avere un'opera d'arte creata su misura, oppure permettergli di scegliere tra le opere già disponibili nella mia galleria o sul sito web.");
        $add('gift_card', 'hero_btn',             'Scopri come funziona');
        $add('gift_card', 'come_funziona_label',  'Come funziona');
        $add('gift_card', 'come_funziona_titolo', "Tre semplici passi per regalare un'opera d'arte");
        $add('gift_card', 'step1_titolo',         "Scegli l'importo");
        $add('gift_card', 'step1_testo',          "Seleziona il valore della gift card tra le opzioni disponibili, oppure richiedi un importo personalizzato. Non c'è limite al dono.");
        $add('gift_card', 'step2_titolo',         'Ricevi la card digitale');
        $add('gift_card', 'step2_testo',          "Dopo l'acquisto riceverai un elegante PDF via email, pronto da stampare o inoltrare direttamente al destinatario.");
        $add('gift_card', 'step3_titolo',         "Chi la riceve sceglie l'opera");
        $add('gift_card', 'step3_testo',          "Il destinatario potrà contattarmi per trasformare il buono in un dipinto personalizzato — se il prezzo finale sarà superiore, potrà semplicemente saldare la differenza — oppure acquistare un'opera già disponibile in galleria o sul sito.");
        $add('gift_card', 'perche_label',         'Perché sceglierla');
        $add('gift_card', 'perche_titolo',        "Un regalo che va oltre l'oggetto");
        $add('gift_card', 'benefit1_titolo',      'Un dono irripetibile');
        $add('gift_card', 'benefit1_testo',       'Ogni opera è creata esclusivamente per chi la riceve. Non esiste in nessun altro posto al mondo.');
        $add('gift_card', 'benefit2_titolo',      'Nessuna scadenza');
        $add('gift_card', 'benefit2_testo',       'La gift card è valida per sempre. Il destinatario potrà riscattarla quando lo desidera, senza fretta.');
        $add('gift_card', 'benefit3_titolo',      'Esperienza unica');
        $add('gift_card', 'benefit3_testo',       "Non un semplice regalo, ma un percorso creativo condiviso. Un'emozione che dura nel tempo.");
        $add('gift_card', 'benefit4_titolo',      'Perfetta per ogni occasione');
        $add('gift_card', 'benefit4_testo',       'Compleanni, anniversari, matrimoni, nuove nascite — ogni momento speciale merita un ricordo eterno.');
        $add('gift_card', 'faq_label',            'Domande frequenti');
        $add('gift_card', 'faq_titolo',           'Se hai altre domande, non esitare a contattarmi');
        $add('gift_card', 'faq_vuote',            'Nessuna domanda frequente al momento.');
        $add('gift_card', 'acquista_label',       'Acquista ora');
        $add('gift_card', 'acquista_titolo',      'La tua gift card, in pochi passi');
        $add('gift_card', 'acquista_sottotitolo', 'Un gesto semplice, un ricordo eterno.');
        $add('gift_card', 'label_valore',         'Scegli il valore della gift card');
        $add('gift_card', 'label_messaggio',      'Vuoi aggiungere qualcosa? (opzionale)');
        $add('gift_card', 'successo_titolo',      'Richiesta inviata!');
        $add('gift_card', 'successo_testo',       'Ti contatterò presto per tutti i dettagli.');

        // ── COMMISSIONI GRAZIE ────────────────────────────────────────────────
        $add('commissioni_grazie', 'titolo',   'Grazie per la tua richiesta!');
        $add('commissioni_grazie', 'testo',    'Ti contatterò al più presto per iniziare il percorso creativo insieme.');
        $add('commissioni_grazie', 'btn_home', 'Torna alla Home');

        DB::table('traduzioni_pagine')->insert($rows);
    }

    public function down(): void
    {
        Schema::dropIfExists('traduzioni_pagine');
    }
};
