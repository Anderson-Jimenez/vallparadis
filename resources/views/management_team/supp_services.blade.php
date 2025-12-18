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
                        <h1 class="text-[#2D3E50] text-4xl pt-7 pb-1 w-4/5">Gestió Serveis Complementaris</h1>
                        {{-- Botón para añadir profesional --}}
                        <a href="{{ route('supplementary_service.create') }}"
                        class="flex items-center text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                                    transition-all duration-300 rounded-xl px-5 py-2 text-center h-3/4">
                            
                            <svg class="w-6 h-6 mr-2">
                                <use xlink:href="#add_prof_icon"></use>
                            </svg>
                            Afegir servei complementari
                        </a>
                    </div>
                                        
                    <div class="w-11/12 flex items-center mt-8 bg-[#fef2e6] p-10 rounded-xl overflow-auto h-[60vh]">
                        @foreach ($supp_services as $service)
                            <div class="w-full bg-white flex rounded-3xl p-5 my-3 border border-[#FF7400]
                                    justify-between shadow-md hover:scale-102 transition-all duration-400">
                                <div id="{{$service->id}}" class=" flex items-center cursor-pointer">

                                    <p class="txt-orange text-lg">
                                        {{$service->type}}
                                    </p>

                                    
                                    
                                    <div class="w-4/5 flex">
                                        <el-dropdown class="inline-block rounded-tl-xl rounded-bl-xl">
                                            <button class="text-white flex items-center rounded-tl-xl rounded-bl-xl w-full justify-center gap-x-1.5  bg-[#ff7300] px-3 py-2 text-sm font-semibold shadow-xs inset-ring-1  hover:bg-[#FEAB51]">
                                                Opcions de servei
                                                <svg class="w-7 h-7 text-white">
                                                    <use xlink:href="#dropdown_arrow"></use>
                                                </svg>
                                            </button>

                                            <el-menu anchor="bottom end" popover class="w-56 origin-top-right rounded-md bg-white shadow-lg outline-1 outline-black/5 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
                                                <div class="py-1">
                                                    <div class="supp-service-info flex txt-orange items-center px-4 py-4 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden"
                                                        data-type="{{ $service->type }}"
                                                        data-start_date="{{ $service->start_date }}"
                                                        data-manager="{{ $service->manager }}"
                                                        data-email_address="{{ $service->email_address }}"
                                                        data-phone_number="{{ $service->phone_number }}"
                                                        data-comments="{{ $service->comments }}">
                                                        <svg class="w-5 h-5 txt-orange mr-2">
                                                            <use xlink:href="#evaluations_icon"></use>
                                                        </svg>
                                                        Veure servei
                                                    </div>

                                                    <div class="edit-supp-service flex txt-orange items-center px-4 py-4 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden"
                                                        data-id="{{ $service->id }}"
                                                        data-type="{{ $service->type }}"
                                                        data-start_date="{{ $service->start_date }}"
                                                        data-manager="{{ $service->manager }}"
                                                        data-email_address="{{ $service->email_address }}"
                                                        data-phone_number="{{ $service->phone_number }}"
                                                        data-comments="{{ $service->comments }}">
                                                        <svg class="w-5 h-5 txt-orange mr-2">
                                                            <use xlink:href="#evaluations_icon"></use>
                                                        </svg>
                                                        Editar Servei
                                                    </div>
                                                    <a href="{{ route('supplementary_service_followup.index', $service) }}" class="followup-service flex txt-orange items-center px-4 py-4 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                                                        <svg class="w-5 h-5 txt-orange mr-2">
                                                            <use xlink:href="#evaluations_icon"></use>
                                                        </svg>
                                                        Fer/Veure seguiments
                                                    </a>
                                                    
                                                    
                                                    
            
                                                </div>
                                            </el-menu>
                                        </el-dropdown>
                                        
                                    </div>
                                </div>
                                
                            </div>
                            
                        @endforeach
                    </div>
                    {{-- DETALLES DEL INFORME (OCULTO) --}}
                    <div id="view-supp-service" class="hidden flex-col items-center h-3/5 w-1/4 bg-white rounded-3xl shadow-black-500 shadow-2xl absolute left-[30%] p-10 overflow-y-auto">
                        <div class="flex justify-between items-center mb-6 w-full">
                            <h2 class="text-2xl font-bold txt-orange">Detalls del servei</h2>
                            <button id="close_view_supp_service" class="txt-orange text-xl font-bold hover:text-orange-700">✕</button>
                        </div>

                        <div class="space-y-6 w-full">
                            <div>
                                <p class="txt-orange font-semibold uppercase text-sm">Nom servei:</p>
                                <div id="view_type" class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-700 font-medium mt-1">—</div>
                            </div>
                            <div>
                                <p class="txt-orange font-semibold uppercase text-sm">Data d'inici:</p>
                                <div id="view_start_date" class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-700 font-medium mt-1">—</div>
                            </div>
                            <div>
                                <p class="txt-orange font-semibold uppercase text-sm">Manager:</p>
                                <div id="view_manager" class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-700 font-medium mt-1">—</div>
                            </div>

                            <div class="w-full">
                                <p class="txt-orange font-semibold uppercase text-sm">Contacte:</p>
                                <div id="view_email_address" class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-700 font-medium mt-1">—</div>
                            </div>

                            
                            <div>
                                <p class="txt-orange font-semibold uppercase text-sm">Telefon:</p>
                                <div id="view_phone_number" class="bg-gray-200 rounded-2xl p-4 mt-2 text-gray-800 leading-relaxed">
                                    —
                                </div>
                            </div>
                            <div>
                                <p class="txt-orange font-semibold uppercase text-sm">Comentaris:</p>
                                <div id="view_comments" class="bg-gray-200 rounded-2xl p-4 mt-2 text-gray-800 leading-relaxed">
                                    —
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="edit_supp_service" class="hidden h-11/12 w-3/5 bg-white rounded-3xl shadow-black-500 shadow-2xl absolute left-[30%] p-10">
                        <form id="edit_supp_service_form" action="" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('PUT')
                            <div class="flex justify-between items-center mb-6 w-full">
                                <h2 class="text-2xl font-bold txt-orange">Editar Servei</h2>
                                <button id="close_edit_supp_service" type="button" class="txt-orange text-xl font-bold hover:text-orange-700">✕</button>
                            </div>
                            <div>
                                <p class="text-orange-500 font-semibold uppercase text-sm">Nom servei:</p>
                                <div class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-700 font-medium mt-1">
                                    <input type="text" name="type" value="">
                                </div>
                                
                            </div>
                            <div>
                                <p class="text-orange-500 font-semibold uppercase text-sm">Data d'inici</p>
                                <div class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-700 font-medium mt-1">
                                    <input type="date" name="start_date" value="">
                                </div>
                                
                            </div>            
                            <div>
                                <p class="text-orange-500 font-semibold uppercase text-sm">Manager</p>
                                <div class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-700 font-medium mt-1">
                                    <input type="text" name="manager" value="">
                                </div>
                                
                            </div>

                            
                            <div>
                                <p class="text-orange-500 font-semibold uppercase text-sm">Email:</p>
                                <div class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-700 font-medium mt-1">
                                    <input type="text" name="email_address" value="">
                                </div>
                                
                            </div>

                            

                            <div>
                                <p class="text-orange-500 font-semibold uppercase text-sm">Telefon:</p>
                                <div class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-700 font-medium mt-1">
                                    <input type="text" name="phone_number" value="">
                                </div>
                                
                            </div>
                            <div>
                                <label class="text-orange-500 font-semibold uppercase text-sm">Comentaris:</label>
                                <textarea name="comments" rows="6" class="w-full bg-gray-200 rounded-2xl px-4 py-3 mt-2 text-gray-800 border-none focus:ring-2 focus:ring-orange-400" ></textarea>
                            </div>

                            <button type="submit"
                                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-full transition-all">
                                    Guardar
                            </button>
                            
                        </form>     
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