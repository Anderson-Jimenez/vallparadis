<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Afegir nou contacte</title>
    @vite(['resources/css/app.css', 'resources/js/documents_center.js'])
</head>

<body class="bg-orange-50 min-h-screen">
@include('partials.icons')

@auth
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
    @include('components.navbar')
    <main class="flex justify-center py-10">
        <div class="w-3/4">
            <a href="{{ route('maintenance.index') }}" class="border border-[#ff7300] txt-orange hover:underline px-6 py-4 rounded-xl">
                Tornar a la llista de manteniments
            </a>
                <div class="bg-orange-500 text-white px-6 py-3">
                    <p class="font-semibold">Informació del manteniment</p>
                    
                </div>

                <div class="p-8 flex flex-col gap-8 bg-white">
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Informació bàsica</h2>
                        <div>
                            <label class="text-sm text-gray-600">Nom manteniment</label>
                            <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">{{$maintenance->name}}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Data d'obertura *</label>
                            <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">{{ $maintenance->start_date  }}</p>
                        </div>
                    </section>
                    
                    </section>
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Detalls de contacte del responsable</h2>

                        <div class="flex gap-4">
                            <div class="w-1/2">
                                <label class="text-sm text-gray-600">Responsable</label>
                                <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">{{$maintenance->manager}}</p>
                            </div>

                            <div class="w-1/2">
                                <label class="text-sm text-gray-600">Telèfon</label>
                                @if ($maintenance->phone)
                                    <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">{{$maintenance->phone}}</p>
                                @else
                                    <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 text-gray-600">N/A</p>
                                @endif
                                
                            </div>
                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Correu electrònic </label>
                            @if ($maintenance->email)
                                <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">{{$maintenance->email}}</p>
                            @else
                                <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 text-gray-600">N/A</p>
                            @endif
                        </div>
                    </section>
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Informació addicional</h2>
                        <textarea disabled rows="3" class="w-full border-2 border-gray-200 rounded-md px-3 py-2">{{$maintenance->description}}</textarea>
                        <h2 class="font-semibold text-gray-700">Afegir/Veure documentació</h2>
                        <section class="w-full max-w-7xl flex flex-col lg:flex-row gap-6">
                            <!-- Sección izquierda - Formulario (altura más compacta) -->
                            <aside class="w-full lg:w-1/2 bg-white shadow-lg rounded-lg p-6 flex flex-col h-fit">
                                <form action="{{ route('maintenance.documents.store', $maintenance) }}" method="post" enctype="multipart/form-data" class="flex flex-col">
                                    @csrf
                                    

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
                                            <input id="dropzone-file" type="file" class="hidden" name="docs[]" multiple required />
                                        </label>
                                    </div>

                                    <div id="selected-files" class="mb-4 p-3 bg-gray-50 border border-gray-200 rounded-lg hidden">
                                        <h3 class="text-base font-semibold mb-2 text-[#2D3E50]">Arxius seleccionats:</h3>
                                        <ul id="file-list" class="space-y-1 max-h-32 overflow-y-auto text-sm">
                                        </ul>
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
                                        @foreach ($maintenance->maintenance_docs as $doc)
                                            
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
                                                            {{ $doc->type }} · {{ $doc->created_at->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="shrink-0 ml-2">
                                                    <a href="{{ route('maintenance.documents.download', $doc) }}" class="text-[#ff7300] hover:text-orange-600">
                                                        <svg class="w-5 h-5">
                                                            <use xlink:href="#download_icon"></use>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                            
                                        @endforeach
                                    </div>
                                </div>
                            </aside>
                        </section>
                    </section>
                    <div class="flex flex-col items-center w-full bg-white ">
                        <p>Signatura</p>
                        <img src="{{ $maintenance->signature }}" alt="firma" class="w-2/6">
                    </div>
                    <div class="flex justify-between items-center border-t pt-6">
                        <a href="{{ route('maintenance.edit', $maintenance) }}" class="border border-[#ff7300] txt-orange hover:underline px-6 py-4 rounded-xl">
                            Modificar dades
                        </a>

                        <a href="{{ route('maintenance.followups.index', $maintenance) }}" class="bg-orange-500 text-white px-6 py-4 rounded-md hover:bg-white hover:text-[#ff7300] hover:border-[#ff7300] border flex items-center">
                            <svg class="w-6 h-6 mr-2">
                                <use xlink:href="#maintenance_icon"></use>
                            </svg>
                            Veure / Afegir seguiments
                        </a>
                    </div>
                </div>
            
        </div>
    </main>
    @endauth

    @guest
        <h1>No has iniciat sessió.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}">
    @endguest
</body>
</html>
