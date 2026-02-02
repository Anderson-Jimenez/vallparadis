<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Afegir nou curs</title>
    @vite("resources/css/app.css")
</head>
<body class="bg-body min-h-screen">
    @include('partials.icons')
    
    @auth
        @include('components.navbar')
        
        <main class="flex justify-center py-10">
            <div class="w-3/4">
                <div class="flex items-center gap-2 mb-1">
                    <svg class="w-6 h-6 txt-orange">
                        <use xlink:href="#courses_icon"></use>
                    </svg>
                    <h1 class="text-2xl font-semibold">Afegir nou curs</h1>
                </div>
                <p class="text-gray-500 mb-6">
                    Ompliu la informació per afegir un nou curs a la base de dades
                </p>

                @if ($errors->any())
                    <ul class="mb-4 px-10">
                        @foreach ($errors->all() as $error)
                            <li class="text-red-500">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form action="{{ route('course.store') }}" method="POST" class="bg-white rounded-lg shadow overflow-hidden">
                    @csrf
                    
                    <div class="bg-orange-500 text-white px-6 py-3">
                        <p class="font-semibold">Informació del curs</p>
                        <p class="text-sm opacity-80">Els camps marcats amb * són obligatoris</p>
                    </div>

                    <div class="p-8 flex flex-col gap-8">
                        <section class="flex flex-col gap-4">
                            <h2 class="font-semibold text-gray-700">Informació bàsica</h2>
                            
                            <div class="flex gap-4">
                                <div class="w-1/2">
                                    <label class="text-sm text-gray-600">Codi FORCEM *</label>
                                    <input type="text" id="code_forcem" name="code_forcem" 
                                           class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" 
                                           value="{{ old('code_forcem') }}" 
                                           required
                                           placeholder="Introdueix el codi FORCEM">
                                    @error('code_forcem')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="w-1/2">
                                    <label class="text-sm text-gray-600">Hores *</label>
                                    <input type="number" id="hours" name="hours" 
                                           class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" 
                                           value="{{ old('hours') }}" 
                                           required
                                           placeholder="Introdueix les hores">
                                    @error('hours')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="text-sm text-gray-600">Nom formació/Taller/Jornada/Congrés *</label>
                                <input type="text" id="training_name" name="training_name" 
                                       class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" 
                                       value="{{ old('training_name') }}" 
                                       required
                                       placeholder="Introdueix el nom de la formació">
                                @error('training_name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </section>
                        
                        <section class="flex flex-col gap-4">
                            <h2 class="font-semibold text-gray-700">Modalitat</h2>
                            
                            <div class="flex gap-4">
                                <div class="w-1/2">
                                    <label class="text-sm text-gray-600">Tipus *</label>
                                    <select id="type" name="type" required
                                            class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 cursor-pointer">
                                        <option value="">Selecciona el tipus</option>
                                        <option value="Formació Interna" {{ old('type') == 'Formació Interna' ? 'selected' : '' }}>Formació Interna</option>
                                        <option value="Formació Externa" {{ old('type') == 'Formació Externa' ? 'selected' : '' }}>Formació Externa</option>
                                        <option value="Formació Salut Laboral" {{ old('type') == 'Formació Salut Laboral' ? 'selected' : '' }}>Formació Salut Laboral</option>
                                        <option value="Jorn/Taller/Seminari/Congrés" {{ old('type') == 'Jorn/Taller/Seminari/Congrés' ? 'selected' : '' }}>Jorn/Taller/Seminari/Congrés</option>
                                    </select>
                                    @error('type')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="w-1/2">
                                    <label class="text-sm text-gray-600">Presencial/Online *</label>
                                    <select id="mode" name="mode" required
                                            class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 cursor-pointer">
                                        <option value="">Selecciona la modalitat</option>
                                        <option value="Presencial" {{ old('mode') == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                                        <option value="Online" {{ old('mode') == 'Online' ? 'selected' : '' }}>Online</option>
                                        <option value="Mixte" {{ old('mode') == 'Mixte' ? 'selected' : '' }}>Mixte</option>
                                    </select>
                                    @error('mode')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </section>

                        <div class="flex justify-between items-center border-t pt-6">
                            <a href="{{ url()->previous() }}" 
                               class="border border-orange-500 text-orange-500 hover:underline px-6 py-4 rounded-xl">
                                Cancel·lar
                            </a>

                            <button type="submit" 
                                    class="bg-orange-500 text-white px-6 py-4 rounded-md hover:bg-white hover:text-orange-500 hover:border-orange-500 border flex items-center">
                                <svg class="w-6 h-6 mr-2">
                                    <use xlink:href="#add_icon"></use>
                                </svg>
                                Afegir curs
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    @endauth

    @guest
        <h1 class="text-center mt-10">No has iniciat sessió.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}">
    @endguest
</body>
</html>