<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Nuova richiesta opera su commissione</title>
</head>
<body>
<h2>Nuova richiesta di opera su commissione</h2>

<p><strong>Nome:</strong> {{ $data['nome'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>
<p><strong>Telefono:</strong> {{ $data['telefono'] }}</p>

<hr>

<p><strong>Cosa ti piacerebbe che questa opera trasmettesse?</strong><br>
    {{ $data['trasmettere'] ?? '-' }}</p>

<p><strong>Cosa desideri che questa opera raffiguri?</strong><br>
    {{ $data['raffigurare'] ?? '-' }}</p>

<p><strong>Colori predominanti:</strong><br>
    {{ $data['colori'] ?? '-' }}</p>

<p><strong>A chi è destinata quest’opera?</strong><br>
    {{ $data['destinazione'] ?? '-' }}</p>

<p><strong>Cosa ti ha spinto a richiedere un’opera su misura?</strong><br>
    {{ $data['motivo'] ?? '-' }}</p>

</body>
</html>
