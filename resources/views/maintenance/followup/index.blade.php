<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seguiments - Manteniment {{ $maintenance->issue }}</title>
    @vite(['resources/css/app.css', 'resources/js/maintenance_followup.js'])
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

                <!-- Encabezado de mantenimiento -->
                <div class="flex items-center justify-between mb-8 bg-white p-7">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 3a4 4 0 100 8 4 4 0 000-8zM2 21v-2a6 6 0 0112 0v2H2zm13.5-8.5l6 6-1.5 1.5-6-6V11h1.5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Seguiments de Manteniment</h1>
                            <p class="text-gray-600">Incidència: {{ $maintenance->issue }}</p>
                        </div>
                    </div>
                    <a href="{{ route('maintenance.index', $maintenance->affected_professional) }}" 
                       class="px-4 py-2 bg-gray-100 text-gray-800 font-medium rounded-lg hover:bg-gray-200 transition flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <use xlink:href="#back_icon"></use>
                        </svg>
                        Tornar als manteniments
                    </a>
                </div>

                <div class="flex flex-1 gap-6 w-11/12 mb-10 mx-auto">

                    

                    <!-- Panel derecho: Seguimientos -->
                    <div class="flex flex-col flex-1">

                        <!-- Seguimientos registrados -->
                        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-bold text-gray-800">Seguiments Registrats</h3>
                                <div class="flex items-center">
                                    <div class="bg-orange-100 rounded-full flex items-center justify-center mr-2 px-3 py-1">
                                        <span class="text-sm font-bold text-orange-600">{{ count($followups) }} seguiments</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col gap-3 max-h-[400px] overflow-y-auto pr-2">
                                @forelse ($followups as $index => $followup)
                                    <div
                                        class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-orange-50 border border-gray-200 hover:border-orange-300 transition cursor-pointer followup-item"
                                        data-date="{{ $followup->date }}"
                                        data-issue="{{ $followup->issue }}"
                                        data-professional="{{ $followup->professional->name ?? 'Desconegut' }}"
                                        data-description="{{ $followup->description }}"
                                    >

                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center mr-4">
                                                <span class="text-white font-bold">{{ $index + 1 }}</span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-medium text-gray-800">{{ $followup->issue }}</span>
                                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                                    <span>{{ $followup->date }}</span>
                                                    <span>•</span>
                                                    <span>{{ $followup->professional->name ?? 'Desconegut' }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex items-center sidebar-gradient px-3 py-2 rounded-lg">
                                            <span class="text-sm text-white">Veure detalls</span>
                                        </div>

                                        <!-- DOCUMENTOS OCULTOS (para el JS) -->
                                        <div class="hidden followup-docs">
                                            @forelse ($followup->maintenance_followup_doc as $doc)
                                                <a href="{{ route('maintenance.followup.doc.download', $doc) }}"
                                                target="_blank"
                                                class="flex items-center gap-1 hover:text-orange-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M4 16v4h16v-4M12 12v8m0 0l-4-4m3 3l4-4M12 4v8"></path>
                                                    </svg>
                                                    {{ $doc->name }}
                                                </a>
                                            @empty
                                                <span class="text-sm text-gray-400">No hi ha documents</span>
                                            @endforelse
                                        </div>

                                    </div>
                                @empty
                                    <div class="flex flex-col items-center justify-center py-8">
                                        <p class="text-gray-500">No hi ha seguiments registrats</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Nuevo seguimiento -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <div class="flex items-center mb-6">
                                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white font-bold">+</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Nou Seguiment</h3>
                            </div>

                            <form action="{{ route('maintenance.followup.store', [$maintenance->affected_professional, $maintenance]) }}" method="POST" class="flex flex-col gap-6" enctype="multipart/form-data">
                                @csrf
                                <div class="flex gap-4">
                                    <div class="flex flex-col flex-1">
                                        <label class="text-sm font-medium text-gray-700 mb-1">Data</label>
                                        <input type="date" name="date" value="{{ now()->format('Y-m-d') }}" 
                                               class="bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                    </div>
                                    <div class="flex flex-col flex-1">
                                        <label class="text-sm font-medium text-gray-700 mb-1">Assumpte / Raó</label>
                                        <input type="text" name="issue" 
                                               placeholder="Motiu del seguiment"
                                               class="bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                    </div>
                                </div>

                                <div class="flex flex-col">
                                    <label class="text-sm font-medium text-gray-700 mb-1">Descripció</label>
                                    <textarea name="description" rows="4" 
                                              placeholder="Descriu el seguiment realitzat..."
                                              class="bg-gray-50 border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500"></textarea>
                                </div>

                                <!-- Subida de documentos -->
                                <div class="flex flex-col">
                                    <label class="text-sm font-medium text-gray-700 mb-1">Documents (opcional)</label>
                                    <input type="file" name="docs[]" multiple 
                                           class="bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                    <p class="text-xs text-gray-400 mt-1">Pots pujar més d’un fitxer. Màxim 10MB per fitxer.</p>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" class="flex items-center justify-center bg-orange-500 hover:bg-orange-600 text-white font-medium px-6 py-3 rounded-lg transition-all">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                        </svg>
                                        Guardar Seguiment
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para ver detalles -->
            <div id="view-followup" class="hidden fixed inset-0 bg-black/30 backdrop-blur-sm z-50 items-center justify-center p-4">
                <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl">
                    <div class="flex items-center justify-between p-6 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Detalls del Seguiment</h3>
                        </div>
                        <button id="close_view_followup" class="text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="p-6">
                        <div class="flex flex-col gap-6">
                            <div class="flex gap-6">
                                <div class="flex flex-col flex-1">
                                    <span class="text-sm text-gray-500 mb-1">Data</span>
                                    <span id="view_followup_date" class="font-medium text-gray-800 bg-gray-50 rounded-lg px-4 py-2">—</span>
                                </div>
                                <div class="flex flex-col flex-1">
                                    <span class="text-sm text-gray-500 mb-1">Assumpte</span>
                                    <span id="view_followup_issue" class="font-medium text-gray-800 bg-gray-50 rounded-lg px-4 py-2">—</span>
                                </div>
                            </div>

                            <div class="flex flex-col">
                                <span class="text-sm text-gray-500 mb-1">Professional</span>
                                <span id="view_followup_professional" class="font-medium text-gray-800 bg-gray-50 rounded-lg px-4 py-2">—</span>
                            </div>

                            <div class="flex flex-col">
                                <span class="text-sm text-gray-500 mb-1">Descripció</span>
                                <div id="view_followup_description" class="bg-gray-50 rounded-lg p-4 text-gray-800 min-h-[120px]">
                                    — 
                                </div>
                            </div>

                            <!-- Documentos -->
                            <div class="flex flex-col mt-4 gap-2">
                                <span class="text-sm text-gray-500">Documents</span>
                                <div id="view_followup_docs" class="flex flex-col gap-1 text-sm text-orange-500"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end p-6 border-t border-gray-200">
                        <button id="close_view_followup_btn" class="px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition-all">
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
