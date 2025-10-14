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

        <table >
        
            <tr>
                <th>Nombre centro</th>
                <th>Responsable</th>
                <th>Nombre</th>
                <th>Fecha de inicio</th>
                <th>Descripcion</th>
                <th>Observacion</th>
                <th>Tipo</th>
                
            </tr>

            @foreach ($projects_comissions as $project_comission)
                <tr>
                    <td>{{ $project_comission->center_id }}</td>
                    <td>{{ $project_comission->professional_manager_id }}</td>
                    <td>{{ $project_comission->name }}</td>
                    <td>{{ $project_comission->start_date }}</td>
                    <td>{{ $project_comission->description }}</td>
                    <td>{{ $project_comission->observation }}</td>
                    <td>{{ $project_comission->type }}</td>
                    <td><a href="">Modificar</a></td>
                    <td><a href="">Eliminar</a></td>
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