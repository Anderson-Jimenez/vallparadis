<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Centre</title>
    @vite(['resources/css/app.css', 'resources/js/centers.js'])

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
                @if ($centers->count() == 1)
                    <section class="flex flex-col items-center w-full">
                        <div class="w-full bg-white flex items-center justify-between py-4 px-[5%] shadow-sm">
                            <div>
                                <h1 class="text-[#2D3E50] text-4xl pb-1">Gestió Centre</h1>
                                <p class="text-[#2d3e50b7] text-lg pl-2">Administracio i modificacio de centres</p>
                            </div>
                            <a href="{{route('center.create')}}" 
                                class="text-sm text-white sidebar-gradient hover:opacity-40 transition-all duration-300 rounded-lg p-4">
                                <svg class="w-5 h-5 inline-block mr-2">
                                    <use xlink:href="#add_icon"></use>
                                </svg>
                                Afegir centre
                            </a>
                        </div>
                        @php $center = $centers->first(); @endphp
                        
                        <div class="flex w-11/12 justify-around">
                            <div class="p-6 my-10 bg-white shadow-md rounded-xl w-11/12 flex flex-col gap-3 border border-gray-300">
                                <div class="flex items-center justify-between p-3">
                                    <div class="flex items-center">
                                        <svg class="w-20 h-20 mr-5 sidebar-gradient text-white rounded-lg p-3" >
                                            <use xlink:href="#building_icon"></use>
                                        </svg>
                                        <h2 class="text-4xl font-bold text-black">Centre de {{ $center->location }}</h2>
                                    </div>
                                    <div class="flex items-center gap-5">

                                        @if ($center->status == "active")
                                            <form action="{{ route('center.activate', $center) }}" method="GET">
                                                @csrf
                                                <button class="bg-[#DCFCE7] text-[#16A34A] rounded-lg p-2 shadow-md hover:bg-[#BBF7D0] transition cursor-pointer flex items-center">
                                                    <svg class="w-7 h-7 text-[#16A34A] inline-block mr-2">
                                                        <use xlink:href="#check_icon"></use>
                                                    </svg>
                                                    Actiu
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('center.activate', $center) }}" method="GET">
                                                @csrf
                                                <button class="bg-[#FEE2E2] text-[#DC2626] rounded-2xl px-5 py-3 shadow-md hover:bg-[#FECACA] transition cursor-pointer flex items-center">
                                                    <svg class="w-7 h-7 text-[#DC2626] inline-block mr-2">
                                                        <use xlink:href="#x_icon"></use>
                                                    </svg>
                                                    Inactiu
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('center.edit', $center) }}" class="flex items-center rounded-lg px-7 py-3 text-white sidebar-gradient hover:opacity-80 transition-all duration-300">
                                            <svg class="w-5 h-5 inline-block mr-2">
                                                <use xlink:href="#edit_icon"></use>
                                            </svg>
                                            Editar
                                        </a> 
                                    </div>
                                </div>
                                <div class="flex items-center gap-6 p-3">
                                    <div class="flex flex-col gap-6 w-1/2">
                                        <h2 class="font-semibold text-gray-700 border-b-2 border-gray-200 text-2xl pb-3">Informació Bàsica</h2>
                                        <div class="flex items-center">
                                            <svg class="w-15 h-15 text-gray-500 inline-block bg-gray-200 rounded-lg p-3 mr-2">
                                                <use xlink:href="#center_icon"></use>
                                            </svg>
                                            <div>
                                                <h2 class=" font-semibold text-gray-700">Nom del centre</h2>
                                                <h3 class="text-xl font-semibold">{{ $center->center_name }}</h3>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-15 h-15 text-gray-500 inline-block bg-gray-200 rounded-lg p-3 mr-2">
                                                <use xlink:href="#location_icon"></use>
                                            </svg>
                                            <div>
                                                <h2 class="font-semibold text-gray-700">Ubicació</h2>
                                                <h3 class="text-xl font-semibold">{{ $center->location }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-6 w-1/2">
                                        <h2 class="font-semibold text-gray-800 border-b-2 border-gray-200 text-2xl pb-3">Informació de Contacte</h2>
                                        <div class="flex items-center">
                                            <svg class="w-15 h-15 text-gray-500 inline-block bg-gray-200 rounded-lg p-3 mr-2">
                                                <use xlink:href="#phone_icon"></use>
                                            </svg>
                                            <div>
                                                <h2 class=" font-semibold text-gray-700">Telèfon de Contacte</h2>
                                                <h3 class="text-xl font-semibold">+34 {{ $center->phone_number }}</h3>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-15 h-15 text-gray-500 inline-block bg-gray-200 rounded-lg p-3 mr-2">
                                                <use xlink:href="#location_icon"></use>
                                            </svg>
                                            <div>
                                                <h2 class="font-semibold text-gray-700">Adreça Electrònica</h2>
                                                <h3 class="text-xl font-semibold">{{ $center->email_address }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 flex gap-6">
                                    
                                </div>
                            </div>
                        </div>
                    </section>    
                @else
                    <section class="flex flex-col items-center w-full">
                        <div class="w-full bg-white flex items-center justify-between py-4 px-7 shadow-sm border-b-2 border-gray-300 ">
                            <div>
                                <h1 class="text-[#2D3E50] text-4xl pb-1">Gestió Centre</h1>
                                <p class="text-[#2d3e50b7] text-lg pl-2">Administracio i modificacio de centres</p>
                            </div>
                            <a href="{{route('center.create')}}" 
                                class=" text-white sidebar-gradient hover:opacity-40 transition-all duration-300 rounded-lg px-5 py-3 text-base">
                                <svg class="w-5 h-5 inline-block mr-2">
                                    <use xlink:href="#add_icon"></use>
                                </svg>
                                Afegir centre
                            </a>
                        </div>
                        <section class="flex w-full">
                            <aside class="flex flex-col w-1/5 bg-white h-screen justify-start">
                                <div class="p-6 border-b border-gray-300 mb-3">
                                    <h2 class="text-2xl font-semibold text-gray-700">Llista de Centres</h2>
                                    <p class="text-gray-500">Gestiona els centres des da aquesta secció.</p>
                                </div>
                                <div class="flex flex-col overflow-y-auto">
                                    @foreach ($centers as $center)
                                        <div
                                            class="center-item mx-3 my-1 rounded-lg cursor-pointer p-4 border border-gray-300 hover:bg-gray-100"
                                            data-id="{{ $center->id }}"
                                            data-name="{{ $center->center_name }}"
                                            data-location="{{ $center->location }}"
                                            data-phone="{{ $center->phone_number }}"
                                            data-email="{{ $center->email_address }}"
                                            data-status="{{ $center->status }}"   
                                        >
                                            <h3 class="font-semibold text-xl my-1">{{ $center->center_name }}</h3>
                                            <p class="text-lg text-gray-500 my-1">{{ $center->location }}</p>

                                            @if ($center->status === 'active')
                                                <span class="text-green-600 text-base pl-2">● Actiu</span>
                                            @else
                                                <span class="text-red-600 text-base pl-2">● Inactiu</span>
                                            @endif
                                        </div>
                                
                                    @endforeach
                                </div>
                            </aside>
                            <section id="center-detail" class="w-4/6 p-6 hidden">
                                <div class="bg-white shadow-md rounded-xl p-6">
                                    <h2 id="detail-name" class="text-3xl font-bold mb-4"></h2>

                                    <div class="grid grid-cols-2 gap-6">
                                        <div>
                                            <h3 class="font-semibold text-gray-700">Ubicació</h3>
                                            <p id="detail-location"></p>
                                        </div>

                                        <div>
                                            <h3 class="font-semibold text-gray-700">Telèfon</h3>
                                            <p id="detail-phone"></p>
                                        </div>

                                        <div>
                                            <h3 class="font-semibold text-gray-700">Email</h3>
                                            <p id="detail-email"></p>
                                        </div>

                                        <div>
                                            <h3 class="font-semibold text-gray-700">Estat</h3>
                                            <p id="detail-status"></p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </section>
                    </section>
                @endif



                
        </main>

    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>