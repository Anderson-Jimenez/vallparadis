<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar tema pendent RRHH</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-orange-50 min-h-screen">
@include('partials.icons')

@auth
@include('components.navbar')

<main class="flex justify-center py-10">
    <div class="w-3/4">

        <form action="{{ route('hr_pending_issue.update', $hr_pending_issue) }}"
              method="POST"
              class="bg-white rounded-lg shadow overflow-hidden">

            @csrf
            @method('PUT')

            <!-- Header -->
            <div class="bg-orange-500 text-white px-6 py-3">
                <p class="font-semibold">Editar tema pendent RRHH</p>
            </div>

            <div class="p-8 flex flex-col gap-8">

                <!-- Informació bàsica -->
                <section class="flex flex-col gap-4">
                    <h2 class="font-semibold text-gray-700">Informació bàsica</h2>

                    <div>
                        <label class="text-sm text-gray-600">Context *</label>
                        <input name="context"
                               required
                               class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                               value="{{ old('context', $hr_pending_issue->context) }}">
                    </div>

                    <div class="flex gap-6">
                        <div class="w-1/2">
                            <label class="text-sm text-gray-600">Data d'obertura *</label>
                            <input type="date"
                                   name="opened_at"
                                   required
                                   class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                                   value="{{ old('opened_at', $hr_pending_issue->opened_at?->format('Y-m-d')) }}">
                        </div>

                        <div class="w-1/2">
                            <label class="text-sm text-gray-600">Estat *</label>
                            <select name="status"
                                    required
                                    class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                                <option value="pending" {{ $hr_pending_issue->status === 'pending' ? 'selected' : '' }}>Pendent</option>
                                <option value="in_process" {{ $hr_pending_issue->status === 'in_process' ? 'selected' : '' }}>En procés</option>
                                <option value="urgent" {{ $hr_pending_issue->status === 'urgent' ? 'selected' : '' }}>Urgent</option>
                                <option value="completed" {{ $hr_pending_issue->status === 'completed' ? 'selected' : '' }}>Finalitzat</option>
                            </select>
                        </div>
                    </div>
                </section>

                <!-- Professionals -->
                <section class="flex flex-col gap-4">
                    <h2 class="font-semibold text-gray-700">Professionals implicats</h2>

                    <div class="flex gap-6">

                        <div class="w-1/3">
                            <label class="text-sm text-gray-600">Registrat per</label>
                            <input disabled
                                   class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 bg-gray-50"
                                   value="{{ $hr_pending_issue->registeredBy->name ?? 'N/A' }}">
                        </div>

                        <div class="w-1/3">
                            <label class="text-sm text-gray-600">Professional afectat *</label>
                            <select name="affected_professional_id"
                                    required
                                    class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                                @foreach ($professionals as $prof)
                                    <option value="{{ $prof->id }}"
                                        {{ $hr_pending_issue->affected_professional_id == $prof->id ? 'selected' : '' }}>
                                        {{ $prof->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-1/3">
                            <label class="text-sm text-gray-600">Derivat a</label>
                            <select name="derived_to_professional_id"
                                    class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                                <option value="">— Cap —</option>
                                @foreach ($professionals as $prof)
                                    <option value="{{ $prof->id }}"
                                        {{ $hr_pending_issue->derived_to_professional_id == $prof->id ? 'selected' : '' }}>
                                        {{ $prof->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </section>

                <!-- Descripció -->
                <section class="flex flex-col gap-4">
                    <h2 class="font-semibold text-gray-700">Descripció</h2>
                    <textarea name="description"
                              rows="4"
                              required
                              class="w-full border-2 border-gray-200 rounded-md px-3 py-2">{{ old('description', $hr_pending_issue->description) }}</textarea>
                </section>

                <!-- Accions -->
                <div class="flex justify-between items-center border-t pt-6">
                    <a href="{{ route('hr_pending_issue.show', $hr_pending_issue) }}"
                       class="border border-[#ff7300] text-orange-500 hover:underline px-6 py-4 rounded-xl">
                        Cancel·lar edició
                    </a>

                    <button type="submit"
                            class="bg-orange-500 text-white px-6 py-4 rounded-md hover:bg-white hover:text-[#ff7300] hover:border-[#ff7300] border flex items-center">
                        <svg class="w-6 h-6 mr-2">
                            <use xlink:href="#maintenance_icon"></use>
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
    <h1>No has iniciat sessió.</h1>
    <meta http-equiv="refresh" content="2; URL={{ route('login') }}">
@endguest
</body>
</html>
