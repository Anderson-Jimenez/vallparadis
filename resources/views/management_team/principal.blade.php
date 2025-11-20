<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titol', 'Panell de control')</title>
    @vite("resources/css/app.css")

</head>
<body class="bg-[#E9EDF2]">
    @include('partials.icons')
    @auth
        @include('components.navbar')
        <main class="w-screen flex">
            @include('components.sidebar')
            @yield('contingut')
            
            <!--S'haria de posar un controllador o quelcom similar -->
            <section class=" w-full">
                <div class="flex w-full h-max">
                    <div class="w-4/12 h-[30vh] bg-white m-5 rounded-3xl border border-[#ff7300] shadow-lg flex flex-col justify-center items-center">
                        <h1 class="txt-orange text-3xl">Professionals Actius</h1>
                    </div>
                    <div class="w-4/12 h-[30vh] bg-white m-5 rounded-3xl border border-[#ff7300] shadow-lg flex flex-col justify-center items-center">
                        <h1 class="txt-orange text-3xl">Projectes en procés</h1>
                        
                    </div>
                    <div class="w-4/12 h-[30vh] bg-white m-5 rounded-3xl border border-[#ff7300] shadow-lg flex flex-col justify-center items-center txt-orange text-3xl">
                        <h1 class="txt-orange text-3xl">Cursos Actius</h1>
                    </div>
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