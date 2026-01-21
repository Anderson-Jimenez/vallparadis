<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Documents Externs</title>
    @vite(['resources/css/app.css', 'resources/js/documents_center.js'])
</head>
<body class="min-h-screen flex flex-col bg-[#fef2e6]">

    @if ($errors->any())
        <div class="fixed top-4 right-4 z-50">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    
    @include('partials.icons')
    
    @auth
        @include('components.navbar')

        <main class="flex w-full flex-1">
            @include('components.sidebar')
            
            <section class="w-full flex flex-col items-center gap-8 p-4">
                <div class="w-11/12 border-b-4 border-[#213c57] flex items-center py-4">
                    <h1 class="text-[#2D3E50] text-4xl pt-7 pb-1">Gestió Documents del Centre</h1>
                </div>

                <section class="w-11/12 flex flex-col lg:flex-row gap-6">
                    <!-- Sección izquierda - Formulario (altura más compacta) -->
                    <aside class="w-full lg:w-1/2 bg-white shadow-lg rounded-lg p-6 flex flex-col h-fit">
                        <form action="{{ route('documents_center.store') }}" method="post" enctype="multipart/form-data" class="flex flex-col">
                            @csrf
                            <input type="hidden" name="professional_id" value="{{ auth()->user()->professional_id ?? old('professional_id') }}">
                            <input type="hidden" name="center_id" value="{{ auth()->user()->professional->center_id ?? old('center_id') }}">

                            <div class="flex items-center w-full mb-6">
                                <svg class="bg-[#ff7300] rounded-full w-12 h-12 p-2 mr-3 text-white shrink-0">
                                    <use xlink:href="#cloud_icon"></use>
                                </svg>
                                <h2 class="text-[#2D3E50] text-2xl font-bold">Pujar un nou document</h2>
                            </div>

                            <!-- Sección para subir archivos (más compacta) -->
                            <div class="mb-6">
                                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-40 bg-[#fef2e6] border-2 border-dashed border-[#ff7300] rounded-lg cursor-pointer hover:bg-orange-50 transition-colors">
                                    <div class="flex flex-col items-center justify-center p-4">
                                        <svg class="w-10 h-10 mb-3 text-[#ff7300]">
                                            <use xlink:href="#add_docs_icon"></use>
                                        </svg>
                                        <p class="mb-1 text-sm text-[#ff7300] font-semibold text-center">
                                            Click per pujar arxius<br>o arrossega i deixa anar
                                        </p>
                                        <p class="text-xs text-[#ff7300]">PDF, CSV, DOCX o DOC</p>
                                    </div>
                                    <input id="dropzone-file" type="file" class="hidden" name="files[]" multiple required />
                                </label>
                            </div>

                            <div id="selected-files" class="mb-4 p-3 bg-gray-50 border border-gray-200 rounded-lg hidden">
                                <h3 class="text-base font-semibold mb-2 text-[#2D3E50]">Arxius seleccionats:</h3>
                                <ul id="file-list" class="space-y-1 max-h-32 overflow-y-auto text-sm">
                                </ul>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="type" class="block text-base mb-1 text-[#2D3E50] font-medium">Tipus de document</label>
                                    <select class="w-full bg-white border border-[#ff7300] rounded-lg p-3 text-sm focus:ring-2 focus:ring-[#ff7300] focus:border-transparent" required name="type" id="type">
                                        <option value="">Selecciona tipus de document</option>
                                        <option value="organitzacio_centre" {{ old('type') == 'organitzacio_centre' ? 'selected' : '' }}>
                                            Organització del Centre
                                        </option>
                                        <option value="documents_departament" {{ old('type') == 'documents_departament' ? 'selected' : '' }}>
                                            Documents del Departament
                                        </option>
                                        <option value="memories_seguiment" {{ old('type') == 'memories_seguiment' ? 'selected' : '' }}>
                                            Memòries i Seguiment anual
                                        </option>
                                        <option value="prl" {{ old('type') == 'prl' ? 'selected' : '' }}>
                                            PRL
                                        </option>
                                        <option value="comite_empresa" {{ old('type') == 'comite_empresa' ? 'selected' : '' }}>
                                            Comitè d'Empresa
                                        </option>
                                        <option value="informes_professionals" {{ old('type') == 'informes_professionals' ? 'selected' : '' }}>
                                            Informes professionals
                                        </option>
                                        <option value="informes_usuaris" {{ old('type') == 'informes_usuaris' ? 'selected' : '' }}>
                                            Informes persones usuàries
                                        </option>
                                        <option value="qualitat_iso" {{ old('type') == 'qualitat_iso' ? 'selected' : '' }}>
                                            Qualitat i ISO
                                        </option>
                                        <option value="projectes" {{ old('type') == 'projectes' ? 'selected' : '' }}>
                                            Projectes
                                        </option>
                                        <option value="comissions" {{ old('type') == 'comissions' ? 'selected' : '' }}>
                                            Comissions
                                        </option>
                                        <option value="families" {{ old('type') == 'families' ? 'selected' : '' }}>
                                            Famílies
                                        </option>
                                        <option value="comunicacio_reunions" {{ old('type') == 'comunicacio_reunions' ? 'selected' : '' }}>
                                            Comunicació i Reunions
                                        </option>
                                        <option value="altres" {{ old('type') == 'altres' ? 'selected' : '' }}>
                                            Altres
                                        </option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="date" class="block text-base mb-1 text-[#2D3E50] font-medium">Data del document</label>
                                    <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" id="date" class="w-full bg-white border border-[#ff7300] rounded-lg p-3 text-sm focus:ring-2 focus:ring-[#ff7300] focus:border-transparent" required />
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="description" class="block text-base mb-1 text-[#2D3E50] font-medium">Descripció</label>
                                <textarea name="description" 
                                        id="description" 
                                        rows="3" 
                                        class="w-full bg-white border border-[#ff7300] rounded-lg p-3 text-sm focus:ring-2 focus:ring-[#ff7300] focus:border-transparent" 
                                        placeholder="Descripció del document..."
                                        required>{{ old('description') }}</textarea>
                            </div>
                            
                            <button type="submit" class="cursor-pointer w-full bg-[#ff7300] text-white rounded-lg p-3 font-semibold hover:bg-orange-600 transition-colors duration-300 text-base mt-2">
                                Pujar document
                            </button>
                        </form>
                    </aside>

                    <aside class="w-full lg:w-1/2 bg-white shadow-xl rounded-lg p-6 flex flex-col">
                        <div class="flex flex-col md:flex-row md:items-center justify-between w-full mb-4">
                            <div class="flex items-center mb-3 md:mb-0">
                                <svg class="bg-[#ff7300] rounded-full w-10 h-10 p-2 mr-3 text-white shrink-0">
                                    <use xlink:href="#download_icon"></use>
                                </svg>
                                <h2 class="text-[#2D3E50] text-xl font-bold">Documents</h2>
                            </div>
                            <form method="GET" action="{{ route('external_contacts.index') }}" class="flex space-x-4 items-center">
                                <div class="relative">
                                    <input type="search" 
                                        id="search_input"
                                        name="text"
                                        placeholder="Cercar documents..." 
                                        class="w-full md:w-56 bg-white border border-[#ff7300] rounded-lg pl-3 pr-8 py-2 text-sm focus:ring-2 focus:ring-[#ff7300] focus:border-transparent"
                                    >
                                    <svg class="absolute right-2 top-1/2 transform -translate-y-1/2 w-4 h-4 text-[#ff7300]">
                                        <use xlink:href="#search_loupe"></use>
                                    </svg>
                                </div>
                            </form>    
                        </div>
                        <div class="flex-1 overflow-y-auto pr-1 max-h-[500px]" id="search_results">
                            <div class="space-y-3">
                                @foreach ($documents_center as $info)
                                    @foreach ($info->documents_center as $doc)
                                        @php
                                            $extension = strtolower(pathinfo($doc->path, PATHINFO_EXTENSION));
                                            $iconId = match ($extension) {
                                                'pdf' => 'icon-pdf',
                                                'doc', 'docx' => 'icon-word',
                                                'xls', 'xlsx' => 'icon-excel',
                                                'csv' => 'icon-csv',
                                                default => 'icon-file',
                                            };
                                            $iconColor = match ($extension) {
                                                'pdf' => 'text-red-500',
                                                'doc', 'docx' => 'text-blue-500',
                                                'xls', 'xlsx', 'csv' => 'text-green-600',
                                                default => 'text-gray-400',
                                            };
                                        @endphp
                                        
                                        <div class="flex items-center justify-between p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                            <div class="flex items-center gap-3 min-w-0 flex-1">
                                                <svg class="w-6 h-6 {{ $iconColor }} shrink-0">
                                                    <use xlink:href="#{{ $iconId }}"></use>
                                                </svg>
                                                <div class="min-w-0 flex-1">
                                                    @php
                                                        $filename = preg_replace('/^\d+-/', '', basename($doc->path));
                                                    @endphp
                                                    <p class="font-medium text-gray-800 text-sm truncate">
                                                        {{ $filename }}
                                                    </p>
                                                    <p class="text-xs text-gray-500 truncate">
                                                        {{ $info->type }} · {{ $info->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="shrink-0 ml-2">
                                                <a href="{{ route('documents_center.download', $doc->id) }}" class="text-[#ff7300] hover:text-orange-600">
                                                    <svg class="w-5 h-5">
                                                        <use xlink:href="#download_icon"></use>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </aside>
                </section>

                <!-- Sección de últimos archivos subidos -->
                <section class="w-11/12 bg-white shadow-lg rounded-lg p-6 mb-8">
                    <div class="flex items-center mb-4">
                        <svg class="bg-[#ff7300] rounded-full w-9 h-9 p-2 mr-3 text-white shrink-0">
                            <use xlink:href="#clock_icon"></use>
                        </svg>
                        <h2 class="text-[#2D3E50] text-xl font-bold">
                            Últims arxius pujats
                        </h2>
                    </div>

                    <div class="space-y-2 max-h-[300px] overflow-y-auto pr-1">
                        @forelse ($latest_documents as $doc)
                            @php
                                $extension = strtolower(pathinfo($doc->path, PATHINFO_EXTENSION));
                                $iconId = match ($extension) {
                                    'pdf' => 'icon-pdf',
                                    'doc', 'docx' => 'icon-word',
                                    'xls', 'xlsx', 'csv' => 'icon-excel',
                                    default => 'icon-file',
                                };
                                $iconColor = match ($extension) {
                                    'pdf' => 'text-red-500',
                                    'doc', 'docx' => 'text-blue-500',
                                    'xls', 'xlsx', 'csv' => 'text-green-600',
                                    default => 'text-gray-400',
                                };
                                $filename = preg_replace('/^\d+-/', '', basename($doc->path));
                            @endphp

                            <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="flex items-center gap-3 min-w-0 flex-1">
                                    <svg class="w-6 h-6 {{ $iconColor }} shrink-0">
                                        <use xlink:href="#{{ $iconId }}"></use>
                                    </svg>
                                    <div class="min-w-0 flex-1">
                                        <p class="font-medium text-gray-800 text-sm truncate">{{ $filename }}</p>
                                        <p class="text-xs text-gray-500 truncate">
                                            {{ $doc->document_center_info->type }} · {{ $doc->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <div class="shrink-0 ml-2">
                                    <a href="{{ route('documents_center.download', $doc->id) }}" class="text-[#ff7300] hover:text-orange-600">
                                        <svg class="w-5 h-5">
                                            <use xlink:href="#download_icon"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4 text-sm">
                                Encara no hi ha arxius pujats.
                            </p>
                        @endforelse
                    </div>
                </section>
            </section>
        </main>
    @endauth
    
    @guest
        <div class="min-h-screen flex items-center justify-center">
            <div class="text-center">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">No has iniciat sessió.</h1>
                <p class="text-gray-600">Redirigint a la pàgina d'inici de sessió...</p>
            </div>
        </div>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>