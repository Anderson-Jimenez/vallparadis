<!DOCTYPE html>
<html lang="ca">
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

        <main class="flex w-full">
            @yield('contingut')
            @include('components.aside')

            <section id="principal-content" class="w-4/5 flex-grow flex flex-col items-center relative">
                <div class="flex border-b-6 border-[#2D3E50] items-center w-4/5 justify-between">
                    <h1 class="text-[#2D3E50] text-3xl text-center p-7 flex-grow">Gestió Professionals</h1>

                    <div class="flex space-x-3">
                        <a href="{{ route('professionals.exportar-locker') }}"
                           class="text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                                  transition-all duration-300 rounded-4xl px-5 py-2 text-center">
                            Exportar guixetes
                        </a>
                        <a href="{{ route('professionals.exportar-historial-uniforms') }}"
                           class="text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                                  transition-all duration-300 rounded-4xl px-5 py-2 text-center">
                            Exportar historial uniforms
                        </a>
                        <a href="{{ route('professionals.exportar-uniforms') }}"
                           class="text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                                  transition-all duration-300 rounded-4xl px-5 py-2 text-center">
                            Exportar uniforms
                        </a>
                    </div>
                </div>

                {{-- Listado de professionals --}}
                @foreach ($professionals as $professional)
                    <div class="professional-info w-4/5 bg-white flex rounded-3xl p-5 my-3 border border-[#FF7400]
                                justify-between shadow-md hover:scale-105 transition-all duration-400">
                        <div id="{{ $professional->id }}" class="professional flex items-center cursor-pointer">
                            <svg class="w-8 h-8 txt-orange mr-3">
                                <use xlink:href="#professional_icon"></use>
                            </svg>
                            <p class="txt-orange text-lg">
                                {{ $professional->name }} {{ $professional->surnames }}
                            </p>

                            <input type="text" value="{{ $professional->id }}" class="hidden">
                            <input type="text" value="{{ $professional->name }}" class="hidden">
                            <input type="text" value="{{ $professional->surnames }}" class="hidden">
                            <input type="text" value="{{ $professional->phone_number }}" class="hidden">
                            <input type="text" value="{{ $professional->email_address }}" class="hidden">
                            <input type="text" value="{{ $professional->address }}" class="hidden">
                            <input type="text" value="{{ $professional->status }}" class="hidden">
                        </div>

                        <div class="flex items-center space-x-4">
                            @if ($professional->status == 'inactive')
                                <form action="{{ route('professional.activate', $professional) }}" method="GET">
                                    @csrf
                                    <button id="activate_desactivate_btn"
                                            class="bg-white text-[#FF7400] border border-[#FF7400]
                                                   rounded-full px-5 py-2 shadow-md hover:bg-[#FF7400]
                                                   hover:text-white transition">
                                        active
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('professional.activate', $professional) }}" method="GET">
                                    @csrf
                                    <button id="activate_desactivate_btn"
                                            class="bg-[#FF7400] text-white border border-[#FF7400]
                                                   rounded-full px-5 py-2 shadow-md hover:bg-white
                                                   hover:text-[#FF7400] transition">
                                        inactive
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('professional.edit', $professional) }}" title="Editar dades professional">
                                <svg class="w-8 h-8 txt-orange">
                                    <use xlink:href="#edit_icon"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach

                {{-- Botón para añadir profesional --}}
                <a href="{{ route('professional.create') }}"
                   class="text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                          transition-all duration-300 rounded-3xl px-5 py-2 mt-5">
                    afegir professional
                </a>

                {{-- Panel lateral (flotante) con información del profesional --}}
                <div id="professional-info"
                     class="hidden absolute top-1/4 right-20 w-1/4 bg-white rounded-3xl p-6 border border-[#FF7400]
                            shadow-lg text-center flex-col items-center transition-all duration-300">
                    <svg class="w-32 h-32 txt-orange mb-3">
                        <use xlink:href="#professional_icon"></use>
                    </svg>
                    <h2 id="info-name" class="text-2xl font-bold text-[#FF7400] mb-3"></h2>
                    <p id="info-email" class="text-gray-600 mb-1"></p>
                    <p id="info-phone" class="text-gray-600 mb-1"></p>
                    <p id="info-status" class="text-gray-600 mb-4"></p>
                    <a id="give-uniform" href=""
                       class="text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                              transition-all duration-300 rounded-3xl px-5 py-2">
                        Afegir uniforme
                    </a>
                </div>
            </section>
        </main>

        @include('components.footer')
    @endauth

    @guest
        <h1>No has iniciat sessió.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>
