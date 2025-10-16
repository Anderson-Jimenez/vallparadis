<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titol', 'Panell de control')</title>
    @vite("resources/css/app.css")

</head>
<body>
    @auth
        @include('components.navbar')

        @yield('contingut')
            <main class="w-screen min-h-screen">
                <aside class="w-[35vw] ">
                    <ul>
                        <li><a href="{{route('center.index')}}" class="txt-orange">Gestió Centre</a></li>
                        <li><a href="{{route('professional.index')}}" class="txt-orange">Gestió Professionals</a></li>
                        <li><a href="{{route('project_comission.index')}}" class="txt-orange">Gestió Projectes i comissions</a></li>
                    </ul>
                    <a href="{{route('logout')}}">
                        <button type="submit" class="bg-[#ff7300] text-white px-4 py-2 rounded hover:bg-red-600">
                            Cerrar sesión
                        </button>
                    </a>
                </aside>
            </main>

        @include('components.footer')

    @endauth
    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>