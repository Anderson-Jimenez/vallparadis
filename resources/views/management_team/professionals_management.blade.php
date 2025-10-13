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
        <br>
        <table>
        
            <tr>
                <th>Nom del centre</th>
                <th>Nom</th>
                <th>Cognoms</th>
                
                
            </tr>

            @foreach ($professionals as $professional)
                
                <tr>
                    <td>{{ $professional->center->center_name }}</td>
                    <td>{{ $professional->name }}</td>
                    <td>{{ $professional->surnames }}</td>
                    <td><a href="">Modificar</a></td>
                </tr>
            @endforeach
        
        </table>
        <br>
        <a href="">Afegir Professionals</a>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>