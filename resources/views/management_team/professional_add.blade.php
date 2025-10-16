<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite("resources/css/app.css")
</head>
<body>
    @auth
        
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif

        <form action="{{ route('professional.store') }}" method="POST">
            @csrf

            <label for="name">Nom:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            <br><br>

            <label for="surnames">Cognoms:</label>
            <input type="text" name="surnames" id="surnames" value="{{ old('surnames') }}" required>
            <br><br>

            <label for="username">Nom d’usuari:</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}" required>
            <br><br>

            <label for="password">Contrasenya:</label>
            <input type="password" name="password" id="password" required>
            <br><br>

            <label for="phone_number">Telèfon:</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
            <br><br>

            <label for="email_address">Correu electrònic:</label>
            <input type="text" name="email_address" id="email_address" value="{{ old('email_address') }}">
            <br><br>

            <label for="address">Adreça:</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}">
            <br><br>

            <label for="number_locker">Número de taquilla:</label>
            <input type="text" name="number_locker" id="number_locker" value="{{ old('number_locker') }}">
            <br><br>

            <label for="clue_locker">Clau de la taquilla:</label>
            <input type="text" name="clue_locker" id="clue_locker" value="{{ old('clue_locker') }}">
            <br><br>
            
            <button type="submit">Crear Professional</button>
        </form>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>