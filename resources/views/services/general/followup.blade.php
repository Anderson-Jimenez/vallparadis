<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seguiments - {{ $general_service->type }}</title>
    @vite(['resources/css/app.css', 'resources/js/general_service_followup.js', 'resources/js/signature.js'])
</head>

<body class="min-h-screen bg-body flex flex-col">
    @include('partials.icons')

    @auth
        @if ($errors->any())
            <div class="fixed top-20 right-4 z-50">
                @foreach ($errors->all() as $error)
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-2 rounded-lg shadow-lg">
                        <p>{{ $error }}</p>
                    </div>
                @endforeach
            </div>
        @endif

        @include('components.navbar')

        <main class="flex w-full">
            @include('components.sidebar')

            <div class="flex flex-col flex-1">

                <div class="flex justify-between items-center mb-8 bg-white p-7">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white">
                                <use xlink:href="#professional_icon"></use>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Seguiments de Servei de {{ $general_service->type }}</h1>
                            <p class="text-gray-600">Encargat: {{ $general_service->manager }}</p>
                        </div>
                    </div>
                    <a href="{{ route('general_service.index', $general_service->affected_professional) }}" 
                       class="px-4 py-2 bg-gray-100 text-gray-800 font-medium rounded-lg hover:bg-gray-200 transition flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <use xlink:href="#back_icon"></use>
                        </svg>
                        Tornar als accidents
                    </a>
                </div>

                <div class="flex flex-1 gap-6 w-11/12 mb-10 mx-auto">
                    <div class="flex flex-col w-1/4">
                        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-orange-500">
                            <div class="flex flex-col items-center mb-6">
                                <div class="w-24 h-24 bg-linear-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-12 h-12 text-white">
                                        <use xlink:href="#professionals_icon"></use>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800 text-center">{{ $general_service->manager }}</h2>
                                <p class="text-gray-500 text-sm mt-1">Encargat Principal</p>
                            </div>

                            <div class="flex flex-col gap-4">
                                <div class="flex items-start">
                                    <div class="flex items-center justify-center w-10 h-10 bg-orange-50 rounded-lg mr-3">
                                        <svg class="w-5 h-5 txt-orange">
                                            <use xlink:href="#phone_icon"></use>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">Contacte</span>
                                        <span class="text-sm text-gray-800">{{ $general_service->contact }}</span>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex items-center justify-center w-10 h-10 bg-orange-50 rounded-lg mr-3">
                                        <svg class="w-5 h-5 txt-orange">
                                            <use xlink:href="#professionals_icon"></use>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">Personal</span>
                                        <span class="font-medium text-gray-800">{{ $general_service->staff }}</span>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex items-center justify-center w-10 h-10 bg-orange-50 rounded-lg mr-3">
                                        <svg class="w-5 h-5 txt-orange">
                                            <use xlink:href="#project_icon"></use>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">Horari</span>
                                        <span class="font-medium text-gray-800">{{ $general_service->schedule }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col flex-1">
                        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-bold text-gray-800">Seguiments Registrats</h3>
                                <div class="flex items-center">
                                    <div class="bg-orange-100 rounded-full flex items-center justify-center mr-2 px-3 py-1">
                                        <span class="text-sm font-bold text-orange-600">{{ count($followups) }} seguiments / observacions</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col gap-3 max-h-[400px] overflow-y-auto pr-2">
                                @forelse ($followups as $index => $followup)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-orange-50 border border-gray-200 hover:border-orange-300 transition-all cursor-pointer monitoring-item"
                                         data-date="{{ $followup->date }}"
                                         data-issue="{{ $followup->issue }}"
                                         data-comment="{{ $followup->comment }}">
                                        
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center mr-4">
                                                <span class="text-white font-bold">{{ $index + 1 }}</span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-medium text-gray-800">{{ $followup->issue }}</span>
                                                <span class="text-sm text-gray-600">{{ $followup->date }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center bg-[#ff7300] px-3 py-2 rounded-lg">
                                            <svg class="w-5 h-5 text-white mr-2">
                                                <use xlink:href="#see_evaluations"></use>
                                            </svg>
                                            <span class="text-sm text-white mr-3">Veure detalls</span>

                                        </div>
                                    </div>
                                @empty
                                    <div class="flex flex-col items-center justify-center py-8">
                                        <svg class="w-16 h-16 text-gray-300 mb-4">
                                            <use xlink:href="#documentation_icon"></use>
                                        </svg>
                                        <p class="text-gray-500">No hi ha seguiments registrats</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <div class="flex items-center mb-6">
                                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white font-bold">+</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Nou Seguiment</h3>
                            </div>

                            <form action="{{ route('general_service_followup.store', $general_service) }}" method="POST" class="flex flex-col gap-6">
                                @csrf
                                <div class="flex gap-4">
                                    <div class="flex flex-col flex-1">
                                        <label class="text-sm font-medium text-gray-700 mb-1">Data</label>
                                        <input type="date" name="date" value="{{ now()->format('Y-m-d') }}" class="bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                    </div>
                                    <div class="flex flex-col flex-1">
                                        <label class="text-sm font-medium text-gray-700 mb-1">Raó / Assumpte</label>
                                        <input type="text" name="issue" 
                                               placeholder="Motiu del seguiment"
                                               class="bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                    </div>
                                </div>

                                <div class="flex flex-col">
                                    <label class="text-sm font-medium text-gray-700 mb-1">Descripció</label>
                                    <textarea name="comment" rows="4" 
                                              placeholder="Descriu el seguiment realitzat..."
                                              class="bg-gray-50 border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500"></textarea>
                                </div>

                                <div class="flex flex-col">
                                    <label class="text-sm font-medium text-gray-700 mb-2">Firma digital</label>
                                    <div class="flex flex-col border border-gray-300 rounded-lg p-4">
                                        <canvas id="signature" width="400" height="150" class="border border-gray-300 rounded bg-white"></canvas>
                                        <div class="flex items-center mt-3">
                                            <button type="button" id="clear" class="text-sm text-gray-600 hover:text-gray-800">
                                                Netejar signatura
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" class="flex items-center justify-center bg-orange-500 hover:bg-orange-600 text-white font-medium px-6 py-3 rounded-lg transition-all">
                                        <svg class="w-5 h-5 mr-2">
                                            <use xlink:href="#save_icon"></use>
                                        </svg>
                                        Guardar Seguiment
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="view-monitoring" class="hidden fixed inset-0 bg-black/30 backdrop-blur-sm z-50 items-center justify-center p-4">
                <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl">
                    <div class="flex items-center justify-between p-6 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-orange-600">
                                    <use xlink:href="#documentation_icon"></use>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Detalls del Seguiment</h3>
                        </div>
                        <button id="close_view_monitoring" class="text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6">
                                <use xlink:href="#x_icon"></use>
                            </svg>
                        </button>
                    </div>

                    <div class="p-6">
                        <div class="flex flex-col gap-6">
                            <div class="flex gap-6">
                                <div class="flex flex-col flex-1">
                                    <span class="text-sm text-gray-500 mb-1">Data</span>
                                    <span id="view_monitoring_date" class="font-medium text-gray-800 bg-gray-50 rounded-lg px-4 py-2">—</span>
                                </div>
                                <div class="flex flex-col flex-1">
                                    <span class="text-sm text-gray-500 mb-1">Assumpte</span>
                                    <span id="view_monitoring_issue" class="font-medium text-gray-800 bg-gray-50 rounded-lg px-4 py-2">—</span>
                                </div>
                            </div>

                            <div class="flex flex-col">
                                <span class="text-sm text-gray-500 mb-1">Descripció</span>
                                <div id="view_monitoring_comments" class="bg-gray-50 rounded-lg p-4 text-gray-800 min-h-[120px]">
                                    —
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end p-6 border-t border-gray-200">
                        <button id="close_view_btn" class="px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition-all">
                            Tancar
                        </button>
                    </div>
                </div>
            </div>
        </main>
    @endauth

    @guest
        <div class="flex flex-col items-center justify-center min-h-screen">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">No has iniciat sessió</h1>
            <p class="text-gray-600">Redirigint a l'inici de sessió...</p>
            <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
        </div>
    @endguest
</body>
</html>