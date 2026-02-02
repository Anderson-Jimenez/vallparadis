<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguiments - Tema {{ $hr_pending_issue->context }}</title>
    @vite(['resources/css/app.css'])
    <style>
        /* Estilos para gradiente naranja */
        .sidebar-gradient {
            background: linear-gradient(90deg, #ff7300, #feab51);
        }
        .sidebar-gradient:hover {
            background: linear-gradient(90deg, #e56700, #fd9c40);
        }
        
        /* Estilos generales */
        .bg-body {
            background-color: #f8fafc;
        }
        
        /* Estilos para elementos interactivos */
        .hover-orange-50:hover {
            background-color: rgba(255, 115, 0, 0.05);
        }
        
        .hover-orange-100:hover {
            background-color: rgba(255, 115, 0, 0.1);
        }
        
        .border-orange-300 {
            border-color: #fdba74;
        }
        
        .hover-border-orange-300:hover {
            border-color: #fdba74;
        }
        
        .text-orange-500 {
            color: #f97316;
        }
        
        .text-orange-600 {
            color: #ea580c;
        }
        
        .text-orange-700 {
            color: #c2410c;
        }
        
        .bg-orange-50 {
            background-color: #fff7ed;
        }
        
        .bg-orange-100 {
            background-color: #ffedd5;
        }
        
        .border-orange-500 {
            border-color: #f97316;
        }
        
        .focus-ring-orange-500:focus {
            --tw-ring-color: rgba(249, 115, 22, 0.5);
            border-color: #f97316;
            box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.5);
        }
        
        /* Estilos para tarjetas */
        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .hover-shadow-lg:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        /* Estilos para texto */
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* Transiciones */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }
        
        .transition-colors {
            transition-property: background-color, border-color, color, fill, stroke;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }
        
        .transition-shadow {
            transition-property: box-shadow;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }
        
        /* Scrollbar personalizado */
        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }
        
        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }
        
        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        
        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* Estilos para inputs y textareas */
        .input-base {
            background-color: #f9fafb;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            outline: none;
        }
        
        .input-base:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.2);
        }
        
        /* Estilos para botones */
        .btn-orange {
            background: linear-gradient(90deg, #ff7300, #feab51);
            color: white;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            transition: all 150ms;
        }
        
        .btn-orange:hover {
            background: linear-gradient(90deg, #e56700, #fd9c40);
            opacity: 0.9;
        }
        
        .btn-gray {
            background-color: #f3f4f6;
            color: #374151;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            cursor: pointer;
            transition: all 150ms;
        }
        
        .btn-gray:hover {
            background-color: #e5e7eb;
        }
        
        /* Estilos para badges */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .badge-orange {
            background-color: #ffedd5;
            color: #c2410c;
        }
        
        .badge-red {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .badge-green {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .badge-blue {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        /* Estilos para iconos SVG */
        .icon-orange {
            color: #f97316;
        }
        
        .icon-gray {
            color: #6b7280;
        }
        
        .icon-white {
            color: #ffffff;
        }
    </style>
</head>

<body class="min-h-screen bg-body">
    @include('partials.icons')

    @auth
        @include('components.navbar')

        <main class="flex w-full">
            @include('components.sidebar')

            <div class="flex flex-col flex-1 p-6">
                <!-- Header -->
                <div class="flex items-center justify-between mb-8 bg-white p-6 rounded-xl card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 sidebar-gradient rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 icon-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Seguiments de Tema Pendent</h1>
                            <p class="text-gray-600">Context: {{ $hr_pending_issue->context }}</p>
                        </div>
                    </div>
                    <a href="{{ route('hr_pending_issue.index') }}" 
                       class="px-4 py-2 bg-gray-100 text-gray-800 font-medium rounded-lg hover:bg-gray-200 transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5 icon-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
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
                    <div style="width: 33.333333%;">
                        <div class="bg-white rounded-xl card-shadow p-6 border-l-4 border-orange-500">
                            <div class="flex flex-col items-center mb-6">
                                <div class="w-24 h-24 sidebar-gradient rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-12 h-12 icon-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800 text-center">{{ $hr_pending_issue->affected_professional->name ?? 'Desconegut' }}</h2>
                                <p class="text-gray-500 text-sm mt-1">Professional afectat</p>
                            </div>

                            <div class="flex flex-col gap-4">
                                <div class="flex items-start">
                                    <div class="flex items-center justify-center w-10 h-10 bg-orange-50 rounded-lg mr-3">
                                        <svg class="w-5 h-5 icon-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">Data d'obertura</span>
                                        <span class="text-sm text-gray-800">
                                            @if($hr_pending_issue->opened_at)
                                                {{ date('d/m/Y', strtotime($hr_pending_issue->opened_at)) }}
                                            @else
                                                No data
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex items-center justify-center w-10 h-10 bg-orange-50 rounded-lg mr-3">
                                        <svg class="w-5 h-5 icon-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">Context</span>
                                        <span class="font-medium text-gray-800">{{ $hr_pending_issue->context ?? 'No especificat' }}</span>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex items-center justify-center w-10 h-10 bg-orange-50 rounded-lg mr-3">
                                        <svg class="w-5 h-5 icon-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
                    <div style="flex: 1;">
                        <!-- Lista de seguimientos -->
                        <div class="bg-white rounded-xl card-shadow p-6 mb-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-bold text-gray-800">Seguiments Registrats</h3>
                                <div class="flex items-center">
                                    <div class="bg-orange-100 rounded-full flex items-center justify-center mr-2 px-3 py-1">
                                        <span class="text-sm font-bold text-orange-600">{{ count($followups) }} seguiments</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col gap-3" style="max-height: 400px; overflow-y: auto; padding-right: 0.5rem;">
                                @forelse ($followups as $index => $followup)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover-orange-50 border border-gray-200 hover-border-orange-300 transition-colors">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 sidebar-gradient rounded-full flex items-center justify-center mr-4">
                                                <span class="text-white font-bold">{{ $index + 1 }}</span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-medium text-gray-800">
                                                    Seguiment #{{ $index + 1 }}
                                                </span>
                                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                                    <span>{{ date('d/m/Y', strtotime($followup->followup_date)) }}</span>
                                                    <span>•</span>
                                                    <span>{{ $followup->professional->name ?? 'Desconegut' }}</span>
                                                </div>
                                                @if($followup->description)
                                                    <p class="text-sm text-gray-500 mt-1 line-clamp-1">
                                                        {{ Str::limit($followup->description, 80) }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="flex items-center space-x-3">
                                            @if($followup->documents->count() > 0)
                                                <div class="flex flex-col items-end">
                                                    <span class="text-sm text-orange-600">
                                                        {{ $followup->documents->count() }} document(s)
                                                    </span>
                                                    <!-- Enlaces para descargar documentos -->
                                                    <div class="flex space-x-2 mt-1">
                                                        @foreach($followup->documents as $document)
                                                            <a href="{{ route('hr_pending_issues.followups.download', [$professional, $hr_pending_issue, $document->id]) }}"
                                                               class="text-xs text-orange-500 hover:text-orange-700 hover:underline flex items-center"
                                                               title="Descarregar document">
                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                          d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                                </svg>
                                                                Doc {{ $loop->iteration }}
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="flex flex-col items-center justify-center py-8">
                                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="text-gray-500">No hi ha seguiments registrats</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        
                        <!-- Formulario nuevo seguimiento -->
                        <div class="bg-white rounded-xl card-shadow p-6">
                            <div class="flex items-center mb-6">
                                <div class="w-8 h-8 sidebar-gradient rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white font-bold">+</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Nou Seguiment</h3>
                            </div>

                            <form action="{{ route('hr_pending_issues.followups.store', [$professional, $hr_pending_issue]) }}" 
                                  method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
                                @csrf
                                
                                <div style="display: flex; gap: 1rem;">
                                    <div style="flex: 1; display: flex; flex-direction: column;">
                                        <label class="text-sm font-medium text-gray-700 mb-1">Data</label>
                                        <input type="date" name="followup_date" value="{{ date('Y-m-d') }}" 
                                               class="input-base focus-ring-orange-500">
                                    </div>
                                    <div style="flex: 1; display: flex; flex-direction: column;">
                                        <label class="text-sm font-medium text-gray-700 mb-1">Documents (opcional)</label>
                                        <input type="file" name="documents[]" multiple
                                               class="input-base focus-ring-orange-500">
                                        
                                    </div>
                                </div>

                                <div style="display: flex; flex-direction: column;">
                                    <label class="text-sm font-medium text-gray-700 mb-1">Descripció</label>
                                    <textarea name="description" rows="4" 
                                              placeholder="Descriu el seguiment realitzat..."
                                              class="input-base focus-ring-orange-500"></textarea>
                                </div>

                                <div style="display: flex; justify-content: flex-end;">
                                    <button type="submit" class="btn-orange flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
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
        <div class="min-h-screen flex items-center justify-center bg-gray-50">
            <div class="text-center">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">No has iniciat sessió</h1>
                <a href="{{ route('login') }}" class="text-orange-500 hover:text-orange-600 font-medium">
                    Anar a l'inici de sessió →
                </a>
            </div>
        </div>
    @endguest
</body>
</html>