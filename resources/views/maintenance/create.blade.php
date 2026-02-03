<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Afegir nou contacte</title>
    @vite('resources/css/app.css')
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

            <div class="flex items-center gap-2 mb-1">
                <svg class="w-6 h-6 text-orange-500">
                    <use xlink:href="#maintenance_icon"></use>
                </svg>
                <h1 class="text-2xl font-semibold">Afegir nova entrada de manteniment</h1>
            </div>
            <p class="text-gray-500 mb-6">
                Ompliu informació per guardar la entrada de manteniment
            </p>

            <form action="{{ route('maintenance.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow overflow-hidden">
                @csrf
                <div class="bg-orange-500 text-white px-6 py-3">
                    <p class="font-semibold">Informació del manteniment</p>
                    <p class="text-sm opacity-80">Els camps marcats amb * són obligatoris</p>
                </div>

                <div class="p-8 flex flex-col gap-8">
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Informació bàsica</h2>
                        <div>
                            <label class="text-sm text-gray-600">Nom manteniment *</label>
                            <input name="name" required class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" placeholder="Introdueix el nom" value="{{ old('name') }}">
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Data d'obertura *</label>
                            <input type="date" name="start_date" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" value="{{ old('start_date', date('Y-m-d')) }}">
                        </div>
                    </section>
                    
                    </section>
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Detalls de contacte del responsable</h2>

                        <div class="flex gap-4">
                            <div class="w-1/2">
                                <label class="text-sm text-gray-600">Responsable</label>
                                <input name="manager" required class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" placeholder="Nom del responsable" value="{{ old('manager') }}">
                            </div>

                            <div class="w-1/2">
                                <label class="text-sm text-gray-600">Telèfon *</label>
                                <input name="phone" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" placeholder="+34 600 000 000" value="{{ old('phone') }}">
                            </div>
                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Correu electrònic </label>
                            <input type="email" name="email" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" placeholder="email@exemple.com" value="{{ old('email') }}">
                        </div>
                    </section>
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Informació addicional</h2>
                        <textarea name="description" rows="3" class="w-full border-2 border-gray-200 rounded-md px-3 py-2" placeholder="Afegeix notes o comentaris addicionals"></textarea>
                        <h2 class="font-semibold text-gray-700">Afegir documentació</h2>
                        <input type="file" name="docs[]" multiple class="w-full border-2 border-gray-200 rounded-md px-3 py-2">
                    </section>
                    <div class="flex flex-col">
                        <label class="text-sm font-medium text-gray-700 mb-2">Firma digital <span class="text-red-500">*</span></label>
                        <div class="flex flex-col border-2 border-gray-200 rounded-xl p-4 bg-white shadow-sm hover:border-orange-300 transition-colors">
                            <div class="relative">
                                <canvas id="signature" width="800" height="200" 
                                        class="w-full h-48 border border-gray-300 rounded-lg bg-white cursor-crosshair touch-none shadow-inner"></canvas>
                                
                                <div id="signature-guide" class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                    <div class="bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full shadow-sm">
                                        <p class="text-gray-500 text-sm font-medium">Firma aquí amb el ratolí o el teu dit</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between mt-4 gap-3">
                                <div class="flex items-center space-x-3">
                                    <div id="signature-status" class="flex items-center px-3 py-2 bg-gray-50 rounded-lg border border-gray-200 min-w-[140px]">
                                        <div class="w-2 h-2 bg-red-500 rounded-full mr-2 animate-pulse"></div>
                                        <span class="text-sm font-medium text-gray-700">Firma pendent</span>
                                    </div>
                                    
                                    <button type="button" id="clear" 
                                            class="flex items-center text-sm font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 px-3 py-2 rounded-lg transition-all duration-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <use xlink:href="#delete_icon"></use>
                                        </svg>
                                        Netejar firma
                                    </button>
                                </div>
                                
                                <div class="text-xs text-gray-500 bg-gray-50 px-3 py-1.5 rounded-lg">
                                    <span class="font-medium">Important:</span> La firma serà guardada com a imatge
                                </div>
                            </div>
                            
                            <input type="hidden" id="signature_input" name="signature">
                        </div>
                    </div>
                    <div class="flex justify-between items-center border-t pt-6">
                        <a href="{{ route('maintenance.index') }}" class="border border-[#ff7300] txt-orange hover:underline px-6 py-4 rounded-xl">
                            Cancel·lar
                        </a>

                        <button type="submit" class="bg-orange-500 text-white px-6 py-4 rounded-md hover:bg-white hover:text-[#ff7300] hover:border-[#ff7300] border flex items-center">
                            <svg class="w-6 h-6 mr-2">
                                <use xlink:href="#maintenance_icon"></use>
                            </svg>
                            Afegir nova entrada de manteniment
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    @endauth

    @guest
        <h1>No has iniciat sessió.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}">
    @endguest
</body>
</html>
