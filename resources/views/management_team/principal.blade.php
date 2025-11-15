<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titol', 'Panell de control')</title>
    @vite("resources/css/app.css")

</head>
<body>
    @include('partials.icons')
    @auth
        @include('components.navbar')
        <main class="w-screen flex">
            @include('components.sidebar')
            @yield('contingut')
            
            <!--S'haria de posar un controllador o quelcom similar -->
            <section class=" w-4/5">
                <div class="flex w-full h-max">
                    <div class="w-1/4 h-[20vh] bg-[#949494] m-4 rounded-3xl"></div>
                    <div class="w-1/4 h-[20vh] bg-[#949494] m-4 rounded-3xl"></div>
                    <div class="w-1/4 h-[20vh] bg-[#949494] m-4 rounded-3xl"></div>
                    <div class="w-1/4 h-[20vh] bg-[#949494] m-4 rounded-3xl"></div>
                </div>

            </section>

        </main>

        @include('components.footer')

    @endauth
    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>