<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Professionals</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-[#E9EDF2]">
    @include('partials.icons')
    @auth
        @include('components.navbar')
        <main class="flex-grow flex w-full">
            @yield('contingut')
            @include('components.aside')
            <section id="principal_content" class="w-4/5 flex-grow flex flex-col items-center">
                <h1 class="text-[#2D3E50] text-3xl w-10/12 text-center p-10 border-b-6 border-[#2D3E50]">Gestió Professionals</h1>

                @foreach ($professionals as $professional)
                    
                    <div id="{{ $professional->id }}" class="w-4/5 bg-white flex rounded-3xl p-5 my-3 border border-[#FF7400] justify-between shadow-md">
                        <div class="flex w-1/4 items-center">
                            <svg class="w-11 h-11 txt-orange  mr-3">
                                <use xlink:href="#professional_icon"></use>
                            </svg>
                            <p class="txt-orange text-lg">{{ $professional->name }} {{ $professional->surnames }}</p>
                        </div>
                        <div class="flex w-1/4 items-center justify-around">
                            <form action="{{ route('professional.activate', $professional) }}" class="w-[10%] rounded-3xl ">
                                @csrf
                                <button class="btn-status text-md">{{ $professional->status }}</button>
                            </form>

                            
                                <a href="{{route('professional.edit', $professional)}}" title="Editar dades professional">
                                    <svg class="w-9 h-9 txt-orange">
                                        <use xlink:href="#edit_icon"></use>
                                    </svg>
                                </a>


                                <!--
                                    <div class="relative group inline-block">
                                        <span class="absolute left-1/2 -translate-x-1/2 bottom-8 bg-white text-gray-900 text-sm px-2 py-1 rounded-md border border-gray-300 shadow-md whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        Editar professional
                                        </span>
                                    </div>
                                -->

                        </div>
                    </div>                              
                @endforeach
                    <div class="flex flex-col">
                        <svg class="w-20 h-20 txt-orange  mr-3">
                            <use xlink:href="#professional_icon"></use>
                        </svg>
                        <h1></h1>
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