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
                        <h1 class="text-[#2D3E50] text-4xl pt-7 pb-1 w-4/5">Gestió Serveis Generals</h1>
                    </div>
                                        
                    <div class="w-11/12 flex items-center mt-8 bg-[#fef2e6] p-10 rounded-xl overflow-auto h-[60vh]">
                        @foreach ($services as $service)
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
                                                        <div id="service-info" class="flex txt-orange items-center px-4 py-4 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                                                            <svg class="w-5 h-5 txt-orange mr-2">
                                                                <use xlink:href="#evaluations_icon"></use>
                                                            </svg>
                                                            Veure servei
                                                        </div>
                                                        
                                                    
                                                    <a href="{{ route('monitoring.monitorings', $service) }}" class="flex txt-orange items-center px-4 py-4 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                                                        <svg class="w-5 h-5 txt-orange mr-2">
                                                            <use xlink:href="#evaluations_icon"></use>
                                                        </svg>
                                                        Editar Servei
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
                    <div id="view-service" class="hidden flex-col items-center h-11/12 w-3/5 bg-white rounded-3xl shadow-black-500 shadow-2xl absolute left-[30%] p-10 overflow-y-auto">
                        <div class="flex justify-between items-center mb-6 w-full">
                            <h2 class="text-2xl font-bold txt-orange">Detalls del servei</h2>
                            <button id="close_view_monitoring" class="txt-orange text-xl font-bold hover:text-orange-700">✕</button>
                        </div>

                        <div class="space-y-6 w-full">
                            <div>
                                <p class="txt-orange font-semibold uppercase text-sm">Manager:</p>
                                <div id="view_monitoring_by" class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-700 font-medium mt-1">—</div>
                            </div>

                            <div class="w-full">
                                <p class="txt-orange font-semibold uppercase text-sm">Contacte:</p>
                                <div id="view_professional_name" class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-700 font-medium mt-1">—</div>
                            </div>

                            
                            <div>
                                <p class="txt-orange font-semibold uppercase text-sm">Personal:</p>
                                <div id="view_monitoring_comments" class="bg-gray-200 rounded-2xl p-4 mt-2 text-gray-800 leading-relaxed">
                                    —
                                </div>
                            </div>
                            <div>
                                <p class="txt-orange font-semibold uppercase text-sm">Horaris:</p>
                                <div id="view_monitoring_comments" class="bg-gray-200 rounded-2xl p-4 mt-2 text-gray-800 leading-relaxed">
                                    —
                                </div>
                            </div>
                        </div>
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