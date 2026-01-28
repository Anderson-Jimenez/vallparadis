<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Afegir projecte / comissió</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-body min-h-screen">

@include('components.navbar')

@auth
    @if ($errors->any())
        <ul class="mb-4 px-10">
            @foreach ($errors->all() as $error)
                <li class="text-red-500">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <main class="flex justify-center py-10">
        <div class="w-3/4">

            <div class="flex items-center gap-2 mb-1">
                <h1 class="text-2xl font-semibold">
                    Afegir nou projecte / comissió
                </h1>
            </div>
            <p class="text-gray-500 mb-6">
                Ompliu la informació per crear un nou projecte o comissió
            </p>

            <form action="{{ route('project_comission.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="bg-white rounded-lg shadow overflow-hidden">
                @csrf

                <div class="bg-orange-500 text-white px-6 py-3">
                    <p class="font-semibold">Informació bàsica</p>
                    <p class="text-sm opacity-80">Els camps marcats amb * són obligatoris</p>
                </div>

                <div class="p-8 flex flex-col gap-8">

                    <div>
                        <label class="text-sm text-gray-600">Nom del projecte *</label>
                        <input type="text"
                               name="name"
                               required
                               value="{{ old('name') }}"
                               class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Manager del projecte *</label>
                        <select name="professional_manager_id"
                                required
                                class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                            <option value="">-- Selecciona un professional --</option>
                            @foreach ($professionals as $professional)
                                <option value="{{ $professional->id }}"
                                    {{ old('professional_manager_id') == $professional->id ? 'selected' : '' }}>
                                    {{ $professional->name }} {{ $professional->surnames }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full">
                        <label class="text-sm text-gray-600">Data d'inici *</label>
                        <input type="date" name="start_date" required value="{{ old('start_date') }}" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                    </div>
                    <div>
                        <label class="text-sm text-gray-600 block mb-2">Tipus *</label>
                        <div class="flex gap-6">
                            <label class="flex items-center gap-2">
                                <input type="radio" name="type" value="Projecte" required>
                                <span>Projecte</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" name="type" value="Comissió">
                                <span>Comissió</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Descripció *</label>
                        <textarea name="description"
                                  rows="4"
                                  required
                                  class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Observacions</label>
                        <textarea name="observation"
                                  rows="4"
                                  class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">{{ old('observation') }}</textarea>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Documents adjunts</label>
                        <input type="file" name="path[]" multiple class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                    </div>

                    <div class="flex justify-between items-center border-t pt-6">
                        <a href="{{ route('project_comission.index') }}"
                           class="border border-orange-500 text-orange-500 px-6 py-4 rounded-xl hover:underline">
                            Cancel·lar
                        </a>

                        <button type="submit"
                                class="bg-orange-500 text-white px-6 py-4 rounded-md border hover:bg-white hover:text-orange-500 hover:border-orange-500 transition">
                            Crear projecte
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
