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

        <table class="table-base table-wrapper">
        
            <tr class="table-row">
                <th class="table-cell">Nom</th>
                <th class="table-cell">Ubicació</th>
                <th class="table-cell">Teléfon</th>
                <th class="table-cell">Email</th>
            </tr>

            @foreach ($centers as $center)
                <tr class="table-row">
                    <td class="table-cell">{{ $center->center_name }}</td>
                    <td class="table-cell">{{ $center->location }}</td>
                    <td class="table-cell">{{ $center->phone_number }}</td>
                    <td class="table-cell">{{ $center->email_address }}</td>
                    <td class="table-cell">
                        <form action="{{ route('center.activate', $center) }}">
                            @csrf
                            
                            <button type="submit">{{ $center->status }}</button>
                        </form>
                    </td>
                    <td class="table-cell"><a href="{{route('center.edit', $center)}}">Modificar</a></td>
                    <td class="table-cell">
                        <form action="{{ route('center.destroy', $center) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        
        </table>
        <br>
        <a href="{{route('center.create')}}">Afegir Centre</a>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>