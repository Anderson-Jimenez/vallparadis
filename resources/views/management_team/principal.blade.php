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
                <aside class="bg-[#2D3E50] p-8 h-[45vw] flex flex-col justify-between w-1/5">
                    <ul>
                        <li class="group my-4 rounded-lg transition-all duration-300">
                            <a href="{{ route('center.index') }}" class="flex items-center gap-3 p-4 rounded-lg bg-[#2D3E50] group-hover:bg-[#ff7300] transition-all duration-300 ">
                            
                                <svg class="w-8 h-8 text-white">
                                    <use xlink:href="#professional_icon"></use>
                                </svg>

                                <span class="text-white text-lg">
                                    Gestió Centre
                                </span>
                            </a>
                        </li>
                        <li class="group my-4 rounded-lg transition-all duration-300">
                            <a href="{{ route('professional.index') }}" class="flex items-center gap-3 p-4 rounded-lg bg-[#2D3E50] group-hover:bg-[#ff7300] transition-all duration-300">
                            
                                <svg class="w-8 h-8 text-white">
                                    <use xlink:href="#center_icon"></use>
                                </svg>

                                <span class="text-white text-lg">
                                    Gestió Professionals
                                </span>
                            </a>
                        </li>
                        <li class="group my-4 rounded-lg transition-all duration-300">
                            <a href="{{ route('project_comission.index') }}" class="flex items-center gap-3 p-4 rounded-lg bg-[#2D3E50] group-hover:bg-[#ff7300] transition-all duration-300">
                            
                                <svg class="w-10 h-10 text-white">
                                    <use xlink:href="#project_icon"></use>
                                </svg>

                                <span class="text-white text-lg">
                                    Gestió Projectes i comissions
                                </span>
                            </a>
                        </li>
                    </ul>   
                    <a href="{{ route('logout') }}" class="group flex justify-center items-center top-20 w-[15vw] h-[3vw] bg-white text-[#ff7300] px-3 py-1 rounded-full text-lg font-semibold
                    transition-all duration-300 hover:bg-[#ff7300] hover:text-white">
                        Tancar sessió
                    </a>
                </aside>
                
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