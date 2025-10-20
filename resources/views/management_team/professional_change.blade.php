<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulari Modificacio Professional</title>
    @vite("resources/css/app.css")
</head>
<body>
    @auth
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif

        <form action="{{ route('professional.update', $professional) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="name">Nom:</label>
            <input type="text" name="name" id="name" value="{{ $professional->name }}" required>

            <label for="surnames">Cognoms:</label>
            <input type="text" name="surnames" id="surnames" value="{{ $professional->surnames }}" required>

            <label for="username">Nom d’usuari:</label>
            <input type="text" name="username" id="username" value="{{ $professional->username }}" required>

            <label for="password">Contrasenya:</label>
            <input type="password" name="password" id="password" value="" required>

            <label for="phone_number">Telèfon:</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ $professional->phone_number }}" required>

            <label for="email_address">Correu electrònic:</label>
            <input type="text" name="email_address" id="email_address" value="{{ $professional->email_address }}" required>

            <label for="address">Adreça:</label>
            <input type="text" name="address" id="address" value="{{ $professional->address }}" required>

            <label for="number_locker">Número de taquilla:</label>
            <input type="text" name="number_locker" id="number_locker" value="{{ $professional->number_locker }}" required>

            <label for="clue_locker">Clau de la taquilla:</label>
            <input type="text" name="clue_locker" id="clue_locker" value="{{ $professional->clue_locker }}" required>
            <h1><strong>Uniformes de professional</strong></h1><br><br>
            <label for="shirt_size">Talla camisa:</label>
            <select name="uniform[shirt_size]" id="shirt_size">
                <option value="">Uniforme para elegir</option>
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="2XL">2XL</option>
                <option value="3XL">3XL</option>
                <option value="4XL">4XL</option>
            </select>

            <label for="trausers_size">Talla pantalón:</label>
            <select name="uniform[trausers_size]" id="trausers_size">
                <option value="">Uniforme para elegir</option>
                @for ($i = 36; $i <= 56; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>

            <label for="shoes_size">Talla calzado:</label>
            <select name="uniform[shoes_size]" id="shoes_size">
                <option value="">Uniforme para elegir</option>
                @for ($i = 36; $i <= 56; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>

            <label for="renovation_date">Fecha de renovación:</label>
            <input type="date" name="uniform[renovation_date]" id="renovation_date">

            <label for="docs_route">Documento:</label>
            <input type="file" name="uniform[docs_route]" id="docs_route">

            <button type="submit">Modificar dades de {{ $professional->name }}</button>
        </form>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>