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
                <th class="table-cell">Nombre centro</th>
                <th class="table-cell">Responsable</th>
                <th class="table-cell">Nombre</th>
                <th class="table-cell">Fecha de inicio</th>
                <th class="table-cell">Descripcion</th>
                <th class="table-cell">Observacion</th>
                <th class="table-cell">Tipo</th>
            </tr>

            @foreach ($projects_comissions as $project_comission)
                <tr class="table-row">
                    <td class="table-cell">{{ $project_comission->center_id }}</td>
                    <td class="table-cell">{{ $project_comission->professional_manager_id }}</td>
                    <td class="table-cell">{{ $project_comission->name }}</td>
                    <td class="table-cell">{{ $project_comission->start_date }}</td>
                    <td class="table-cell">{{ $project_comission->description }}</td>
                    <td class="table-cell">{{ $project_comission->observation }}</td>
                    <td class="table-cell">{{ $project_comission->type }}</td>
                    <td class="table-cell"><a href="">Modificar</a></td>
                    <td class="table-cell"><a href="">Eliminar</a></td>
                </tr>
            @endforeach
        
        </table>
        <br>
        <a href="">Afegir Projectes/Comissions</a>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>