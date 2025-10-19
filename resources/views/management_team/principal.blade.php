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

        @yield('contingut')
            <main class="w-screen flex">
                <aside class="w-[20vw] bg-[#2D3E50] p-8 h-[50vw] flex flex-col justify-between">
                    <ul>
                        <li class="group my-4 rounded-lg transition-all duration-300">
                            <a href="{{ route('center.index') }}" class="flex items-center gap-3 p-4 rounded-lg bg-[#2D3E50] group-hover:bg-[#ff7300] transition-all duration-300 w-max">
                            
                                <svg class="w-10 h-10 text-white">
                                    <use xlink:href="#professional_icon"></use>
                                </svg>

                                <span class="text-white text-2xl">
                                    Gestió Centre
                                </span>
                            </a>
                        </li>
                        <li class="group my-4 rounded-lg transition-all duration-300">
                            <a href="{{ route('professional.index') }}" class="flex items-center gap-3 p-4 rounded-lg bg-[#2D3E50] group-hover:bg-[#ff7300] transition-all duration-300">
                            
                                <svg class="w-10 h-10 text-white">
                                    <use xlink:href="#center_icon"></use>
                                </svg>

                                <span class="text-white text-2xl">
                                    Gestió Professionals
                                </span>
                            </a>
                        </li>
                        <li class="group my-4 rounded-lg transition-all duration-300">
                            <a href="{{ route('project_comission.index') }}" class="flex items-center gap-3 p-4 rounded-lg bg-[#2D3E50] group-hover:bg-[#ff7300] transition-all duration-300">
                            
                                <svg class="w-12 h-12 text-white">
                                    <use xlink:href="#project_icon"></use>
                                </svg>

                                <span class="text-white text-2xl">
                                    Gestió Projectes i comissions
                                </span>
                            </a>
                        </li>
                    </ul>   
                    <a href="{{ route('logout') }}" class="group flex justify-center items-center top-20 w-[15vw] h-[4vw] bg-white text-[#ff7300] px-6 py-4 rounded-full text-2xl font-semibold
                    transition-all duration-300 hover:bg-[#ff7300] hover:text-white">
                        Cerrar sessió
                    </a>
                </aside>
                
                <!--S'haria de posar un controllador o quelcom similar-->
                <section class="w-[75vw]">
                    <div class="flex w-full h-max">
                        <div class="w-2/6 h-[20vh] bg-[#ff7300] m-7 rounded-3xl"></div>
                        <div class="w-2/6 h-[20vh] bg-[#ff7300] m-7 rounded-3xl"></div>
                        <div class="w-2/6 h-[20vh] bg-[#ff7300] m-7 rounded-3xl"></div>
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