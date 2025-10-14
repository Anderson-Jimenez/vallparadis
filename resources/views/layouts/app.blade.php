<!DOCTYPE html>
<html lang="ca">
    <head>
        <meta charset="UTF-8">
        <title>@yield('titol', 'El meu projecte Laravel')</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-100 text-gray-900">
        @include('partials.icons')
        @include('components.navbar')
        <main class="p-6">
            @yield('contingut')
        </main>
        {{-- Peu de pàgina comú --}}
        @include('components.footer')
    </body>
</html>