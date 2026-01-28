<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar projecte / comissió</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-orange-50 min-h-screen">

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

        <form action="{{ route('project_comission.update', $project_comission) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow overflow-hidden">
            @csrf
            @method('PUT')

            <div class="bg-orange-500 text-white px-6 py-3">
                <p class="font-semibold">Editar projecte / comissió</p>
            </div>

            <div class="p-8 flex flex-col gap-8">

                <section class="flex flex-col gap-4">
                    <h2 class="font-semibold text-gray-700">Informació bàsica</h2>

                    <div>
                        <label class="text-sm text-gray-600">Nom del projecte *</label>
                        <input name="name" required class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" value="{{ old('name', $project_comission->name) }}">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Manager del projecte *</label>
                        <select name="professional_manager_id"
                                required
                                class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                            @foreach ($professionals as $professional)
                                <option value="{{ $professional->id }}"
                                    {{ $project_comission->professional_manager_id == $professional->id ? 'selected' : '' }}>
                                    {{ $professional->name }} {{ $professional->surnames }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full">
                        <label class="text-sm text-gray-600">Data d'inici *</label>
                        <input type="date"
                               name="start_date"
                               required
                               class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                               value="{{ old('start_date', $project_comission->start_date) }}">
                    </div>
                </section>

                <section class="flex flex-col gap-4">
                    <h2 class="font-semibold text-gray-700">Tipus</h2>

                    <div class="flex gap-6">
                        <label class="flex items-center gap-2">
                            <input type="radio"
                                   name="type"
                                   value="Projecte"
                                   {{ $project_comission->type === 'Projecte' ? 'checked' : '' }}>
                            <span>Projecte</span>
                        </label>

                        <label class="flex items-center gap-2">
                            <input type="radio"
                                   name="type"
                                   value="Comissió"
                                   {{ $project_comission->type === 'Comissió' ? 'checked' : '' }}>
                            <span>Comissió</span>
                        </label>
                    </div>
                </section>

                <section class="flex flex-col gap-4">
                    <h2 class="font-semibold text-gray-700">Descripció</h2>
                    <textarea name="description" rows="4" required class="w-full border-2 border-gray-200 rounded-md px-3 py-2">{{ old('description', $project_comission->description) }}</textarea>
                </section>

                <section class="flex flex-col gap-4">
                    <h2 class="font-semibold text-gray-700">Observacions</h2>

                    <textarea name="observation" rows="4"
                        class="w-full border-2 border-gray-200 rounded-md px-3 py-2">{{ old('observation', $project_comission->observation) }}</textarea>
                </section>

                <section class="flex flex-col gap-4">
                    <h2 class="font-semibold text-gray-700">Documents adjunts</h2>

                    <input type="file" name="path[]" multiple class="w-full border-2 border-gray-200 rounded-md px-3 py-2">
                </section>

                <div class="flex justify-between items-center border-t pt-6">
                    <a href="{{ route('project_comission.index', $project_comission) }}"
                       class="border border-orange-500 text-orange-500 hover:underline px-6 py-4 rounded-xl">
                        Cancel·lar edició
                    </a>

                    <button type="submit"
                            class="bg-orange-500 text-white px-6 py-4 rounded-md hover:bg-white hover:text-orange-500 hover:border-orange-500 border transition">
                        Guardar canvis
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
