<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguiments - Tema {{ $hr_pending_issue->context }}</title>
    @vite(['resources/css/app.css', 'resources/js/rrhh_followup.js'])
</head>
<body class="min-h-screen bg-body flex flex-col">
    @include('partials.icons')

    @auth
        @include('components.navbar')
        <main class="flex w-full">
            @include('components.sidebar')

            <div class="flex flex-col flex-1 p-6">
                <!-- Header -->
                <div class="flex items-center justify-between mb-8 bg-white p-6 rounded-xl shadow-md">
                    <div class="flex items-center">
                        <div class="w-12 h-12 sidebar-gradient rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Seguiments de Tema Pendent</h1>
                            <p class="text-gray-600">Context: {{ $hr_pending_issue->context }}</p>
                        </div>
                    </div>
                    <a href="{{ route('hr_pending_issue.index') }}" 
                       class="px-4 py-2 bg-gray-100 text-gray-800 font-medium rounded-lg hover:bg-gray-200 transition flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Tornar als temes pendents
                    </a>
                </div>

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="flex flex-1 gap-6">
                    <!-- Panel izquierdo: Información del tema -->
                    <div class="w-1/3">
                        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-orange-500">
                            <div class="flex flex-col items-center mb-6">
                                <div class="w-24 h-24 sidebar-gradient rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800 text-center">{{ $hr_pending_issue->affected_professional->name ?? 'Desconegut' }}</h2>
                                <p class="text-gray-500 text-sm mt-1">Professional afectat</p>
                            </div>

                            <div class="flex flex-col gap-4">
                                <div class="flex items-start">
                                    <div class="flex items-center justify-center w-10 h-10 bg-orange-50 rounded-lg mr-3">
                                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">Data d'obertura</span>
                                        <span class="text-sm text-gray-800">
                                            {{ $hr_pending_issue->opened_at ? date('d/m/Y', strtotime($hr_pending_issue->opened_at)) : 'No data' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex items-center justify-center w-10 h-10 bg-orange-50 rounded-lg mr-3">
                                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">Context</span>
                                        <span class="font-medium text-gray-800">{{ $hr_pending_issue->context ?? 'No especificat' }}</span>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex items-center justify-center w-10 h-10 bg-orange-50 rounded-lg mr-3">
                                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">Estat</span>
                                        <span class="font-medium text-gray-800 {{ $hr_pending_issue->status === 'closed' ? 'text-red-600' : 'text-green-600' }}">
                                            {{ $hr_pending_issue->status === 'closed' ? 'Tancat' : 'Obert' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <h4 class="font-semibold text-gray-700 mb-2">Descripció inicial</h4>
                                    <p class="text-gray-600 text-sm">{{ $hr_pending_issue->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Panel derecho: Seguimientos -->
                    <div class="flex-1">
                        <!-- Lista de seguimientos -->
                        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-bold text-gray-800">Seguiments Registrats</h3>
                                <div class="flex items-center">
                                    <div class="bg-orange-100 rounded-full flex items-center justify-center mr-2 px-3 py-1">
                                        <span class="text-sm font-bold text-orange-600">{{ count($followups) }} seguiments</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col gap-3 max-h-96 overflow-y-auto pr-2">
                                @forelse($followups as $index => $followup)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-orange-50 border border-gray-200 hover:border-orange-300 transition cursor-pointer followup-item"
                                         data-date="{{ date('d/m/Y', strtotime($followup->followup_date)) }}"
                                         data-professional="{{ $followup->professional->name ?? 'Desconegut' }}"
                                         data-description="{{ $followup->description }}"
                                         
                                         >
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center mr-4">
                                                <span class="text-white font-bold">{{ $index + 1 }}</span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-medium text-gray-800">Seguiment #{{ $index + 1 }}</span>
                                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                                    <span>{{ date('d/m/Y', strtotime($followup->followup_date)) }}</span>
                                                    <span>•</span>
                                                    <span>{{ $followup->professional->name ?? 'Desconegut' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="flex flex-col items-center justify-center py-8">
                                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="text-gray-500">No hi ha seguiments registrats</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Formulario nuevo seguimiento -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <div class="flex items-center mb-6">
                                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white font-bold">+</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Nou Seguiment</h3>
                            </div>

                            <form action="{{ route('hr_pending_issues.followups.store', [$professional, $hr_pending_issue]) }}"
                                  method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
                                @csrf
                                <div class="flex gap-4">
                                    <div class="flex-1 flex flex-col">
                                        <label class="text-sm font-medium text-gray-700 mb-1">Data</label>
                                        <input type="date" name="followup_date" value="{{ date('Y-m-d') }}" class="input-base focus:ring-orange-500">
                                    </div>
                                    <div class="flex-1 flex flex-col">
                                        <label class="text-sm font-medium text-gray-700 mb-1">Documents (opcional)</label>
                                        <input type="file" name="documents[]" multiple class="input-base focus:ring-orange-500">
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <label class="text-sm font-medium text-gray-700 mb-1">Descripció</label>
                                    <textarea name="description" rows="4" placeholder="Descriu el seguiment realitzat..." class="input-base focus:ring-orange-500"></textarea>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="btn-orange flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Guardar Seguiment
                                    </button>
                                </div>
                            </form>
                        </div>
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
