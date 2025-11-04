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
                <h1 class="text-[#2D3E50] text-4xl pt-7 pb-1 w-4/5 border-b-4">Gestió Professionals</h1>
                <h3 class="text-[#384452a1] text-xl w-4/5 py-3">Adminsitració i seguiment dels professionals del centre</h3>
                <div class="flex space-x-3 w-4/5">
                        <a href="{{ route('professionals.exportar-locker') }}"
                           class="text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                                  transition-all duration-300 rounded-xl px-5 py-2 text-center">
                            Exportar guixetes
                        </a>
                        <a href="{{ route('professionals.exportar-historial-uniforms') }}"
                           class="text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                                  transition-all duration-300 rounded-xl px-5 py-2 text-center">
                            Exportar historial uniforms
                        </a>
                        <a href="{{ route('professionals.exportar-uniforms') }}"
                           class="text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                                  transition-all duration-300 rounded-xl px-5 py-2 text-center">
                            Exportar uniforms
                        </a>
                </div>

                {{-- Listado de professionals --}}
                <div class="w-4/5 flex items-center flex-col mt-8" id="prof-info-container">
                    @foreach ($professionals as $professional)
                        <div class="professional-info w-full bg-white flex rounded-3xl p-5 my-3 border border-[#FF7400]
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
                                        <button class="bg-[#DCFCE7] text-[#16A34A]
                                                    rounded-full px-5 py-2 shadow-md hover:bg-[#BBF7D0]
                                                    transition">
                                            active
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('professional.activate', $professional) }}" method="GET">
                                        @csrf
                                        <button class="bg-[#FEE2E2] text-[#DC2626]
                                                    rounded-full px-5 py-2 shadow-md hover:bg-[#FEE2E2]
                                                    transition">
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
                </div>
                {{-- Botón para añadir profesional --}}
                <a href="{{ route('professional.create') }}"
                   class="fixed bottom-6 right-6 text-lg text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                          transition-all duration-300 rounded-2xl px-7 py-4 mt-5">
                    + Afegir professional
                </a>

                {{-- Panel lateral (flotante) con información del profesional --}}
                <div id="professional-info"
                     class="hidden  translate-y-5 absolute top-[15%] right-40 w-1/4 bg-white rounded-3xl p-6 border border-[#FF7400]
                        shadow-lg flex-col items-center transition-all duration-200 ease-out animate-slide-in">
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
