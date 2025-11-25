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

        <main class="flex w-full flex-1">
            
            @include('components.sidebar')
            @yield('contingut')
            <section id="principal-content" class="w-full flex flex-col items-center">
                <h1 class="text-[#2D3E50] text-4xl pt-7 pb-1 w-4/5 border-b-4 border-[#213c57]">Gestió Professionals</h1>
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
                <div class="w-4/5 flex items-center flex-col mt-8 bg-black p-10 rounded-2xl overflow-auto h-[100vh]" id="prof-info-container">
                    @foreach ($professionals as $professional)
                        @if ($professional->status=="active")
                            <div class="professional-info w-full bg-white flex rounded-3xl p-5 my-3 border border-[#FF7400]
                                    justify-between shadow-md hover:scale-102 transition-all duration-400">
                                <div id="{{$professional->id}}" class="professional flex items-center cursor-pointer">
                                    <svg class="w-10 h-10 txt-orange mr-3">
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
                                    <input type="text" value="{{ $professional->link_status }}" class="hidden">
                                </div>

                                <div class="flex items-center space-x-4">
                                    @if ($professional->status == 'inactive')
                                        <form action="{{ route('professional.activate', $professional) }}" method="GET">
                                            @csrf
                                            <button class="bg-[#DCFCE7] text-[#16A34A]
                                                        rounded-full px-5 py-2 shadow-md hover:bg-[#BBF7D0]
                                                        transition cursor-pointer">
                                                Activar
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('professional.activate', $professional) }}" method="GET">
                                            @csrf
                                            <button class="bg-[#FEE2E2] text-[#DC2626]
                                                        rounded-full px-5 py-2 shadow-md hover:bg-[#FECACA]
                                                        transitio cursor-pointer">
                                                Desactivar
                                            </button>
                                        </form>
                                    @endif
                                    <!--link dropdown: https://tailwindcss.com/plus/ui-blocks/application-ui/elements/dropdowns-->
                                    <el-dropdown class="inline-block">
                                        <button class="txt-orange flex items-center justify-center w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring-1  hover:bg-gray-50">
                                            Opcions de professionals
                                            <svg class="w-7 h-7 txt-orange">
                                                <use xlink:href="#dropdown_arrow"></use>
                                            </svg>
                                        </button>

                                        <el-menu anchor="bottom end" popover class="w-56 origin-top-right rounded-md bg-white shadow-lg outline-1 outline-black/5 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
                                            <div class="py-1">
                                                <a href="{{ route('professionals.evaluations', $professional->id) }}" class="flex txt-orange items-center px-4 py-4 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                                                    <svg class="w-5 h-5 txt-orange mr-2">
                                                        <use xlink:href="#see_evaluations"></use>
                                                    </svg>
                                                    Veure/Fer Avaluacions
                                                </a>
                                                <a href="{{ route('monitoring.monitorings', $professional->id) }}" class="flex txt-orange items-center px-4 py-4 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                                                    <svg class="w-5 h-5 txt-orange mr-2">
                                                        <use xlink:href="#evaluations_icon"></use>
                                                    </svg>
                                                    Veure/Fer Seguiments
                                                </a>
        
                                            </div>
                                        </el-menu>
                                    </el-dropdown>
                                    <a href="{{ route('professional.edit', $professional) }}" title="Editar dades professional" class="border border-[#ff7300] rounded-full p-2 transition ease-in duration-200 hover:bg-[#ffa65d91]">
                                        <svg class="w-8 h-8 txt-orange ">
                                            <use xlink:href="#edit_icon"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endif
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
    @endauth

    @guest
        <h1>No has iniciat sessió.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>
