<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Centre</title>
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
                <section class="flex flex-col items-center w-full">
                    @if ($centers->count() == 1)
                    <div class="w-full bg-white flex items-center justify-between py-4 px-[5%] shadow-sm">
                        <div>
                            <h1 class="text-[#2D3E50] text-4xl pb-1">Gestió Centre</h1>
                            <p class="text-[#2d3e50b7] text-lg pl-2">Administracio i modificacio de centres</p>
                        </div>
                    </div>
                        @php $center = $centers->first(); @endphp
                        <div class="flex w-9/12 justify-around">
                            <div class="p-6 my-10 bg-white shadow-md rounded-xl w-3/6 flex flex-col gap-3 border border-[#ff7300] hover:shadow-xl transition hover:scale-105 ">
                                <h2 class="text-xl font-bold text-[#ff7300]">{{ $center->center_name }}</h2>

                                <p><strong>Ubicació:</strong> {{ $center->location }}</p>
                                <p><strong>Teléfon:</strong> {{ $center->phone_number }}</p>
                                <p><strong>Email:</strong> {{ $center->email_address }}</p>

                                <div class="mt-4 flex gap-6">
                                    <a href="{{ route('center.edit', $center) }}" class="flex items-center rounded-2xl px-5 py-2 text-[#ff7300] hover:underline border border-[#ff7300]">
                                        Modificar
                                    </a>   
                                    @if ($center->status == "active")
                                        <form action="{{ route('center.activate', $center) }}" method="GET">
                                            @csrf
                                            <button class="bg-[#DCFCE7] text-[#16A34A]
                                                    rounded-2xl px-5 py-2 shadow-md hover:bg-[#BBF7D0]
                                                    transition cursor-pointer">
                                                Actiu
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('center.activate', $center) }}" method="GET">
                                            @csrf
                                            <button class="bg-[#FEE2E2] text-[#DC2626]
                                                        rounded-2xl px-5 py-2 shadow-md hover:bg-[#FECACA]
                                                        transitio cursor-pointer">
                                                Inactiu
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <div class="w-4/12 my-10 bg-white shadow-md rounded-xl flex justify-center items-center flex-col gap-3 border border-[#ff7300] hover:shadow-xl transition">
                                <svg class="w-3/6 h-3/6 txt-orange mr-3">
                                    <use xlink:href="#house_plus_icon"></use>
                                </svg>
                                <a href="{{route('center.create')}}" 
                                    class="text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300] hover:border hover:border-[#ff7300]  transition-all duration-300 rounded-2xl p-4">
                                    + Afegir centre
                                </a>
                            </div>
                        </div>
                        
                    @else
                        <h1 class="txt-orange text-4xl w-10/12 text-left py-4 pt-10 border-b-2 border-[#ff7300]">
                            Gestió Centre
                        </h1>
                        <div class="flex items-center w-10/12 h-[10vh]">
                            <a href="{{route('center.create')}}" 
                                class="text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300] hover:border hover:border-[#ff7300]  transition-all duration-300 rounded-2xl p-4">
                                + Afegir centre
                            </a>
                        </div>

                        <div class="flex flex-wrap justify-center gap-6 w-10/12 my-5">

                            @foreach ($centers as $center)
                                <div class="bg-white shadow-md p-5 rounded-xl w-[280px] flex flex-col 
                                            hover:shadow-xl transition border border-[#ff7300]">

                                    <h2 class="text-lg font-bold text-[#ff7300] mb-2">{{ $center->center_name }}</h2>

                                    <p class="text-sm">{{ $center->location }}</p>
                                    <p class="text-sm">{{ $center->phone_number }}</p>
                                    <p class="text-sm">{{ $center->email_address }}</p>

                                    <div class="mt-4 flex gap-4 justify-between">
                                        <a href="{{ route('center.edit', $center) }}" class="flex items-center rounded-2xl px-5 py-2 text-[#ff7300] hover:underline border border-[#ff7300]">
                                            Modificar
                                        </a>

                                        @if ($center->status == "active")
                                            <form action="{{ route('center.activate', $center) }}" method="GET">
                                                @csrf
                                                <button class="bg-[#DCFCE7] text-[#16A34A]
                                                        rounded-2xl px-5 py-2 shadow-md hover:bg-[#BBF7D0]
                                                        transition cursor-pointer">
                                                    Actiu
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('center.activate', $center) }}" method="GET">
                                                @csrf
                                                <button class="bg-[#FEE2E2] text-[#DC2626]
                                                            rounded-2xl px-5 py-2 shadow-md hover:bg-[#FECACA]
                                                            transitio cursor-pointer">
                                                    Inactiu
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    @endif



                </section>
        </main>

    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>