<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Professionals</title>
    @vite(['resources/css/app.css', 'resources/js/professional_info.js'])
</head>

<body class="min-h-screen flex flex-col bg-[#E9EDF2]">
    @include('partials.icons')
    @auth
        @include('components.navbar')

        <main class="flex w-full flex-1">
            
            @include('components.sidebar')
            @yield('contingut')
            <section id="principal-content" class="w-full flex flex-col items-center">
                <div class="w-11/12 border-b-4 border-[#213c57] flex items-center justify-between py-4">
                    <h1 class="text-[#2D3E50] text-4xl pt-7 pb-1 w-4/5">Gestió Professionals</h1>
                    {{-- Botón para añadir profesional --}}
                    <a href="{{ route('professional.create') }}"
                    class="flex items-center text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                                transition-all duration-300 rounded-xl px-5 py-2 text-center h-3/4">
                         
                        <svg class="w-6 h-6 mr-2">
                            <use xlink:href="#add_prof_icon"></use>
                        </svg>
                        Afegir professional
                    </a>
                </div>
                
                <h3 class="text-[#384452a1] text-xl w-11/12 py-3">Adminsitració i seguiment dels professionals del centre</h3>
                <div class="flex space-x-3 w-11/12 items-center justify-between">
                    <div>
                        <a href="{{ route('professionals.exportar-locker') }}"
                           class="text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                                  transition-all duration-300 rounded-xl px-5 py-2 text-center m-2">
                            Exportar guixetes
                        </a>
                        <a href="{{ route('professionals.exportar-historial-uniforms') }}"
                           class="text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                                  transition-all duration-300 rounded-xl px-5 py-2 text-center m-2">
                            Exportar historial uniforms
                        </a>
                        <a href="{{ route('professionals.exportar-uniforms') }}"
                           class="text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                                  transition-all duration-300 rounded-xl px-5 py-2 text-center m-2">
                            Exportar uniforms
                        </a>
                    </div>
                    <div class="rounded-xl">
                        @if ($status == 'active')
                            <a href="{{ route('professional.index', ['status' => 'inactive']) }}"
                            class="px-6 py-4 bg-red-500 text-white m-2 rounded-lg" >
                                Mostrar inactius
                            </a>
                        @else
                            <a href="{{ route('professional.index', ['status' => 'active']) }}"
                            class="px-6 py-4 bg-green-500 text-white rounded-lg m-2">
                                Mostrar actius
                            </a>
                        @endif
                    </div>
                </div>
                {{-- Listado de professionals --}}
                <div class="w-11/12 flex items-center flex-col mt-8 bg-[#fef2e6] p-10 rounded-xl overflow-auto h-[60vh]" id="prof-info-container">
                    @foreach ($professionals as $professional)
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
                                                    rounded-xl px-5 py-2 shadow-md hover:bg-[#BBF7D0]
                                                    transition cursor-pointer">
                                            Activar
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('professional.activate', $professional) }}" method="GET">
                                        @csrf
                                        <button class="bg-[#FEE2E2] text-[#DC2626]
                                                    rounded-xl px-5 py-2 shadow-md hover:bg-[#FECACA]
                                                    transitio cursor-pointer">
                                            Desactivar
                                        </button>
                                    </form>
                                @endif
                                <!--link dropdown: https://tailwindcss.com/plus/ui-blocks/application-ui/elements/dropdowns-->
                                <div class="w-4/5 flex">
                                    <el-dropdown class="inline-block rounded-tl-xl rounded-bl-xl">
                                        <button class="text-white flex items-center rounded-tl-xl rounded-bl-xl w-full justify-center gap-x-1.5  bg-[#ff7300] px-3 py-2 text-sm font-semibold shadow-xs inset-ring-1  hover:bg-[#FEAB51]">
                                            Opcions de professional
                                            <svg class="w-7 h-7 text-white">
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

                                                <a href="{{ route('professionals.accidents.index', $professional) }}" class="flex txt-orange items-center px-4 py-4 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                                                    <svg class="w-5 h-5 txt-orange mr-2">
                                                        <use xlink:href="#evaluations_icon"></use>
                                                    </svg>
                                                    Accidentabilitat
                                                </a>
        
                                            </div>
                                        </el-menu>
                                    </el-dropdown>
                                    <a href="{{ route('professional.edit', $professional) }}" title="Editar dades professional" class="border border-[#ff7300] rounded-tr-xl rounded-br-xl gap-x-1.5 px-3 py-2 transition ease-in duration-200 hover:bg-[#ffa65d91]">
                                        <svg class="w-6 h-6 txt-orange ">
                                            <use xlink:href="#edit_icon"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


                {{-- Panel lateral (flotante) con información del profesional --}}
                <div id="professional-info"
                     class="hidden translate-y-5 absolute top-[48%] right-35  bg-white rounded-2xl p-6 border border-[#FF7400]
                        shadow-lg flex-col items-center transition-all duration-200 ease-out animate-slide-in w-[18%]">
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
