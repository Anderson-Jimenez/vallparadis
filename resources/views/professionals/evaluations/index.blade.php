<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Avaluacions - {{ $professional->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/evaluations.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-[#FEF2E6] to-[#FFEDD5] flex flex-col">
    @include('partials.icons')
    @auth
        @include('components.navbar')

        <main class="flex w-full flex-1">
            @include('components.sidebar')
            
            <section class="w-full flex flex-col">
                <div class="bg-white px-8 py-8 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold mb-2 drop-shadow-sm">
                                Avaluacions del Professional
                            </h1>
                            <p class="max-w-2xl">
                                Gestió completa i seguiment d'avaluacions de rendiment i competències professionals
                            </p>
                        </div>
                        <a href="{{ route('professional.index', $professional) }}" 
                           class="backdrop-blur-sm px-5 py-2.5 rounded-xl bg-gray-200
                                  transition-all border border-white/30 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Tornar
                        </a>
                    </div>
                </div>

                <div class="flex-1 p-8">
                    <div class="mx-auto flex flex-col gap-5">
                        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
                            <div class="flex items-center gap-6">
                                <!-- Avatar circular amb gradient -->
                                <div>
                                    <div class="w-24 h-24 bg-linear-to-br from-[#ff7300] to-[#FEAB51] rounded-full 
                                                flex items-center justify-center shadow-lg mb-2">
                                        <svg class="w-12 h-12 text-white">
                                            <use xlink:href="#professionals_icon"></use>
                                        </svg>
                                    </div>
                                    <div>
                                        @if ($professional->status != 'inactive')
                                            <div class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold 
                                                        shadow-lg flex items-center gap-1">
                                                <span class="w-2 h-2 bg-white rounded-full"></span>
                                                ACTIU
                                            </div>
                                        @else
                                            <div class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold 
                                                        shadow-lg flex items-center gap-1">
                                                <span class="w-2 h-2 bg-white rounded-full"></span>
                                                INACTIU
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h2 class="text-2xl font-bold text-gray-800 mb-1">
                                        {{ $professional->name }} {{ $professional->surnames }}
                                    </h2>                                   
                                    <div class="flex items-center gap-6 w-1/5 justify-center">
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-[#ff7300]">{{ count($evaluations) }}</div>
                                            <div class="text-xs text-gray-500">Avaluació(s)</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col gap-3">
                                    <a id="add_evaluations_btn" href="{{ route('evaluations.create_evaluations',$professional) }}"
                                        class="bg-linear-to-r from-[#ff7300] to-[#FEAB51] text-white px-6 py-3 rounded-xl 
                                                hover:from-[#ff8c33] hover:to-[#FEBC51] transition-all shadow-lg hover:shadow-xl 
                                                font-medium flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Nova Avaluació
                                    </a>                           
                                </div>
                            </div>
                            
                            <div class="flex flex-wrap gap-3 mt-6 pt-6 border-t border-gray-100">
                                <div class="flex items-center gap-2 bg-gray-50 px-3 py-2 rounded-lg">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-sm text-gray-700 truncate max-w-xs">{{ $professional->email_address }}</span>
                                </div>
                                <div class="flex items-center gap-2 bg-gray-50 px-3 py-2 rounded-lg">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <use xlink:href="#phone_icon"></use>
                                    </svg>
                                    <span class="text-sm text-gray-700">{{ $professional->phone_number }}</span>
                                </div>
                                @if($professional->address)
                                <div class="flex items-center gap-2 bg-gray-50 px-3 py-2 rounded-lg">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <use xlink:href="#location_icon"></use>
                                    </svg>
                                    <span class="text-sm text-gray-700 truncate max-w-xs">{{ $professional->address }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        

                        <!-- Llista d'avaluacions amb disseny modern -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/50 overflow-hidden">
                            <!-- Capçalera de la llista -->
                            <div class="bg-linear-to-r from-white to-gray-50 px-8 py-6 border-b border-gray-100">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h2 class="text-xl font-bold text-gray-800">Historial d'Avaluacions</h2>
                                        <p class="text-sm text-gray-500 mt-1">Totes les avaluacions realitzades</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="px-3 py-1 bg-[#ff7300]/10 text-[#ff7300] rounded-full text-sm font-medium">
                                            {{ count($evaluations) }} {{ count($evaluations) == 1 ? 'registre' : 'registres' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="overflow-y-auto max-h-[500px]">
                                <div class="p-6">
                                    @if(count($evaluations) > 0)
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                            @foreach ($evaluations as $evaluation)
                                                <a href="{{ route('evaluations.show_results_evaluation',$evaluation) }}" 
                                                   class="group block">
                                                    <div class="bg-white border-2 border-gray-100 rounded-2xl p-6 
                                                              hover:border-[#ff7300] hover:shadow-xl transition-all duration-300 
                                                              hover:-translate-y-1 h-full">
                                                        <div class="flex items-start justify-between mb-4">
                                                            <div class="w-12 h-12 bg-linear-to-br from-[#ff7300]/10 to-[#FEAB51]/10 
                                                                      rounded-xl flex items-center justify-center group-hover:from-[#ff7300]/20 
                                                                      group-hover:to-[#FEAB51]/20 transition-all">
                                                                <svg class="w-6 h-6 text-[#ff7300]">
                                                                    <use xlink:href="#documentation_icon"></use>
                                                                </svg>
                                                            </div>
                                                            <div class="text-right">
                                                                <div class="text-2xl font-bold text-[#ff7300] mt-1">
                                                                    {{ date('d', strtotime($evaluation->evaluation_date)) }}
                                                                </div>
                                                                <div class="text-xs text-gray-600">
                                                                    {{ date('M Y', strtotime($evaluation->evaluation_date)) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <h3 class="font-bold text-gray-800 mb-2 truncate">
                                                            Avaluació {{ date('d/m/Y', strtotime($evaluation->evaluation_date)) }}
                                                        </h3>
                                                        
                                                        <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100">
                                                            <span class="text-xs text-gray-500">
                                                                {{ $evaluation->created_at->diffForHumans() }}
                                                            </span>
                                                            <div class="flex items-center gap-1 text-[#ff7300] group-hover:gap-2 transition-all">
                                                                <span class="text-sm font-medium">Veure detalls</span>
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                          d="M9 5l7 7-7 7"/>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-16">
                                            <div class="w-32 h-32 bg-linear-to-br from-[#ff7300]/10 to-[#FEAB51]/10 
                                                        rounded-full flex items-center justify-center mx-auto mb-6 
                                                        animate-pulse-slow">
                                                <svg class="w-16 h-16 text-[#ff7300]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-xl font-bold text-gray-700 mb-3">Encara no hi ha avaluacions</h3>
                                            <p class="text-gray-500 max-w-md mx-auto mb-8">
                                                Crea la primera avaluació per començar a fer seguiment del rendiment d'aquest professional.
                                            </p>
                                            <a href="{{ route('evaluations.create_evaluations',$professional) }}"
                                               class="inline-flex items-center gap-2 bg-gradient-to-r from-[#ff7300] to-[#FEAB51] 
                                                      text-white px-8 py-3.5 rounded-xl hover:from-[#ff8c33] hover:to-[#FEBC51] 
                                                      transition-all shadow-lg hover:shadow-xl font-medium text-lg">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                Crear Primera Avaluació
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="bg-linaer-to-r from-white to-gray-50 px-8 py-4 border-t border-gray-100">
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>Les avaluacions ajuden a millorar el rendiment professional</span>
                                    </div>
                                    @if(count($evaluations) > 0)
                                        <div>
                                            <span class="font-medium text-[#ff7300]">
                                                {{ $evaluations->count() }} avaluacions registrades
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
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