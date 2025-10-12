<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vallparadis</title>
    @vite("resources/css/app.css")

</head>
<body>
    @auth
        <h1>Hola, {{ Auth::user()->name }}</h1>
    

        <a href="{{route('center')}}">Gestió Centre</a><br>
        <a href="{{route('professional')}}">Gestió Professionals</a><br>
        <a href="{{route('project_comission')}}">Gestió Projectes i comissions</a>

        <form method="POST" action="{{route('logout')}}">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Cerrar sesión
            </button>
        </form>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>