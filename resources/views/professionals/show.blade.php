<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/accidents.js'])
</head>
<body class="min-h-screen flex flex-col bg-body">
    @include('partials.icons')     
    @auth
        @if ($errors->any())
            <div class="w-11/12 mt-4 mx-auto">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <ul class="mt-1 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        @include('components.navbar')
        <main class="grow flex w-full">
            @include('components.sidebar')
            @yield('contingut')
                <section class="flex flex-col items-center w-full">
                    <div class="w-full bg-white flex items-center justify-between py-4 px-[5%]">
                        <div class="">
                            <h1 class="text-[#2D3E50] text-3xl pb-1 w-full font-bold">Dades de {{$professional->name}}</h1>
                            <p class="text-[#2D3E50]">Control de dades i documents de professional</p>
                        </div>
                        
                    </div>
                    <!--Dentro de este div haz los cambios-->
                    <div class="w-full px-[5%] py-6  flex flex-col gap-6">

                        <!-- BLOQUE SUPERIOR -->
                        <div class="flex flex-col xl:flex-row gap-6">

                            <!-- INFORMACIÓN PROFESIONAL -->
                            <div class="flex-1 bg-white rounded-xl shadow-sm p-6">
                                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                                    Informació professional
                                </h2>

                                <div class="flex flex-col gap-4">
                                    
                                    <div class="flex-1">
                                        <label class="text-sm text-gray-500">Estat</label>
                                        <div class="border rounded-lg px-3 py-2 text-green-600 font-semibold">
                                            Actiu
                                        </div>
                                    </div>
                                    

                                    <div class="flex gap-4">
                                        <div class="flex-1">
                                            <label class="text-sm text-gray-500">Nom</label>
                                            <div class="border rounded-lg px-3 py-2">
                                                {{ $professional->name }}
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <label class="text-sm text-gray-500">Cognoms</label>
                                            <div class="border rounded-lg px-3 py-2">
                                                {{ $professional->surnames }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex gap-4">
                                        <div class="flex-1">
                                            <label class="text-sm text-gray-500">Telèfon</label>
                                            <div class="border rounded-lg px-3 py-2">
                                                {{ $professional->phone_number }}
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <label class="text-sm text-gray-500">Email</label>
                                            <div class="border rounded-lg px-3 py-2">
                                                {{ $professional->email_address }}
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="text-sm text-gray-500">Adreça</label>
                                        <div class="border rounded-lg px-3 py-2">
                                            {{ $professional->address }}
                                        </div>
                                    </div>

                                    <div class="flex gap-4">
                                        <div class="flex-1">
                                            <label class="text-sm text-gray-500">Taquilla</label>
                                            <div class="border rounded-lg px-3 py-2">
                                                {{ $professional->number_locker }}
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <label class="text-sm text-gray-500">Ocupació</label>
                                            <div class="border rounded-lg px-3 py-2">
                                                {{ $professional->occupation }}
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <label class="text-sm text-gray-500">Clau taquilla</label>
                                            <div class="border rounded-lg px-3 py-2">
                                                ****
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- DOCUMENTS INICIALS -->
                            <div class="w-full xl:w-[35%] bg-white rounded-xl shadow-sm p-6">
                                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                                    Documents inicials
                                </h2>

                                <div class="flex flex-col gap-3">
                                    @foreach ($professional->professional_docs->where('type','start') as $doc)
                                        <div class="flex items-center justify-between border rounded-lg px-3 py-2">
                                            <span class="text-sm text-gray-700">
                                                {{ $doc->name }}
                                            </span>
                                            <a href="{{ route('professional.documents.download', [$professional, $doc]) }}"
                                            class="text-orange-500 hover:text-orange-600">
                                                ⬇
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- SUBIR DOCUMENTOS -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                                Pujar nous documents
                            </h2>

                            <form method="POST"
                                action="{{ route('professional.documents.documents_store', $professional) }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="bg-white border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-orange-400 transition">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <p class="font-medium text-gray-700 mb-1">Pujar Fitxa Completada</p>
                                    <p class="text-gray-500 text-sm mb-3">Fes clic per seleccionar</p>
                                    <input type="file" name="documents[]" multiple id="file-{{ $professional->id }}" class="hidden">
                                    <label for="file-{{ $professional->id }}" class="inline-block px-5 py-2 bg-gray-200 text-gray-800 rounded-lg font-medium hover:bg-gray-300 cursor-pointer transition">
                                        Seleccionar Arxiu
                                    </label>
                                    <p class="text-gray-400 text-xs mt-2" id="file-name-{{ $professional->id }}">Cap fitxer seleccionat</p>
                                </div>
                                
                                <div class="flex justify-end mt-4">
                                    <button type="submit" class="px-5 py-2 bg-linear-to-r from-orange-500 to-[#FEAB51] text-white font-medium rounded-lg hover:opacity-90 transition">
                                        Pujar Fitxa
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- HISTORIAL DOCUMENTOS -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                                Documents Generats
                            </h2>

                            <div class="flex flex-col gap-2">
                                @foreach ($professional->professional_docs as $doc)
                                    <div class="flex items-center justify-between border rounded-lg px-3 py-2">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-medium text-gray-700">
                                                {{ $doc->name }}
                                            </span>
                                            
                                        </div>

                                        <a href="{{ route('professional.documents.download', [$professional, $doc]) }}"
                                        class="text-orange-500 hover:text-orange-600">
                                            ⬇
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
            
                    
                </section>
        </main>
    @endauth

    @guest
        <div class="min-h-screen flex items-center justify-center bg-gray-50">
            <div class="text-center">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">No has iniciat sessió</h1>
                <p class="text-gray-600 mb-6">Seràs redirigit automàticament...</p>
                <a href="{{ route('login') }}" class="text-orange-500 hover:text-orange-600 font-medium">
                    Anar a l'inici de sessió →
                </a>
            </div>
        </div>
        <meta http-equiv="refresh" content="3; URL={{ route('login') }}" />
    @endguest
</body>
</html>