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
                    
                    <h2 class="txt-orange text-3xl py-3">{{ $general_service->manager }}</h3>
                    <h3 class="text-[#2D3E50] text-xl my-2">{{ $general_service->contact }}</h3>
                    <h3 class="text-[#2D3E50] text-xl my-2">{{ $general_service->staff }}</h3>
                    <h3 class="text-[#2D3E50] text-xl my-2">{{ $general_service->schedule }}</h3>

                </aside>
                <div id="monitoring_section" class="bg-white w-3/5 relative m-10 left-20 rounded-2xl border-2 border-[#FF7400] items-center h-4/5">
                    <div class="w-full flex justify-end ">
                        <button id="add_monitoring_btn"
                            class="text-lg text-white bg-[#ff7300] hover:bg-[#ff73008a]
                            transition-all duration-300 rounded-2xl px-7 py-4 mt-5 mr-5">
                            + Nou seguiment
                        </button>
                    </div>
                    <div class="w-full flex items-center flex-col mt-8" id="prof-info-container">      
                    @foreach ($followups as $index => $followup)
                        <div class="monitoring-info w-11/12 bg-white flex justify-between rounded-3xl p-5 my-3 border border-[#FF7400]
                                    shadow-md hover:scale-102 transition-all duration-400 cursor-pointer">
                            
                            <!-- Info visible -->
                            <div class="monitoring flex items-center">
                                <svg class="w-10 h-10 txt-orange mr-3">
                                    <use xlink:href="#documentation_icon"></use>
                                </svg>
                                <p class="txt-orange text-lg">{{ $followup->issue }}#{{ $index + 1 }}</p>
                            </div>

                            <div class="flex items-center mr-10">
                                <p class="txt-orange text-lg">{{ $followup->date }}</p>
                            </div>

                            <!-- Inputs ocultos para JS -->
                            <input type="hidden" class="followup-date" value="{{ $followup->date }}">
                            <input type="hidden" class="followup-issue" value="{{ $followup->issue }}">
                            <input type="hidden" class="followup-comment" value="{{ $followup->comment }}">
                        </div>
                    @endforeach
                </div>
                    
                    

                </div>
                <div id="add_monitoring" class="hidden h-11/12 w-2/5 bg-white rounded-3xl shadow-black-500 shadow-2xl absolute left-[40%] p-10">
                    <form action="{{ route('general_service_followup.store', $general_service) }}" method="POST" class="space-y-6 signature-pad">
                        @csrf
                        <div class="flex justify-between items-center mb-6 w-full">
                            <h2 class="text-2xl font-bold txt-orange">Nou seguiment</h2>
                            <button id="close_add_monitoring" class="txt-orange text-xl font-bold hover:text-orange-700">✕</button>
                        </div>            
                        

                        <div class="flex">
                            <div>
                                <label class="text-orange-500 font-semibold uppercase text-sm">Data de l'informe</label>
                                <input type="date" name="date"
                                    class="mr-3 w-full bg-gray-200 rounded-full px-4 py-2 mt-1 text-gray-800 border-none focus:ring-2 focus:ring-orange-400"
                                    value="{{ now()->format('Y-m-d') }}" required>
                            </div>

                            

                            <div>
                                <label class="text-orange-500 font-semibold uppercase text-sm">Raó del seguiment</label>
                                <input type="text" name="issue"
                                    class="mx-3 w-full bg-gray-200 rounded-full px-4 py-2 mt-1 text-gray-800 border-none focus:ring-2 focus:ring-orange-400"
                                    placeholder="Motiu / situació observada" required>
                            </div>
                        </div>

                        <div>
                            <label class="text-orange-500 font-semibold uppercase text-sm">Descripció del seguiment</label>
                            <textarea name="comment" rows="6"
                                    class="w-full bg-gray-200 rounded-2xl px-4 py-3 mt-2 text-gray-800 border-none focus:ring-2 focus:ring-orange-400"
                                    placeholder="Detalla aquí l'observació o seguiment realitzat..." required></textarea>
                        </div>
                        <p class="mb-2 font-semibold">Firma</p>

                        <canvas id="signature" width="400" height="200" class="border border-gray-400 rounded bg-white"></canvas>

                        <button type="button" id="clear" class="mt-2 px-3 py-1 bg-gray-200 rounded">Clear</button>

                        <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-full transition-all">
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
                        

                        <div class="flex w-full">
                            
                            <div class="m-4">
                                <p class="txt-orange font-semibold uppercase text-sm">Data de l'informe</p>
                                <div id="view_monitoring_date" class="bg-gray-200 rounded-full px-4 py-1 font-semibold text-gray-800 mt-1">—</div>
                            </div>
                            <div class="m-4">
                                <p class="txt-orange font-semibold uppercase text-sm">Raó de l'informe:</p>
                                <div id="view_monitoring_issue" class="inline-block bg-gray-200 rounded-full px-4 py-1 text-gray-800 font-medium mt-1">—</div>
                            </div>
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

        <div id="overlay"
            class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-40">
        </div>
    @endauth

    @guest
        <h1>No has iniciat sessió.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>