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
            @include('components.sidebar')

            <section id="principal-content" class="w-4/5 flex items-center">
                <aside class="bg-white relative left-20 flex flex-col items-center justify-center w-1/4 text-center border-2 border-[#FF7400] h-[70%] rounded-2xl">
                    <svg class="w-40 h-40 txt-orange">
                        <use xlink:href="#professional_icon"></use>
                    </svg>
                    <h2 class="txt-orange text-3xl py-3">{{ $professional->name }} {{ $professional->surnames }}</h3>
                    <h3 class="text-[#2D3E50] text-xl my-2">{{ $professional->email_address }}</h3>
                    <h3 class="text-[#2D3E50] text-xl my-2">{{ $professional->address }}</h3>
                    <h3 class="text-[#2D3E50] text-xl my-2">{{ $professional->phone_number }}</h3>

                    @if ($professional->status != 'inactive')      
                        <button class="bg-[#DCFCE7] text-[#16A34A]
                                    rounded-full px-7 py-2 shadow-md hover:bg-[#BBF7D0]
                                    transition  my-2">
                            Actiu
                        </button>                 
                    @else                    
                        <button class="bg-[#FEE2E2] text-[#DC2626]
                                rounded-full px-7 py-2 shadow-md hover:bg-[#FECACA]
                                transition my-2">
                            Inactiu
                        </button>
                    @endif
                </aside>
                <div id="monitoring_section" class="bg-white w-3/5 relative m-10 left-20 rounded-2xl border-2 border-[#FF7400] items-center h-4/5">
                    <div class="w-full flex justify-end ">
                        <button id="add_monitoring_btn"
                            class="text-lg text-white bg-[#ff7300] hover:bg-[#ff73008a]
                            transition-all duration-300 rounded-2xl px-7 py-4 mt-5 mr-5">
                            + Nou seguiment
                        </button>
                    </div>
                    <div class="w-full flex items-center  flex-col mt-8" id="prof-info-container">      
                        @foreach ($monitoring as $professional_monitoring)
                            <div class="monitoring-info w-11/12 bg-white flex rounded-3xl p-5 my-3 border border-[#FF7400]
                                        justify-between shadow-md hover:scale-102 transition-all duration-400 cursor-pointer">
                                <div id="{{$professional_monitoring->professional_id}}" class="monitoring flex items-center ">
                                    <svg class="w-10 h-10 txt-orange mr-3">
                                        <use xlink:href="#documentation_icon"></use>
                                    </svg>
                                    <p class="txt-orange text-lg">
                                        {{ $professional_monitoring->issue }}#{{ $professional_monitoring->id }}
                                    </p>

                                
                                </div>
                                <div class="flex items-center mr-10">   
                                    <p class="txt-orange text-lg">
                                        {{ $professional_monitoring->date }}
                                    </p>
                                </div>
                                <input type="text" value="{{ $professional_monitoring->issue }}#{{ $professional_monitoring->id }}" class="hidden">
                                <input type="text" value="{{ $professional_monitoring->name }}" class="hidden">
                                <input type="text" value="{{ $professional_monitoring->type }}" class="hidden">
                                <input type="text" value="{{ $professional_monitoring->date }}" class="hidden">
                                <input type="text" value="{{ $professional_monitoring->issue }}" class="hidden">
                                <input type="text" value="{{ $professional_monitoring->comments }}" class="hidden">
                            </div>
                        @endforeach
                    </div>
                    <div class="w-full flex justify-around mt-6 mb-4">
                        {{ $monitoring->links('pagination::tailwind') }}
                    </div>
                    

                </div>
                <div id="add_monitoring" class="hidden h-11/12 w-3/5 bg-white rounded-3xl shadow-black-500 shadow-2xl absolute left-[30%] p-10">
                    <form action="{{ route('monitoring.store',$professional) }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="flex justify-between items-center mb-6 w-full">
                            <h2 class="text-2xl font-bold txt-orange">Nou informe</h2>
                            <button id="close_add_monitoring" class="txt-orange text-xl font-bold hover:text-orange-700">✕</button>
                        </div>            
                        <div>
                            <p class="text-orange-500 font-semibold uppercase text-sm">Realitzat per:</p>
                            <div class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-700 font-medium mt-1">
                                {{ Auth::user()->name }}
                            </div>
                            <input type="hidden" name="professional_monitoring_id" value="{{ Auth::user()->id }}">
                        </div>

                        
                        <div>
                            <p class="text-orange-500 font-semibold uppercase text-sm">Professional valorat:</p>
                            <div class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-700 font-medium mt-1">
                                {{ $professional->name }} 
                            </div>
                            <input type="hidden" name="professional_id" value="{{ $professional->id }}">
                        </div>

                        <div class="flex">
                            <div>
                                <label class="text-orange-500 font-semibold uppercase text-sm">Data de l'informe</label>
                                <input type="date" name="date"
                                    class="mr-3 w-full bg-gray-200 rounded-full px-4 py-2 mt-1 text-gray-800 border-none focus:ring-2 focus:ring-orange-400"
                                    value="{{ now()->format('Y-m-d') }}" required>
                            </div>

                            <div>
                                <label class="text-orange-500 font-semibold uppercase text-sm">Tipus d'informe</label>
                                <input type="text" name="type"
                                    class="mx-3 w-full bg-gray-200 rounded-full px-4 py-2 mt-1 text-gray-800 border-none focus:ring-2 focus:ring-orange-400"
                                    placeholder="Ex: Obert, tancat..." required>
                            </div>

                            <div>
                                <label class="text-orange-500 font-semibold uppercase text-sm">Raó de l'informe</label>
                                <input type="text" name="issue"
                                    class="mx-3 w-full bg-gray-200 rounded-full px-4 py-2 mt-1 text-gray-800 border-none focus:ring-2 focus:ring-orange-400"
                                    placeholder="Motiu / situació observada" required>
                            </div>
                        </div>

                        <div>
                            <label class="text-orange-500 font-semibold uppercase text-sm">Descripció de l'informe</label>
                            <textarea name="comments" rows="6"
                                    class="w-full bg-gray-200 rounded-2xl px-4 py-3 mt-2 text-gray-800 border-none focus:ring-2 focus:ring-orange-400"
                                    placeholder="Detalla aquí l'observació o seguiment realitzat..." required></textarea>
                        </div>

                        <button type="submit"
                                class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-full transition-all">
                                Guardar Seguiment
                        </button>
                        
                    </form>     
                </div>
                {{-- DETALLES DEL INFORME (OCULTO) --}}
                <div id="view-monitoring" class="hidden flex-col items-center h-11/12 w-3/5 bg-white rounded-3xl shadow-black-500 shadow-2xl absolute left-[30%] p-10 overflow-y-auto">
                    <div class="flex justify-between items-center mb-6 w-full">
                        <h2 class="text-2xl font-bold txt-orange">Detalls de l'informe</h2>
                        <button id="close_view_monitoring" class="txt-orange text-xl font-bold hover:text-orange-700">✕</button>
                    </div>

                    <div class="space-y-6 w-full">
                        <div>
                            <p class="txt-orange font-semibold uppercase text-sm">Realitzat per:</p>
                            <div id="view_monitoring_by" class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-700 font-medium mt-1">—</div>
                        </div>

                        <div class="w-full">
                            <p class="txt-orange font-semibold uppercase text-sm">Professional valorat:</p>
                            <div id="view_professional_name" class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-700 font-medium mt-1">—</div>
                        </div>

                        <div class="flex w-full">
                            <div class="mr-4">
                                <p class="txt-orange font-semibold uppercase text-sm">ID de l'informe</p>
                                <div id="view_monitoring_id" class="bg-gray-200 rounded-full px-4 py-1 font-semibold text-gray-800 mt-1">—</div>
                            </div>
                            <div class="m-4">
                                <p class="txt-orange font-semibold uppercase text-sm">Data de l'informe</p>
                                <div id="view_monitoring_date" class="bg-gray-200 rounded-full px-4 py-1 font-semibold text-gray-800 mt-1">—</div>
                            </div>
                            <div class="ml-4">
                                <p class="txt-orange font-semibold uppercase text-sm">Tipus d'informe</p>
                                <div id="view_monitoring_type" class="bg-gray-200 rounded-full px-4 py-1 font-semibold text-gray-800 mt-1">—</div>
                            </div>
                        </div>

                        <div>
                            <p class="txt-orange font-semibold uppercase text-sm">Raó de l'informe:</p>
                            <div id="view_monitoring_issue" class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-800 font-medium mt-1">—</div>
                        </div>

                        <div>
                            <p class="txt-orange font-semibold uppercase text-sm">Descripció de l'informe:</p>
                            <div id="view_monitoring_comments" class="bg-gray-200 rounded-2xl p-4 mt-2 text-gray-800 leading-relaxed">
                                —
                            </div>
                        </div>
                    </div>
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