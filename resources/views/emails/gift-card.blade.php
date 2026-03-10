<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Nuova richiesta Gift Card</title>
</head>
<body>
<h2>Nuova richiesta Gift Card</h2>

<p><strong>Nome:</strong> {{ $data['nome'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>
<p><strong>Valore scelto:</strong> {{ $data['valore'] }}</p>

@if(!empty($data['messaggio']))
<p><strong>Messaggio:</strong><br>{{ $data['messaggio'] }}</p>
@endif

</body>
</html>
