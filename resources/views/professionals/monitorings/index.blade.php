<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seguiments - {{ $professional->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/monitoring.js'])
</head>

<body class="min-h-screen bg-linear-to-br from-[#FEF2E6] to-[#FFEDD5] flex flex-col">
    @include('partials.icons')
    @auth
        @include('components.navbar')

        <main class="flex w-full flex-1">
            @include('components.sidebar')
        <div id="register_by" data-username="{{ Auth::user()->name }}" class="hidden"></div>
            <section class="w-full flex flex-col">
                <div class="bg-white px-8 py-6 shadow-sm border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                                Seguiments Professionals
                            </h1>
                            <p class="text-gray-600">
                                Gestió i registre de seguiments i observacions
                            </p>
                        </div>
                        <a href="{{ route('professional.show', $professional) }}" 
                           class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg 
                                  hover:border-[#ff7300] hover:text-[#ff7300] transition-colors 
                                  flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Tornar
                        </a>
                    </div>
                </div>

                <div class="flex-1 p-8">
                    <div class="max-w-7xl mx-auto">
                        <div class="flex gap-8">
                            <div class="w-1/3">
                                <div class="bg-white rounded-2xl shadow border border-gray-200 p-8">
                                    <div class="flex flex-col items-center text-center">
                                        <!-- Avatar -->
                                        <div class="w-28 h-28 bg-linear-to-br from-[#ff7300] to-[#FEAB51] rounded-full 
                                                    flex items-center justify-center mb-6 shadow-lg">
                                            <svg class="w-14 h-14 text-white">
                                                <use xlink:href="#professional_icon"></use>
                                            </svg>
                                        </div>
                                        
                                        <h2 class="text-2xl font-bold text-gray-800 mb-2">
                                            {{ $professional->name }} {{ $professional->surnames }}
                                        </h2>
                                        <p class="text-gray-600 text-sm mb-4">ID: {{ $professional->id }}</p>
                                        
                                        <div class="mb-6">
                                            @if ($professional->status != 'inactive')
                                                <div class="bg-green-100 text-green-800 px-4 py-2 rounded-full 
                                                            font-medium inline-flex items-center gap-2">
                                                    <span class="w-2.5 h-2.5 bg-green-500 rounded-full"></span>
                                                    Actiu
                                                </div>
                                            @else
                                                <div class="bg-red-100 text-red-800 px-4 py-2 rounded-full 
                                                            font-medium inline-flex items-center gap-2">
                                                    <span class="w-2.5 h-2.5 bg-red-500 rounded-full"></span>
                                                    Inactiu
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Stats -->
                                        <div class="w-full bg-gray-50 rounded-xl p-4 mb-6">
                                            <div class="text-center">
                                                <div class="text-3xl font-bold text-[#ff7300]">{{ count($monitoring) }}</div>
                                                <div class="text-sm text-gray-500">Seguiments registrats</div>
                                            </div>
                                        </div>
                                        
                                        <!-- Informació de contacte -->
                                        <div class="w-full space-y-3">
                                            <div class="flex items-center gap-3 text-gray-600">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                                <span class="text-sm truncate">{{ $professional->email_address }}</span>
                                            </div>
                                            <div class="flex items-center gap-3 text-gray-600">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                                <span class="text-sm">{{ $professional->phone_number }}</span>
                                            </div>
                                            @if($professional->address)
                                            <div class="flex items-center gap-3 text-gray-600">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                </svg>
                                                <span class="text-sm truncate">{{ $professional->address }}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-2/3">
                                <div class="bg-white rounded-2xl shadow border border-gray-200 h-full flex flex-col">
                                    <div class="px-8 py-6 border-b border-gray-100">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h2 class="text-xl font-bold text-gray-800">Seguiments Registrats</h2>
                                                <p class="text-sm text-gray-500 mt-1">
                                                    Historial de seguiments realitzats
                                                </p>
                                            </div>
                                            
                                            <button id="add_monitoring_btn"
                                                    class="inline-flex items-center gap-2 bg-linear-to-r from-[#ff7300] to-[#FEAB51] 
                                                           text-white px-6 py-3 rounded-lg hover:from-[#ff8c33] hover:to-[#FEBC51] 
                                                           transition-all shadow-sm hover:shadow font-medium">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                Nou Seguiment
                                            </button>
                                        </div>
                                    </div>

                                    <div class="flex-1 overflow-y-auto max-h-[calc(100vh-300px)]">
                                        <div class="p-8">
                                            @if(count($monitoring) > 0)
                                                <div class="space-y-4">
                                                    @foreach ($monitoring as $professional_monitoring)
                                                        <div class="monitoring-info bg-white border border-gray-200 rounded-xl 
                                                                 hover:border-[#ff7300] hover:shadow-md transition-all duration-200 
                                                                 p-6 cursor-pointer group"
                                                             data-id="{{ $professional_monitoring->id }}"
                                                             data-issue="{{ $professional_monitoring->issue }}"
                                                             data-type="{{ $professional_monitoring->type }}"
                                                             data-date="{{ $professional_monitoring->date }}"
                                                             data-comments="{{ $professional_monitoring->comments }}"
                                                             data-professional-name="{{ $professional->name }} {{ $professional->surnames }}">
                                                            <div class="flex items-center">
                                                                <!-- Icona -->
                                                                <div class="w-12 h-12 bg-linear-to-br from-[#ff7300]/10 to-[#FEAB51]/10 
                                                                          rounded-xl flex items-center justify-center shrink-0 mr-4 
                                                                          group-hover:from-[#ff7300]/20 group-hover:to-[#FEAB51]/20 
                                                                          transition-all">
                                                                    <svg class="w-6 h-6 text-[#ff7300]">
                                                                        <use xlink:href="#documentation_icon"></use>
                                                                    </svg>
                                                                </div>
                                                                
                                                                <div class="flex-1 min-w-0">
                                                                    <div class="flex items-center justify-between">
                                                                        <div>
                                                                            <h3 class="font-semibold text-gray-800 text-lg mb-1 truncate">
                                                                                {{ $professional_monitoring->issue }}
                                                                            </h3>
                                                                            <div class="flex items-center gap-4">
                                                                                <span class="text-sm text-gray-500">
                                                                                    #{{ $professional_monitoring->id }}
                                                                                </span>
                                                                                <span class="text-sm text-gray-500">
                                                                                    {{ $professional_monitoring->date }}
                                                                                </span>
                                                                            </div>
                                                                        </div>                                                                        
                                                                        <div class="flex items-center gap-2">
                                                                            <span class="px-3 py-1 bg-gray-100 text-gray-700 
                                                                                      text-xs font-medium rounded-full">
                                                                                {{ $professional_monitoring->type }}
                                                                            </span>
                                                                            <svg class="w-5 h-5 text-gray-400 group-hover:text-[#ff7300] 
                                                                                     transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                                      d="M9 5l7 7-7 7"/>
                                                                            </svg>
                                                                        </div>
                                                                    </div>
                                                                    @if($professional_monitoring->comments)
                                                                        <p class="mt-3 text-sm text-gray-600 line-clamp-2">
                                                                            {{ $professional_monitoring->comments }}
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <!-- Missatge buit -->
                                                <div class="flex flex-col items-center justify-center py-16">
                                                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                                        <svg class="w-10 h-10 text-gray-400">
                                                            <use xlink:href="#documentation_icon"></use>
                                                        </svg>
                                                    </div>
                                                    <p class="text-gray-600 font-medium mb-2">No hi ha seguiments</p>
                                                    <p class="text-gray-400 text-sm text-center max-w-md">
                                                        Encara no s'han registrat seguiments per a aquest professional
                                                    </p>
                                                    <button id="add_monitoring_empty_btn"
                                                            class="mt-4 inline-flex items-center gap-2 bg-linear-to-r from-[#ff7300] to-[#FEAB51] 
                                                                   text-white px-6 py-2.5 rounded-lg hover:from-[#ff8c33] hover:to-[#FEBC51] 
                                                                   transition-all font-medium">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                        </svg>
                                                        Crear primer seguiment
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <div id="add_monitoring_modal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 
                                              flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
                <!-- Capçalera -->
                <div class="sticky top-0 bg-white px-8 py-6 border-b border-gray-200 z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Nou Seguiment</h2>
                            <p class="text-sm text-gray-500 mt-1">Completeu les dades del seguiment</p>
                        </div>
                        <button id="close_add_monitoring" 
                                class="text-gray-400 hover:text-gray-600 transition-colors p-2 hover:bg-gray-100 rounded-full">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <form action="{{ route('monitoring.store',$professional) }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Realitzat per
                            </label>
                            <div class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-gray-700">
                                {{ Auth::user()->name }}
                            </div>
                            <input type="hidden" name="professional_monitoring_id" value="{{ Auth::user()->id }}">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Professional valorat
                            </label>
                            <div class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-gray-700">
                                {{ $professional->name }} {{ $professional->surnames }}
                            </div>
                            <input type="hidden" name="professional_id" value="{{ $professional->id }}">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Data de l'informe *
                            </label>
                            <input type="date" name="date"
                                   class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 
                                          focus:border-[#ff7300] focus:ring-2 focus:ring-[#ff7300]/20 
                                          focus:outline-none transition-colors"
                                   value="{{ now()->format('Y-m-d') }}" required>
                        </div>
                        
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tipus d'informe *
                            </label>
                            <input type="text" name="type"
                                   class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 
                                          focus:border-[#ff7300] focus:ring-2 focus:ring-[#ff7300]/20 
                                          focus:outline-none transition-colors"
                                   placeholder="Ex: Obert, tancat, seguiment..." required>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Raó de l'informe *
                        </label>
                        <input type="text" name="issue" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 
                                      focus:border-[#ff7300] focus:ring-2 focus:ring-[#ff7300]/20 
                                      focus:outline-none transition-colors"
                               placeholder="Motiu o situació observada" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Descripció de l'informe *
                        </label>
                        <textarea name="comments" rows="6"
                                  class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 
                                         focus:border-[#ff7300] focus:ring-2 focus:ring-[#ff7300]/20 
                                         focus:outline-none transition-colors resize-none"
                                  placeholder="Detalla aquí l'observació o seguiment realitzat..." required></textarea>
                    </div>
                    
                    <!-- Botons -->
                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button" id="cancel_add_monitoring"
                                class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-medium 
                                       rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-colors">
                            Cancel·lar
                        </button>
                        <button type="submit"
                                class="px-6 py-3 bg-linear-to-r from-[#ff7300] to-[#FEAB51] text-white 
                                       font-medium rounded-lg hover:from-[#ff8c33] hover:to-[#FEBC51] 
                                       transition-all shadow-sm hover:shadow">
                            Guardar Seguiment
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div id="view_monitoring_modal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 
                                               flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
                <div class="sticky top-0 bg-white px-8 py-6 border-b border-gray-200 z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Detalls del Seguiment</h2>
                            <p class="text-sm text-gray-500 mt-1">Informació completa del seguiment</p>
                        </div>
                        <button id="close_view_monitoring" 
                                class="text-gray-400 hover:text-gray-600 transition-colors p-2 hover:bg-gray-100 rounded-full">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="p-8 space-y-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Realitzat per</p>
                            <div id="view_monitoring_by" class="font-medium text-gray-800">—</div>
                        </div>
                        
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Professional valorat</p>
                            <div id="view_professional_name" class="font-medium text-gray-800">—</div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">ID de l'informe</p>
                            <div id="view_monitoring_id" class="font-bold text-gray-800">—</div>
                        </div>
                        
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Data de l'informe</p>
                            <div id="view_monitoring_date" class="font-medium text-gray-800">—</div>
                        </div>
                        
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Tipus d'informe</p>
                            <div id="view_monitoring_type" class="font-medium text-gray-800">—</div>
                        </div>
                    </div>
                    
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Raó de l'informe</p>
                        <div id="view_monitoring_issue" class="font-medium text-gray-800">—</div>
                    </div>
                    
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Descripció de l'informe</p>
                        <div id="view_monitoring_comments" class="bg-gray-50 rounded-xl p-4 text-gray-700 leading-relaxed">
                            —
                        </div>
                    </div>
                    
                    <div class="flex justify-end pt-4">
                        <button id="close_view_modal_btn"
                                class="px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg 
                                       hover:bg-gray-200 transition-colors">
                            Tancar
                        </button>
                    </div>
                </div>
            </div>
        </div>

    @endauth

    @guest
        <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#ff7300] to-[#FEAB51]">
            <div class="text-center bg-white/10 backdrop-blur-sm rounded-3xl p-12 border border-white/20">
                <h1 class="text-3xl font-bold text-white mb-4 drop-shadow-lg">Accés Restringit</h1>
                <p class="text-white/90 mb-8">Has d'iniciar sessió per accedir a aquest contingut</p>
                <a href="{{ route('login') }}" 
                   class="inline-flex items-center gap-3 bg-white text-[#ff7300] px-8 py-3.5 rounded-xl 
                          hover:bg-white/90 transition-all font-bold text-lg shadow-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Iniciar Sessió
                </a>
            </div>
        </div>
        <meta http-equiv="refresh" content="3; URL={{ route('login') }}" />
    @endguest
</body>
</html>