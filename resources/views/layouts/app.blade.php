<!DOCTYPE html>
<html lang="ca">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('titol', 'El meu projecte Laravel')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @include('partials.icons')
        <!-- PLANTILLA HEADER -->  
        <main>
            <!-- PLANTILLA ASIDE -->
            @include('components.sidebar')
            @yield('contingut')
        </main>
        <!-- PLANTILLA FOOTER -->
        @include('components.footer')
    </body>
</html>