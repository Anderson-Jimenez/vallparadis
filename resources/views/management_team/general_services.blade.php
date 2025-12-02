<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Curs</title>
    @vite("resources/css/app.css")

</head>
<body class="min-h-screen flex flex-col bg-[#E9EDF2]">
    @include('partials.icons')     
    @auth
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
        @include('components.navbar')
        <main class="grow flex w-full">
            @include('components.sidebar')
            @yield('contingut')
                <section class="flex flex-col items-center w-4/5">
                    <div class="w-11/12 border-b-4 border-[#213c57] flex items-center justify-between py-4">
                    <h1 class="text-[#2D3E50] text-4xl pt-7 pb-1 w-4/5">Gestió Serveis Generals</h1>
                    {{-- Botón para añadir profesional --}}
                    <a href="{{ route('professional.create') }}"
                    class="flex items-center text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                                transition-all duration-300 rounded-xl px-5 py-2 text-center h-3/4">
                         
                        <svg class="w-6 h-6 mr-2">
                            <use xlink:href="#add_prof_icon"></use>
                        </svg>
                        Afegir servei
                    </a>
                    </div>
                                        
                    <div class="w-11/12 flex items-center flex-col mt-8 bg-[#fef2e6] p-10 rounded-xl overflow-auto h-[60vh]" id="prof-info-container">
                        @foreach ($services as $service)
                            
                            <div class="professional-info w-full bg-white flex rounded-3xl p-5 my-3 border border-[#FF7400]
                                    justify-between shadow-md hover:scale-102 transition-all duration-400">
                                <div id="{{$service->id}}" class=" flex items-center cursor-pointer">
                                    <svg class="w-10 h-10 txt-orange mr-3">
                                        <use xlink:href="#professional_icon"></use>
                                    </svg>
                                    <p class="txt-orange text-lg">
                                        {{$service->type}}
                                    </p>

                                </div>
                                <div class="w-4/5 flex">
                                    
                                    <a href="{{ route('general_service.edit', $service) }}" title="Editar dades professional" class="border border-[#ff7300] rounded-tr-xl rounded-br-xl gap-x-1.5 px-3 py-2 transition ease-in duration-200 hover:bg-[#ffa65d91]">
                                        <svg class="w-6 h-6 txt-orange ">
                                            <use xlink:href="#edit_icon"></use>
                                        </svg>
                                    </a>
                                </div>
                                
                            </div>
                            
                        @endforeach
                    </div>
                </section>
            
        </main>

    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>