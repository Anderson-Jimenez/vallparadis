<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Professionals</title>
    @vite("resources/css/app.css")

</head>
<body>
    @auth
        <h1>Gestió Professionals</h1>

        <table >
        
            <tr>
                <th>Nombre</th>
                <th>Ubicación</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Numero de taquilla</th>
                <th>Contraseña de taquilla</th>
                <th>Estado</th>
            </tr>

            @foreach ($professionals as $professional)
                <tr>
                    <td>{{ $professional->name }}</td>
                    <td>{{ $professional->adress }}</td>
                    <td>{{ $professional->phone_number }}</td>
                    <td>{{ $professional->email_address }}</td>
                    <td>{{ $professional->number_locker }}</td>
                    <td>{{ $professional->clue_locker }}</td>
                    <td>{{ $professional->link_status }}</td>
                </tr>
            @endforeach
        
        </table>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>