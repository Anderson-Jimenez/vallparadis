<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Curs</title>
    @vite("resources/css/app.css")

</head>
<body id="bd" class="min-h-screen flex flex-col bg-[#E9EDF2]">
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
                    </div>
                                        
                    <div class="w-11/12 flex items-center mt-8 bg-[#fef2e6] p-10 rounded-xl overflow-auto h-[60vh]">
                        @foreach ($services as $service)
                            <div id="{{$service->id}}" class="w-1/2 h-[30vh] bg-white flex items-center rounded-3xl p-5 m-3 border border-[#FF7400]
                                justify-between shadow-md hover:scale-102 transition-all duration-400">
                                
                                <p class="txt-orange text-xl font-bold ">
                                    {{$service->type}}
                                </p>
                                <el-dropdown class="inline-block rounded-tl-xl rounded-bl-xl">
                                    <button class="text-white flex items-center rounded-tl-xl rounded-xl w-full justify-center gap-x-1.5  bg-[#ff7300] px-3 py-2 text-sm font-semibold shadow-xs inset-ring-1  hover:bg-[#FEAB51]">
                                        Opcions de servei
                                        <svg class="w-7 h-7 text-white">
                                            <use xlink:href="#dropdown_arrow"></use>
                                        </svg>
                                    </button>

                                    <el-menu anchor="bottom end" popover class="w-56 origin-top-right rounded-md bg-white shadow-lg outline-1 outline-black/5 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
                                        <div class="py-1">
                                            <div class="service-info flex txt-orange items-center px-4 py-4 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden"
                                                data-manager="{{ $service->manager }}"
                                                data-contact="{{ $service->contact }}"
                                                data-staff="{{ $service->staff }}"
                                                data-schedule="{{ $service->schedule }}">
                                                <svg class="w-5 h-5 txt-orange mr-2">
                                                    <use xlink:href="#see_evaluations"></use>
                                                </svg>
                                                Veure servei
                                            </div>

                                            <div class="edit-service flex txt-orange items-center px-4 py-4 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden"
                                                data-id="{{ $service->id }}"
                                                data-manager="{{ $service->manager }}"
                                                data-contact="{{ $service->contact }}"
                                                data-staff="{{ $service->staff }}"
                                                data-schedule="{{ $service->schedule }}">
                                                <svg class="w-5 h-5 txt-orange mr-2">
                                                    <use xlink:href="#edit_icon"></use>
                                                </svg>
                                                Editar Servei
                                            </div>
                                            <a href="{{ route('general_service_followup.index', $service) }}" class="followup-service flex txt-orange items-center px-4 py-4 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                                                <svg class="w-5 h-5 txt-orange mr-2">
                                                    <use xlink:href="#evaluations_icon"></use>
                                                </svg>
                                                Fer/Veure seguiments
                                            </a>

                                        </div>
                                    </el-menu>
                                </el-dropdown>
                            </div>
                            
                        @endforeach
                    </div>
                    {{-- DETALLES DEL INFORME (OCULTO) --}}
                    <div id="view-service" class="hidden flex-col items-center h-3/5 w-2/6 bg-white rounded-3xl shadow-black-500 shadow-2xl absolute left-[40%] p-10 overflow-y-auto">
                        <div class="flex justify-between items-center mb-6 w-full">
                            <h2 class="text-2xl font-bold txt-orange">Detalls del servei</h2>
                            <button id="close_view_general_service" class="txt-orange text-xl font-bold hover:text-orange-700">✕</button>
                        </div>

                        <div class="space-y-6 w-full">
                            <div>
                                <p class="txt-orange font-semibold uppercase text-sm">Manager:</p>
                                <div id="view_manager" class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-700 font-medium mt-1">—</div>
                            </div>

                            <div class="w-full">
                                <p class="txt-orange font-semibold uppercase text-sm">Contacte:</p>
                                <div id="view_contact" class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-700 font-medium mt-1">—</div>
                            </div>

                            
                            <div>
                                <p class="txt-orange font-semibold uppercase text-sm">Personal:</p>
                                <div id="view_staff" class="bg-gray-200 rounded-2xl p-4 mt-2 text-gray-800 leading-relaxed">
                                    —
                                </div>
                            </div>
                            <div>
                                <p class="txt-orange font-semibold uppercase text-sm">Horaris:</p>
                                <div id="view_schedule" class="bg-gray-200 rounded-2xl p-4 mt-2 text-gray-800 leading-relaxed">
                                    —
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="edit_general_service" class="hidden h-4/5 w-2/6 bg-white rounded-3xl shadow-black-500 shadow-2xl absolute left-[40%] p-10">
                        <form id="edit_service_form" action="" method="POST" class="space-y-6 w-full">
                            @csrf
                            @method('PUT')
                            <div class="flex justify-between items-center mb-6 w-full">
                                <h2 class="text-2xl font-bold txt-orange">Editar Servei</h2>
                                <button id="close_edit_general_service" type="button" class="txt-orange text-xl font-bold hover:text-orange-700">✕</button>
                            </div>            
                            <div class="w-full">
                                <p class="text-orange-500 font-semibold uppercase text-sm">Manager</p>
                                <div class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-700 font-medium mt-1">
                                    <input type="text" name="manager" value="">
                                </div>
                                
                            </div>

                            
                            <div class="w-full">
                                <p class="text-orange-500 font-semibold uppercase text-sm">Contacte</p>
                                <div class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-700 font-medium mt-1">
                                    <input type="text" name="contact" value="">
                                </div>
                                
                            </div>

                            

                            <div class="w-full">
                                <label class="text-orange-500 font-semibold uppercase text-sm">Personal</label>
                                <textarea name="staff" rows="6" 
                                        class="w-full bg-gray-200 rounded-2xl px-4 py-3 mt-2 text-gray-800 border-none focus:ring-2 focus:ring-orange-400" >
                                </textarea>
                            </div>
                            <div class="w-full">
                                <label class="text-orange-500 font-semibold uppercase text-sm">Horaris</label>
                                <textarea name="schedule" rows="6"
                                        class="w-full bg-gray-200 rounded-2xl px-4 py-3 mt-2 text-gray-800 border-none focus:ring-2 focus:ring-orange-400" >
                                    </textarea>
                            </div>

                            <button type="submit"
                                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-full transition-all">
                                    Guardar
                            </button>
                            
                        </form>     
                    </div>
                </section>
            
        </main>
        <div id="overlay"
            class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-40">
        </div>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>