<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió manteniment</title>
    @vite("resources/css/app.css")

</head>
<body class="min-h-screen flex flex-col bg-body">
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
                    <div class="w-full bg-white flex items-center justify-between py-4 px-[5%]">
                        <div class="">
                            <h1 class="text-[#2D3E50] text-4xl pb-1 w-4/5">Gestió Manteniment</h1>
                            <p class="text-[#2D3E50]">Administra i realitza seguiments de tots els manteniments</p>
                        </div>
                        
                        <a href="{{ route('maintenance.create') }}"
                        class="flex items-center text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                                    transition-all duration-300 rounded-xl px-5 py-2 text-center h-3/4">
                            
                            <svg class="w-6 h-6 mr-2">
                                <use xlink:href="#maintenance_icon"></use>
                            </svg>
                            Afegir entrada manteniment
                        </a>
                    </div>
                                        
                    <div class="w-10/12 h-full flex flex-col  bg-[#fef2e6] rounded-xl overflow-auto">
                        <div class="relative flex items-center mt-10">
                            <input type="search" 
                                id="search_input"
                                name="text"
                                placeholder="Cercar manteniments..." 
                                class="bg-white border border-[#ff7300] rounded-lg px-3 py-1 w-[30vw] h-[5vh]">
                            <svg class="relative w-6 h-6 txt-orange right-10">
                                <use xlink:href="#search_loupe"></use>
                            </svg>
                        </div>
                        @foreach($maintenances as $maintenance)
                            <div class="bg-white border border-[#ff7300] rounded-lg h-1/3 mt-5 px-3">
                                @if ($maintenance->status == 'inactive')
                                    <span class="px-6 py-4 bg-red-500 text-white m-2 rounded-full w-max" >Finalitzat</span>
                                @else
                                    <p class="px-6 py-4 bg-green-500 text-white rounded-lg m-2 w-max">En progress</p>
                                @endif
                                <h2 class="text-xl">{{$maintenance->name}}</h2>
                                <p>{{$maintenance->description}}</p>
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