<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dades del servei general</title>
    @vite(['resources/css/app.css'])
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
            
            <section class="flex flex-col items-center w-full">
                <div class="w-full bg-white flex items-center justify-between py-4 px-[5%]">
                    <div class="">
                        <h1 class="text-[#2D3E50] text-3xl pb-1 w-full font-bold">Dades del servei general</h1>
                        <p class="text-[#2D3E50]">Control i gestió del servei {{ $general_service->type }}</p>
                    </div>
                    
                    <div class="flex gap-4">
                        <a href="{{ route('general_service.edit', $general_service->id) }}" 
                           class="px-5 py-2 bg-linear-to-r from-orange-500 to-[#FEAB51] text-white font-medium rounded-lg hover:opacity-90 transition flex items-center">
                            <svg class="w-5 h-5 mr-2">
                                <use xlink:href="#edit_icon"></use>
                            </svg>
                            Editar servei
                        </a>
                    </div>
                </div>

                <!-- Contenido principal -->
                <div class="w-full px-[5%] py-6 flex flex-col gap-6">

                    <!-- BLOQUE SUPERIOR -->
                    <div class="flex flex-col xl:flex-row gap-6">

                        <!-- INFORMACIÓN BÁSICA DEL SERVICIO -->
                        <div class="flex-1 bg-white rounded-xl shadow-sm p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                                Informació bàsica
                            </h2>

                            <div class="flex flex-col gap-4">
                                <div class="flex gap-4">
                                    <div class="flex-1">
                                        <label class="text-sm text-gray-500">Tipus de servei</label>
                                        <div class="border rounded-lg px-3 py-2">
                                            {{ $general_service->type }}
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <label class="text-sm text-gray-500">Centre</label>
                                        <div class="border rounded-lg px-3 py-2">
                                            {{ $general_service->centers->name ?? 'No assignat' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CONTACTO Y RESPONSABLE -->
                        <div class="flex-1 bg-white rounded-xl shadow-sm p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                                Contacte i responsable
                            </h2>

                            <div class="flex flex-col gap-4">
                                <div class="flex gap-4">
                                    <div class="flex-1">
                                        <label class="text-sm text-gray-500">Manager/Responsable</label>
                                        <div class="border rounded-lg px-3 py-2">
                                            {{ $general_service->manager ?? 'No assignat' }}
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <label class="text-sm text-gray-500">Contacte</label>
                                        <div class="border rounded-lg px-3 py-2">
                                            @if($general_service->contact)
                                                <a href="mailto:{{ $general_service->contact }}" class="text-orange-500 hover:underline">
                                                    {{ $general_service->contact }}
                                                </a>
                                            @else
                                                No definit
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BLOQUE MEDIO - PERSONAL Y HORARIO -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">
                            Personal i horari
                        </h2>

                        <div class="flex flex-col gap-4">
                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="text-sm text-gray-500">Personal assignat</label>
                                    <div class="border rounded-lg px-3 py-2">
                                        {{ $general_service->staff ?? 'No assignat' }}
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <label class="text-sm text-gray-500">Horari</label>
                                    <div class="border rounded-lg px-3 py-2">
                                        {{ $general_service->schedule ?? 'No definit' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ACCIONES RÁPIDAS -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">
                            Accions ràpides
                        </h2>

                        <div class="flex flex-col md:flex-row gap-4">
                            <a href="{{ route('general_service_followup.index', $general_service) }}" 
                               class="flex-1 bg-gray-50 border border-gray-200 rounded-lg p-4 hover:border-orange-300 hover:bg-orange-50 transition group">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-orange-100 rounded-lg group-hover:bg-orange-200 transition">
                                        <svg class="w-6 h-6 text-orange-500">
                                            <use xlink:href="#evaluations_icon"></use>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-800 group-hover:text-orange-600">Gestió de seguiments</h3>
                                        <p class="text-sm text-gray-500">Accedeix als seguiments d'aquest servei</p>
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('general_service.edit', $general_service->id) }}" 
                               class="flex-1 bg-gray-50 border border-gray-200 rounded-lg p-4 hover:border-orange-300 hover:bg-orange-50 transition group">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-orange-100 rounded-lg group-hover:bg-orange-200 transition">
                                        <svg class="w-6 h-6 text-orange-500">
                                            <use xlink:href="#edit_icon"></use>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-800 group-hover:text-orange-600">Editar servei</h3>
                                        <p class="text-sm text-gray-500">Modifica la informació del servei</p>
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('general_service.index') }}" 
                               class="flex-1 bg-gray-50 border border-gray-200 rounded-lg p-4 hover:border-orange-300 hover:bg-orange-50 transition group">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-orange-100 rounded-lg group-hover:bg-orange-200 transition">
                                        <svg class="w-6 h-6 text-orange-500">
                                            <use xlink:href="#arrow_left_icon"></use>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-800 group-hover:text-orange-600">Tornar a la llista</h3>
                                        <p class="text-sm text-gray-500">Veure tots els serveis generals</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- INFORMACIÓN DEL SISTEMA -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">
                            Informació del sistema
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                <label class="text-sm text-gray-500">ID del servei</label>
                                <div class="font-medium text-gray-800 mt-1">{{ $general_service->id }}</div>
                            </div>
                            
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                <label class="text-sm text-gray-500">Creat el</label>
                                <div class="font-medium text-gray-800 mt-1">{{ $general_service->created_at->format('d/m/Y H:i') }}</div>
                            </div>
                            
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                <label class="text-sm text-gray-500">Actualitzat el</label>
                                <div class="font-medium text-gray-800 mt-1">{{ $general_service->updated_at->format('d/m/Y H:i') }}</div>
                            </div>
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