<!DOCTYPE html>
<html lang="ca">
    <head>
        <meta charset="UTF-8">
        <title>@yield('titol', 'El meu projecte Laravel')</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        @include('partials.icons')
        <!-- PLANTILLA HEADER -->
        @include('components.navbar')
        <main>
            @yield('contingut')
        </main>
        <!-- PLANTILLA FOOTER -->
        @include('components.footer')
    </body>
</html>