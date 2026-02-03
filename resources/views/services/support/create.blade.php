<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Afegir professional</title>
    @vite("resources/css/app.css")
</head>
<body class="bg-orange-50 min-h-screen">
    @include('partials.icons')
    @auth    
        @if ($errors->any())
            <div class="mx-auto max-w-4xl mt-4">
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        
        @include('components.navbar')   
        @yield('contingut')
        
        <main class="flex justify-center py-10">
            <div class="w-3/4">
                <div class="flex items-center gap-2 mb-1">
                    <svg class="w-6 h-6 text-orange-500">
                        <use xlink:href="#services_icon"></use>
                    </svg>
                    <h1 class="text-2xl font-semibold">Formulari afegir nou servei complementari</h1>
                </div>
                <p class="text-gray-500 mb-6">
                    Ompliu la informació necessària per crear un nou servei complementari
                </p>

                <form action="{{ route('supplementary_service.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow overflow-hidden">
                    @csrf
                    
                    <div class="bg-orange-500 text-white px-6 py-3">
                        <p class="font-semibold">Informació del servei complementari</p>
                        <p class="text-sm opacity-80">Els camps marcats amb * són obligatoris</p>
                    </div>

                    <div class="p-8 flex flex-col gap-8">
                        <section class="flex flex-col gap-4">
                            <h2 class="font-semibold text-gray-700">Informació bàsica</h2>
                            
                            <div>
                                <label for="type" class="text-sm text-gray-600">Tipus *</label>
                                <input type="text" name="type" id="type" value="{{ old('type') }}" required 
                                       class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" 
                                       placeholder="Tipus de servei complementari">
                            </div>

                            <div class="flex gap-4">
                                <div class="w-1/2">
                                    <label for="start_date" class="text-sm text-gray-600">Data d'inici *</label>
                                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required 
                                           class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                                </div>
                                <div class="w-1/2">
                                    <label for="manager" class="text-sm text-gray-600">Responsable *</label>
                                    <input type="text" name="manager" id="manager" value="{{ old('manager') }}" required 
                                           class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" 
                                           placeholder="Nom del responsable">
                                </div>
                            </div>
                        </section>

                        <section class="flex flex-col gap-4">
                            <h2 class="font-semibold text-gray-700">Contacte</h2>
                            
                            <div class="flex gap-4">
                                <div class="w-1/2">
                                    <label for="email_address" class="text-sm text-gray-600">Correu electrònic *</label>
                                    <input type="email" name="email_address" id="email_address" value="{{ old('email_address') }}" required 
                                           class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" 
                                           placeholder="email@exemple.com">
                                </div>
                                <div class="w-1/2">
                                    <label for="phone_number" class="text-sm text-gray-600">Telèfon *</label>
                                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" required 
                                           class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" 
                                           placeholder="+34 600 000 000">
                                </div>
                            </div>
                        </section>

                        <section class="flex flex-col gap-4">
                            <h2 class="font-semibold text-gray-700">Documentació</h2>
                            
                            <div>
                                <label for="docs" class="text-sm text-gray-600">Pujar arxiu(s)</label>
                                <input type="file" name="docs[]" id="docs" multiple 
                                       class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 cursor-pointer">
                                <p class="text-xs text-gray-500 mt-1">Podeu seleccionar múltiples arxius</p>
                            </div>
                        </section>

                        <section class="flex flex-col gap-4">
                            <h2 class="font-semibold text-gray-700">Informació addicional</h2>
                            
                            <div>
                                <label for="comments" class="text-sm text-gray-600">Comentaris</label>
                                <textarea name="comments" id="comments" rows="3"
                                          class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                                          placeholder="Afegeix notes o comentaris addicionals">{{ old('comments') }}</textarea>
                            </div>
                        </section>

                        <div class="flex justify-between items-center border-t pt-6">
                            <a href="{{ url()->previous() }}" class="border border-orange-500 text-orange-500 hover:bg-orange-50 px-6 py-3 rounded-md transition-colors duration-300">
                                Cancel·lar
                            </a>

                            <button type="submit" class="bg-orange-500 text-white hover:bg-white hover:text-orange-500 hover:border-orange-500 border border-transparent px-6 py-3 rounded-md flex items-center transition-all duration-300">
                                <svg class="w-5 h-5 mr-2">
                                    <use xlink:href="#add_icon"></use>
                                </svg>
                                Crear servei
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    @endauth

    @guest
        <div class="min-h-screen flex flex-col items-center justify-center">
            <h1 class="text-2xl font-semibold text-gray-700 mb-4">No has iniciat sessió</h1>
            <p class="text-gray-500">Redirigint a la pàgina d'inici de sessió...</p>
            <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
        </div>
    @endguest
</body>
</html>