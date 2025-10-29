<!DOCTYPE html>
<html lang="ca">
    <head>
        <meta charset="UTF-8">
        <title>@yield('titol', 'El meu projecte Laravel')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @include('partials.icons')
        <!-- PLANTILLA HEADER -->
        @include('components.navbar')
        
        <main>
            <!-- PLANTILLA ASIDE -->
            @include('components.aside')
            @yield('contingut')
        </main>
        <!-- PLANTILLA FOOTER -->
        @include('components.footer')
    </body>
</html>