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
                            <h1 class="text-[#2D3E50] text-3xl pb-1 w-full font-bold">Gestió d'Accidentabilitat</h1>
                            <p class="text-[#2D3E50]">Control i seguiment d'accidents laborals</p>
                        </div>
                        
                    </div>
                                        
                    <div class="w-11/12 bg-white flex flex-col mt-6 rounded-lg">
                        <div class="bg-orange-500 text-white px-6 py-3 rounded-t-lg">
                            <h1 class="text-3xl pb-1 w-full font-bold">Accidents de treball de {{ $professional->name }}</h1>
                            <p>Registre</p>
                        </div>
                        
                        <!-- FORMULARIO NUEVO ACCIDENTE -->
                        <form action="{{ route('professionals.accidents.store', $professional) }}" method="POST" enctype="multipart/form-data" class="bg-[#FEF2F2] rounded-lg mx-5 my-7 px-6 py-8 ">
                            @csrf
                            
                            <p class="font-semibold text-lg">Nova entrada</p>
                            <div class="flex gap-5">
                                <div class="w-1/2">
                                    <p class="font-medium">Data d'inici de la baixa *</p>
                                    <input type="date" name="start_date" value="{{ old('start_date', date('Y-m-d')) }}" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 bg-white">
                                </div>
                                <div class="w-1/2">
                                    <p class="font-medium">Professional que Emplena</p>
                                    <input type="text" disabled value="{{Auth::user()->name}}" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 bg-gray-100">
                                    <input type="hidden" name="registred_professional_id" value="{{Auth::id()}}">
                                </div>
                            </div>
                            <div class="flex gap-5 my-5">
                                <div class="w-1/2">
                                    <p class="font-medium">Data final de la baixa (opcional)</p>
                                    <input type="date" name="end_date" value="{{ old('end_date') }}" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 bg-white">
                                </div>
                                <div class="w-1/2">
                                    <p class="font-medium">Incidencia *</p>
                                    <input type="text" name="issue" placeholder="Escriu el motiu de la incidencia..." value="{{old('issue')}}" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 bg-white">
                                </div>
                            </div>
                            
                            <p class="font-medium">Descripció de la incidència *</p>
                            <textarea placeholder="Descriu que ha passat..." name="description" rows="4" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 bg-white">{{ old('description') }}</textarea>
                            
                            <div class="flex mt-5 gap-3 justify-end">
                                <button type="reset" class="px-6 py-3 bg-[#E5E7EB] text-gray-800 font-medium rounded-lg hover:bg-gray-300 transition">
                                    Cancel·lar
                                </button>
                                <button type="submit" class="px-6 py-3 bg-linear-to-r from-orange-500 to-[#FEAB51] text-white font-medium rounded-lg hover:opacity-90 transition">
                                    Guardar Accident
                                </button>
                            </div>
                        </form>

                        <!-- PLANTILLA GLOBAL -->
                        <div class="bg-white border border-gray-200 rounded-lg mx-5 my-4 p-6">
                            <h3 class="text-lg font-bold text-[#2D3E50] mb-4">Plantilla d'Accident</h3>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="font-medium text-gray-800">Fitxa d'Accident en Blanc</p>
                                        <p class="text-gray-500 text-sm">Document buit per emplenar manualment</p>
                                    </div>
                                </div>
                                <a href="{{ route('accidents.template.download') }}" 
                                   class="px-5 py-2 bg-linear-to-r from-orange-500 to-[#FEAB51] text-white font-medium rounded-lg hover:opacity-90 transition">
                                    Descarregar Plantilla
                                </a>
                            </div>
                        </div>

                        <!-- LISTA DE ACCIDENTES -->
                        <div class="w-full h-[500px] overflow-y-auto" id="accidents-container">
                            @foreach ($accidents as $accident)
                                <div class="accident-item cursor-pointer bg-white mx-5 my-4 p-6 rounded-xl shadow-sm border-l-4
                                    {{ $accident->status === 'inactive'
                                        ? 'border-gray-400'
                                        : ($accident->days > 30 ? 'border-red-500' : 'border-orange-400') }}"
                                    data-accident-id="{{ $accident->id }}">

                                    <!-- Icon -->
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 rounded-full flex items-center justify-center
                                            {{ $accident->status === 'inactive'
                                                ? 'bg-gray-100 text-gray-400'
                                                : ($accident->days > 30 ? 'bg-red-100 text-red-500' : 'bg-orange-100 text-orange-500') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 3a4 4 0 100 8 4 4 0 000-8zM2 21v-2a6 6 0 0112 0v2H2zm13.5-8.5l6 6-1.5 1.5-6-6V11h1.5z"/>
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="flex-1 flex flex-col">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h2 class="text-lg font-bold text-[#2D3E50]">
                                                    {{ $accident->issue ?? 'No especificat' }}
                                                </h2>
                                                <p class="text-sm text-gray-500">
                                                    {{ $accident->start_date ? date('d/m/Y', strtotime($accident->start_date)) : 'No data' }}
                                                    -
                                                    {{ $accident->registred_professional?->name ?? 'Desconocido' }}
                                                </p>
                                            </div>

                                            <div class="flex items-center gap-2">
                                                <span class="font-semibold
                                                    {{ $accident->status === 'inactive'
                                                        ? 'text-gray-400'
                                                        : ($accident->days > 30 ? 'text-red-500' : 'text-orange-500') }}">
                                                    {{ $accident->days }} dies
                                                </span>
                                                
                                                @php
                                                    $show_followup_button = true;
                                                    $is_power_3 = auth()->user()->role_id == 3;
                                                    
                                                    if ($is_power_3 && $accident->end_date) {
                                                        $duration_days = (strtotime($accident->end_date) - strtotime($accident->start_date)) / 86400;
                                                        $show_followup_button = $duration_days <= 30;
                                                    }
                                                @endphp
                                                
                                                @if($show_followup_button)
                                                    <a href="{{ route('professionals.accidents.followups.index', [$professional, $accident]) }}" 
                                                    class="ml-3 px-4 py-2 bg-linear-to-r from-blue-500 to-blue-600 text-white text-sm font-medium rounded-lg hover:opacity-90 transition flex items-center gap-2">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                        </svg>
                                                        Seguiments
                                                    </a>
                                                @elseif($is_power_3 && $accident->end_date)
                                                    <span class="ml-3 px-4 py-2 bg-gray-200 text-gray-600 text-sm font-medium rounded-lg flex items-center gap-2 cursor-not-allowed">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                        </svg>
                                                        Seguiments
                                                    </span>
                                                @endif
                                                
                                                <svg class="w-5 h-5 text-gray-400 transform transition-transform duration-300" id="arrow-{{ $accident->id }}" 
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </div>
                                        </div>

                                        <p class="mt-3 text-sm text-gray-700 whitespace-normal">
                                            <span class="font-semibold">Professional afectat:</span>
                                            {{ $accident->affected_professional?->name ?? 'Desconocido' }}
                                        </p>

                                        <p class="mt-2 text-sm text-gray-600 whitespace-normal">
                                            <span class="font-semibold">Descripció:</span>
                                            {{ $accident->description ?? 'No descripció' }}
                                        </p>
                                    </div>

                                    <!-- Desplegable oculto -->
                                    <div id="details-{{ $accident->id }}" class="hidden mt-6 pt-6 border-t border-gray-200">
                                        <div class="bg-[#F8F9FA] rounded-lg p-5">
                                            <h3 class="text-lg font-bold text-[#2D3E50] mb-4">Gestió de Fitxes</h3>
                                            <p class="text-gray-600 mb-5">Pujar i descarregar documents d'aquest accident</p>

                                            <!-- Formulario para subir fitxa -->
                                            <form action="{{ route('accidents.documents.store', $accident) }}" method="POST" enctype="multipart/form-data" class="mb-6">
                                                @csrf
                                                <div class="bg-white border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-orange-400 transition">
                                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                    </svg>
                                                    <p class="font-medium text-gray-700 mb-1">Pujar Fitxa Completada</p>
                                                    <p class="text-gray-500 text-sm mb-3">Fes clic per seleccionar</p>
                                                    <input type="file" name="document" id="file-{{ $accident->id }}" class="hidden">
                                                    <label for="file-{{ $accident->id }}" class="inline-block px-5 py-2 bg-gray-200 text-gray-800 rounded-lg font-medium hover:bg-gray-300 cursor-pointer transition">
                                                        Seleccionar Arxiu
                                                    </label>
                                                    <p class="text-gray-400 text-xs mt-2" id="file-name-{{ $accident->id }}">Cap fitxer seleccionat</p>
                                                </div>
                                                
                                                <div class="flex justify-end mt-4">
                                                    <button type="submit" class="px-5 py-2 bg-linear-to-r from-orange-500 to-[#FEAB51] text-white font-medium rounded-lg hover:opacity-90 transition">
                                                        Pujar Fitxa
                                                    </button>
                                                </div>
                                            </form>

                                            <!-- Fitxes existents -->
                                            <div>
                                                <h4 class="font-bold text-gray-800 mb-3">Fitxes Pujades</h4>
                                                
                                                @if($accident->accident_doc->count() > 0)
                                                    <div class="space-y-3">
                                                        @foreach($accident->accident_doc as $doc)
                                                            <div class="flex items-center justify-between bg-white border border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                                                                <div class="flex items-center gap-3">
                                                                    <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                                    </svg>
                                                                    <div>
                                                                        <p class="font-medium text-gray-800">{{ $doc->name }}</p>
                                                                        <p class="text-xs text-gray-500">Pujat el {{ $doc->created_at->format('d/m/Y') }}</p>
                                                                    </div>
                                                                </div>
                                                                <a href="{{ route('accidents.documents.download', $doc) }}" 
                                                                class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition">
                                                                    Descarregar
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="text-center py-6 bg-gray-50 rounded-lg">
                                                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                        <p class="text-gray-500">No hi ha fitxes pujades per a aquest accident</p>
                                                        <p class="text-gray-400 text-sm mt-2">Pots descarregar la plantilla des de dalt per emplenar-la</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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