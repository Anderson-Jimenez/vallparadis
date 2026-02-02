<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar Assignació</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-orange-50 min-h-screen">
@include('partials.icons')

@auth
    @include('components.navbar')
    <main class="flex justify-center py-10">
        <div class="w-3/4">

            <div class="flex items-center gap-2 mb-1">
                <svg class="w-6 h-6 text-orange-500">
                    <use xlink:href="#edit_icon"></use>
                </svg>
                <h1 class="text-2xl font-semibold">Editar Assignació</h1>
            </div>
            <p class="text-gray-500 mb-6">
                Modifiqueu la informació de l'assignació del professional al curs
            </p>

            @if ($errors->any())
                <ul class="mb-4 px-10">
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('professional-courses.update', $assignment->id) }}" class="bg-white rounded-lg shadow overflow-hidden">
                @csrf
                @method('PUT')
                
                <div class="bg-orange-500 text-white px-6 py-3">
                    <p class="font-semibold">Informació de l'assignació</p>
                    <p class="text-sm opacity-80">Els camps marcats amb * són obligatoris</p>
                </div>

                <div class="p-8 flex flex-col gap-8">
                    <!-- Informació del curs -->
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Informació del curs</h2>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center gap-3 mb-2">
                                <svg class="w-5 h-5 text-gray-600">
                                    <use xlink:href="#clipboard_icon"></use>
                                </svg>
                                <h3 class="font-semibold text-gray-800">{{ $course->training_name }}</h3>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-gray-600">
                                    <use xlink:href="#code_icon"></use>
                                </svg>
                                <p class="text-gray-600">Codi: {{ $course->code_forcem }}</p>
                            </div>
                        </div>
                    </section>

                    <!-- Informació del professional -->
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Informació del professional</h2>
                        <div class="bg-gray-50 p-4 rounded-lg flex items-center gap-4">
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-orange-600">
                                    <use xlink:href="#professional_icon"></use>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">{{ $professional->name }} {{ $professional->surnames }}</h3>
                                <p class="text-sm text-gray-600">ID: {{ $professional->id }}</p>
                            </div>
                        </div>
                    </section>
                    
                    <!-- Dates de l'assignació -->
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Dates de l'assignació</h2>

                        <div class="flex gap-4">
                            <div class="w-1/2">
                                <label class="text-sm text-gray-600">Data d'inici *</label>
                                <input type="date" 
                                       id="start_date" 
                                       name="start_date" 
                                       value="{{ old('start_date', $assignment->start_date ? date('Y-m-d', strtotime($assignment->start_date)) : '') }}"
                                       class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                                       readonly>
                                @error('start_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="w-1/2">
                                <label class="text-sm text-gray-600">Data de fi</label>
                                <input type="date" 
                                       id="end_date" 
                                       name="end_date" 
                                       value="{{ old('end_date', $assignment->end_date ? date('Y-m-d', strtotime($assignment->end_date)) : '') }}"
                                       class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                                @error('end_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </section>
                    
                    <!-- Estat del certificat -->
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Estat del certificat</h2>

                        <div class="w-full">
                            <label class="text-sm text-gray-600">Estat *</label>
                            <select id="certificate" 
                                    name="certificate" 
                                    class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                                    required>
                                <option value="Pendent" {{ old('certificate', $assignment->certificate) == 'Pendent' ? 'selected' : '' }}>Pendent</option>
                                <option value="Donat" {{ old('certificate', $assignment->certificate) == 'Donat' ? 'selected' : '' }}>Donat</option>
                            </select>
                            @error('certificate')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </section>

                    <!-- Botons -->
                    <div class="flex justify-between items-center border-t pt-6">
                        <a href="{{ route('course.assign_professional', $course->id) }}" 
                           class="border border-orange-500 text-orange-500 hover:underline px-6 py-4 rounded-xl">
                            Cancel·lar
                        </a>

                        <button type="submit" 
                                class="bg-orange-500 text-white px-6 py-4 rounded-md hover:bg-white hover:text-orange-500 hover:border-orange-500 border flex items-center">
                            <svg class="w-6 h-6 mr-2">
                                <use xlink:href="#save_icon"></use>
                            </svg>
                            Guardar canvis
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