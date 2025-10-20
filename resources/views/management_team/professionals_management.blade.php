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
        <table class="table-base table-wrapper">
        
            <tr class="table-row">
                <th class="table-cell">Nom</th>
                <th class="table-cell">Cognoms</th>
                <th class="table-cell">Estat</th>
            </tr>

            @foreach ($professionals as $professional)
                
                <tr class="table-row">
                    <td class="table-cell">{{ $professional->name }}</td>
                    <td class="table-cell">{{ $professional->surnames }}</td>
                    <td class="table-cell">{{ $professional->link_status }}</td>
                    <td class="table-cell">{{ $professional->status }}</td>
                    <td class="table-cell"><a href="">Modificar</a></td>
                    <td class="table-cell"><a href="">Eliminar</a></td>
                </tr>
            @endforeach
        
        </table>
        <br>
        <a href="{{route('professional.create')}}">Afegir Professionals</a>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>