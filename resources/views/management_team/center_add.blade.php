<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Afegir centres</title>
    @vite("resources/css/app.css")
</head>
<body>
    @auth
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif

        <form action="{{ route('center.store') }}" method="POST">
            @csrf

            <!-- Nom del Centre -->
            <div class="form-group">
                <label for="center_name">Nom del Centre</label>
                <input type="text" name="center_name" id="center_name" class="form-control" value="{{ old('center_name') }}" required>
            </div>

            <!-- Ubicació -->
            <div class="form-group">
                <label for="location">Ubicació</label>
                <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required>
            </div>

            <!-- Telèfon -->
            <div class="form-group">
                <label for="phone_number">Telèfon</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
            </div>

            <!-- Correu electrònic -->
            <div class="form-group">
                <label for="email_address">Correu electrònic</label>
                <input type="email" name="email_address" id="email_address" class="form-control" value="{{ old('email_address') }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Crear Centre</button>
        </form>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>