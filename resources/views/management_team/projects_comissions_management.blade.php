<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Projectes/Comissions</title>
    @vite("resources/css/app.css")

</head>
<body>
    @auth
        <h1>Gestió Projectes i Comissions</h1>

        <table class="table-base table-wrapper">
            <tr class="table-row">
                <th class="table-cell">Responsable</th>
                <th class="table-cell">Nom</th>
                <th class="table-cell">Data d'inici</th>
                <th class="table-cell">Tipus</th>
            </tr>

            @foreach ($projects_comissions as $project_comission)
                <tr class="table-row">
                    <td class="table-cell">{{ $project_comission->manager->name }}</td>
                    <td class="table-cell">{{ $project_comission->name }}</td>
                    <td class="table-cell">{{ $project_comission->start_date }}</td>
                    <td class="table-cell">{{ $project_comission->type }}</td>
                    <td class="table-cell"><a href="">Modificar</a></td>
                    <td class="table-cell"><a href="">Eliminar</a></td>
                </tr>
            @endforeach
        
        </table>
        <br>
        <a href="{{route('project_comission.create')}}">Afegir Projectes/Comissions</a>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>