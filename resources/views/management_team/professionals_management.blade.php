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
                    
                    <div id="{{ $professional->id }}" class="professional w-4/5 bg-white flex rounded-3xl p-5 my-3 border border-[#FF7400] justify-between shadow-md">
                        <div class="flex w-1/4 items-center">
                            <svg class="w-11 h-11 txt-orange  mr-3">
                                <use xlink:href="#professional_icon"></use>
                            </svg>
                            <p class="txt-orange text-lg">{{ $professional->name }} {{ $professional->surnames }}</p>
                        </div>
                        <div class="flex w-1/4 items-center justify-around">
                            @if ($professional->status == 'active')
                                <form action="{{ route('professional.activate', $professional) }}" class=" text-center bg-[#fffff] rounded-4xl p-3 w-2/5 border border-[#FF7400] txt-orange cursor-pointer">
                                    @csrf
                                    <button id="activate_desactivate_btn" class="active text-md cursor-pointer">
                                        {{ $professional->status }}
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('professional.activate', $professional) }}" class="rounded-4xl bg-[#FF7400] p-3 text-white text-center w-2/5 cursor-pointer">
                                    @csrf
                                    <button id="activate_desactivate_btn" class="innactive text-md cursor-pointer">
                                        {{ $professional->status }}
                                    </button>
                                </form>
                            @endif
                        
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
                            <input type="text" value="{{ $professional->name }}" class="hidden">
                            <input type="text" value="{{ $professional->surnames }}" class="hidden">
                            <input type="text" value="{{ $professional->phone_number }}" class="hidden">
                            <input type="text" value="{{ $professional->email_address }}" class="hidden">
                            <input type="text" value="{{ $professional->address }}" class="hidden">
                            <input type="text" value="{{ $professional->status }}" class="hidden">
                        </div>
                    </div>
                @endforeach
                <div id="professional-info" class="hidden w-4/5 bg-white rounded-3xl p-5 my-5 border border-[#FF7400] shadow-md">
                    <h2 id="info-name" class="text-2xl font-bold text-[#FF7400] mb-3"></h2>
                    <p id="info-email"></p>
                    <p id="info-phone"></p>
                    <p id="info-status"></p>
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