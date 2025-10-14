<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Centre</title>
    @vite("resources/css/app.css")

</head>
<body>
    @auth
        <h1>Gestió Centre</h1>

        <table >
        
            <tr>
                <th>Nombre</th>
                <th>Ubicación</th>
                <th>Teléfono</th>
                <th>Email</th>
            </tr>

            @foreach ($centers as $center)
                <tr>
                    <td>{{ $center->center_name }}</td>
                    <td>{{ $center->location }}</td>
                    <td>{{ $center->phone_number }}</td>
                    <td>{{ $center->email_address }}</td>
                    <td><a href="">Modificar</a></td>
                    <td><a href="">Eliminar</a></td>
                </tr>
            @endforeach
        
        </table>
        <br>
        <a href="">Afegir Centre</a>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>