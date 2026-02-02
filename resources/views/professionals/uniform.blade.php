<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignament d'Uniforme</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50">
    @include('partials.icons')
    
    @auth
        @include('components.navbar')
        
        <div class="flex">
            @include('components.sidebar')
            
            <main class="flex-1 p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Assignament d'Uniforme</h1>
                        <p class="text-gray-600">Assignar talles d'uniforme al professional seleccionat</p>
                    </div>
                    <a href="{{ route('professional.index') }}" 
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-200">
                        ← Tornar al llistat
                    </a>
                </div>

                <!-- Mensajes de éxito -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <!-- Mensajes de error -->
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <strong class="font-bold">Errors:</strong>
                        </div>
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Información del Professional -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                        <div class="flex items-start mb-4 md:mb-0">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-r from-orange-100 to-orange-50 flex items-center justify-center mr-4 border-2 border-orange-200">
                                <span class="text-xl font-bold text-orange-600">
                                    {{ substr($professional->name, 0, 1) }}{{ substr($professional->surnames, 0, 1) }}
                                </span>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">{{ $professional->name }} {{ $professional->surnames }}</h2>
                                <p class="text-gray-600">{{ $professional->occupation }}</p>
                                <div class="flex items-center mt-2 space-x-4">
                                    @if($professional->status == 'active')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                            Actiu
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                            <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                            Inactiu
                                        </span>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Formulario de Assignación -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-2">Assignació de Talles d'Uniforme</h2>
                            <p class="text-gray-600 mb-6">Configura les talles i documentació de l'uniforme</p>

                            <form action="{{ route('professional.uniform', $professional) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <!-- Talla Samarreta -->
                                    <div>
                                        <label for="shirt_size" class="block text-sm font-medium text-gray-700 mb-2">
                                            Talla Samarreta 
                                        </label>
                                        <select name="shirt_size" id="shirt_size"
                                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200 bg-white">
                                            <option value="">Selecciona talla</option>
                                            <option value="XS" {{ old('shirt_size') == 'XS' ? 'selected' : '' }}>XS</option>
                                            <option value="S" {{ old('shirt_size') == 'S' ? 'selected' : '' }}>S</option>
                                            <option value="M" {{ old('shirt_size') == 'M' ? 'selected' : '' }}>M</option>
                                            <option value="L" {{ old('shirt_size') == 'L' ? 'selected' : '' }}>L</option>
                                            <option value="XL" {{ old('shirt_size') == 'XL' ? 'selected' : '' }}>XL</option>
                                            <option value="2XL" {{ old('shirt_size') == '2XL' ? 'selected' : '' }}>2XL</option>
                                            <option value="3XL" {{ old('shirt_size') == '3XL' ? 'selected' : '' }}>3XL</option>
                                            <option value="4XL" {{ old('shirt_size') == '4XL' ? 'selected' : '' }}>4XL</option>
                                        </select>
                                    </div>

                                    <!-- Data de Renovació -->
                                    <div>
                                        <label for="renovation_date" class="block text-sm font-medium text-gray-700 mb-2">
                                            Data de Renovació *
                                        </label>
                                        <input type="date" name="renovation_date" id="renovation_date"
                                               value="{{ old('renovation_date', date('Y-m-d')) }}"
                                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200 bg-white">
                                    </div>

                                    <!-- Talla Pantalons -->
                                    <div>
                                        <label for="trousers_size" class="block text-sm font-medium text-gray-700 mb-2">
                                            Talla Pantalons 
                                        </label>
                                        <select name="trausers_size" id="trausers_size"
                                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200 bg-white">
                                            <option value="">Selecciona talla</option>
                                            @for($i = 28; $i <= 60; $i += 2)
                                                <option value="{{ $i }}" {{ old('trausers_size') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <!-- Talla Sabates -->
                                    <div>
                                        <label for="shoes_size" class="block text-sm font-medium text-gray-700 mb-2">
                                            Talla Sabates 
                                        </label>
                                        <select name="shoes_size" id="shoes_size"
                                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200 bg-white">
                                            <option value="">Selecciona talla</option>
                                            @php
                                                $shoeSizes = [
                                                    '36' => '36 EU (5 US)',
                                                    '37' => '37 EU (6 US)',
                                                    '38' => '38 EU (7 US)',
                                                    '39' => '39 EU (8 US)',
                                                    '40' => '40 EU (9 US)',
                                                    '41' => '41 EU (10 US)',
                                                    '42' => '42 EU (11 US)',
                                                    '43' => '43 EU (12 US)',
                                                    '44' => '44 EU (13 US)',
                                                    '45' => '45 EU (14 US)',
                                                    '46' => '46 EU (15 US)',
                                                    '47' => '47 EU (16 US)',
                                                ];
                                            @endphp
                                            @foreach($shoeSizes as $size => $label)
                                                <option value="{{ $size }}" {{ old('shoes_size') == $size ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Observacions -->
                                

                                <!-- Arxiu Adjunt -->
                                <div class="mb-8">
                                    <label for="docs_route" class="block text-sm font-medium text-gray-700 mb-2">
                                        Document Adjunt *
                                    </label>
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-orange-400 transition duration-200 bg-white">
                                        <input type="file" name="docs_route" id="docs_route" required
                                               class="w-full p-2"
                                               accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                        
                                    </div>
                                </div>

                                <!-- Resum de l'Assignació -->
                                <div class="bg-gradient-to-r from-orange-50 to-yellow-50 rounded-lg p-6 mb-8 border border-orange-100">
                                    <h3 class="font-bold text-gray-700 mb-4 text-lg">Uniforme actual</h3>
                                    <div class="grid grid-cols-3 gap-4">
                                        <!-- Samarreta -->
                                        <div class="text-center bg-white rounded-lg p-4 shadow-sm">
                                            <div class="w-8 h-8 mx-auto mb-2 text-orange-500">
                                                <svg fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M21 6h-4V3a1 1 0 00-1-1H8a1 1 0 00-1 1v3H3a1 1 0 00-1 1v11a3 3 0 003 3h14a3 3 0 003-3V7a1 1 0 00-1-1zM9 4h6v2H9V4z"/>
                                                </svg>
                                            </div>
                                            <p class="text-sm text-gray-500 mb-1">Samarreta</p>
                                            <p class="text-lg font-bold text-gray-800">
                                                {{ $lastShirtSize ?: 'N/D' }}
                                            </p>
                                        </div>
                                        
                                        <!-- Pantalons -->
                                        <div class="text-center bg-white rounded-lg p-4 shadow-sm">
                                            <div class="w-8 h-8 mx-auto mb-2 text-blue-500">
                                                <svg fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"/>
                                                </svg>
                                            </div>
                                            <p class="text-sm text-gray-500 mb-1">Pantalons</p>
                                            <p class="text-lg font-bold text-gray-800">
                                                {{ $lastTrousersSize ?: 'N/D' }}
                                            </p>
                                        </div>
                                        
                                        <!-- Sabates -->
                                        <div class="text-center bg-white rounded-lg p-4 shadow-sm">
                                            <div class="w-8 h-8 mx-auto mb-2 text-green-500">
                                                <svg fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M20 12a2 2 0 00-2-2h-2V7a4 4 0 00-4-4H8a4 4 0 00-4 4v3H2a2 2 0 00-2 2v2a2 2 0 002 2h2v3a4 4 0 004 4h4a4 4 0 004-4v-3h2a2 2 0 002-2v-2z"/>
                                                </svg>
                                            </div>
                                            <p class="text-sm text-gray-500 mb-1">Sabates</p>
                                            <p class="text-lg font-bold text-gray-800">
                                                {{ $lastShoesSize ?: 'N/D' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Accions del Formulari -->
                                <div class="flex flex-wrap justify-end gap-4 pt-6 border-t border-gray-200">
                                    <a href="{{ route('professional.index') }}"
                                       class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition duration-200">
                                        Cancel·lar
                                    </a>
                                    <button type="reset" 
                                            class="px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition duration-200">
                                        Netejar Formulari
                                    </button>
                                    <button type="submit"
                                            class="px-8 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-medium rounded-lg hover:from-orange-600 hover:to-orange-700 transition duration-200 shadow-md flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Confirmar Assignació
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Barra Lateral: Uniforme Actual i Historial -->
                    <div class="space-y-6">
                        <!-- Uniforme Actual -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold text-gray-800">Últim registre</h3>
                                
                            </div>
                            
                            @if($currentUniform)
                                <div class="space-y-6">
                                    <div class="grid grid-cols-3 gap-4">
                                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                                            <p class="text-sm text-gray-500">Samarreta</p>
                                            <p class="text-xl font-bold text-gray-800">{{ $currentUniform->shirt_size }}</p>
                                        </div>
                                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                                            <p class="text-sm text-gray-500">Pantalons</p>
                                            <p class="text-xl font-bold text-gray-800">{{ $currentUniform->trausers_size }}</p>
                                        </div>
                                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                                            <p class="text-sm text-gray-500">Sabates</p>
                                            <p class="text-xl font-bold text-gray-800">{{ $currentUniform->shoes_size }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="pt-4 border-t border-gray-200">
                                        <p class="text-sm text-gray-600 mb-2">
                                            <span class="font-medium">Data d'últim registre:</span><br>
                                            {{ date('d/m/Y', strtotime($currentUniform->renovation_date)) }}
                                        </p>
                                        
                                        @if($currentUniform->notes)
                                            <p class="text-sm text-gray-600 mb-4">
                                                <span class="font-medium">Observacions:</span><br>
                                                {{ $currentUniform->notes }}
                                            </p>
                                        @endif
                                        
                                        @if($currentUniform->docs_route)
                                            <a href="{{ route('professional.uniform.download', [$professional, $currentUniform]) }}"
                                               class="inline-flex items-center px-4 py-2 bg-orange-50 text-orange-700 rounded-lg hover:bg-orange-100 transition duration-200">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                Descarregar Document
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <div class="w-16 h-16 mx-auto mb-4 text-gray-300">
                                        <svg fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M21 6h-4V3a1 1 0 00-1-1H8a1 1 0 00-1 1v3H3a1 1 0 00-1 1v11a3 3 0 003 3h14a3 3 0 003-3V7a1 1 0 00-1-1zM9 4h6v2H9V4zm10 14a1 1 0 01-1 1H6a1 1 0 01-1-1V8h2v1a1 1 0 001 1h8a1 1 0 001-1V8h2v10z"/>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500">Encara no s'ha assignat cap uniforme</p>
                                </div>
                            @endif
                        </div>

                        <!-- Historial d'Assignacions -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Historial d'Assignacions</h3>
                            
                            @if($uniformHistory->count() > 0)
                                <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                                    @foreach($uniformHistory as $uniform)
                                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition duration-200">
                                            <div class="flex justify-between items-start mb-2">
                                                <div>
                                                    <p class="font-medium text-gray-700">
                                                        {{ date('d/m/Y', strtotime($uniform->renovation_date)) }}
                                                    </p>
                                                    <div class="flex items-center space-x-2 mt-1">
                                                        <span class="text-sm bg-blue-50 text-blue-700 px-2 py-1 rounded">
                                                            {{ $uniform->shirt_size }}
                                                        </span>
                                                        <span class="text-sm bg-green-50 text-green-700 px-2 py-1 rounded">
                                                            {{ $uniform->trausers_size }}
                                                        </span>
                                                        <span class="text-sm bg-purple-50 text-purple-700 px-2 py-1 rounded">
                                                            {{ $uniform->shoes_size }}
                                                        </span>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            
                                            @if($uniform->docs_route)
                                                <div class="mt-3 pt-3 border-t border-gray-100">
                                                    <a href="{{ route('professional.uniform.download', [$professional, $uniform]) }}"
                                                       class="text-sm text-orange-600 hover:text-orange-700 inline-flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                        </svg>
                                                        Document
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                
                                <!-- Mostrar contador -->
                                <div class="mt-4 pt-4 border-t border-gray-200 text-center">
                                    <p class="text-sm text-gray-500">
                                        Total: {{ $uniformHistory->count() }} assignacions
                                    </p>
                                </div>
                            @else
                                <div class="text-center py-8 text-gray-500">
                                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    <p>No hi ha històric d'assignacions</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </main>
        </div>
    @endauth

    @guest
        <div class="min-h-screen flex items-center justify-center bg-gray-50">
            <div class="text-center max-w-md p-8 bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="w-16 h-16 mx-auto mb-6 text-orange-500">
                    <svg fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 100-16 8 8 0 000 16zm-1-5h2v2h-2v-2zm0-8h2v6h-2V7z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-4">Sessió no iniciada</h1>
                <p class="text-gray-600 mb-6">Has de iniciar sessió per accedir a aquesta pàgina</p>
                <a href="{{ route('login') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-medium rounded-lg hover:from-orange-600 hover:to-orange-700 transition duration-200 shadow-md">
                    Anar a l'inici de sessió
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    @endguest
</body>
</html>