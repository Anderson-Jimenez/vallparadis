<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modificar centre</title>
    @vite("resources/css/app.css")
</head>
<body>
    @auth
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif

        <form action="{{ route('center.update', $center) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="center_name">Nom del centre:</label>
            <input type="text" name="center_name" id="center_name" value="{{ $center->center_name }}" required>
            <br><br>

            <label for="location">Ubicació:</label>
            <input type="text" name="location" id="location" value="{{ $center->location }}" required>
            <br><br>

            <label for="phone_number">Telèfon:</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ $center->phone_number }}" required>
            <br><br>

            <label for="email_address">Correu electrònic:</label>
            <input type="email" name="email_address" id="email_address" value="{{ $center->email_address }}" required>
            <br><br>

            <button type="submit">Modificar centre</button>
        </form>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>