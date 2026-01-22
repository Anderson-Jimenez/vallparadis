<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Afegir nou tema pendent</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-orange-50 min-h-screen">
@include('partials.icons')

@auth
    @if ($errors->any())
        <ul class="mb-4">
            @foreach ($errors->all() as $error)
                <li class="text-red-500">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @include('components.navbar')
    <main class="flex justify-center py-10">
        <div class="w-3/4">

            <div class="flex items-center gap-2 mb-1">
                <svg class="w-6 h-6 text-orange-500">
                    <use xlink:href="#maintenance_icon"></use>
                </svg>
                <h1 class="text-2xl font-semibold">Afegir nou tema pendent RRHH</h1>
            </div>
            <p class="text-gray-500 mb-6">
                Ompliu la informació per guardar el tema pendent
            </p>

            <form action="{{ route('hr_pending_issue.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow overflow-hidden">
                @csrf

                <div class="bg-orange-500 text-white px-6 py-3">
                    <p class="font-semibold">Informació bàsica</p>
                    <p class="text-sm opacity-80">Els camps marcats amb * són obligatoris</p>
                </div>

                <div class="p-8 flex flex-col gap-8">
                    <!-- Context -->  
                    <div>
                        <label class="text-sm text-gray-600">Context *</label>
                        <input type="text" name="context" required class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                            value="{{ old('context') }}" placeholder="Breu descripció del tema pendent">
                    </div>

                    <div class="flex justify-between gap-6">
                        <!-- Professional registrador -->
                        <div class="flex flex-col w-1/3">
                            <label class="text-sm text-gray-600">Registrat per *</label>

                            <span class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 bg-amber-50">{{Auth::user()->name}}</span>
                        </div>
                        <!-- Professional afectat -->
                        <div class="w-1/3">
                            <label class="text-sm text-gray-600">Professional afectat *</label>
                            <select name="affected_professional_id" required class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                                @foreach($professionals as $prof)
                                    <option value="{{ $prof->id }}" {{ old('affected_professional_id') == $prof->id ? 'selected' : '' }}>
                                        {{ $prof->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Professional derivat (opcional) -->
                        <div class="w-1/3">
                            <label class="text-sm text-gray-600">Derivat a (opcional)</label>
                            <select name="derived_to_professional_id" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                                <option value="">-- Cap --</option>
                                @foreach($professionals as $prof)
                                    <option value="{{ $prof->id }}" {{ old('derived_to_professional_id') == $prof->id ? 'selected' : '' }}>
                                        {{ $prof->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-between gap-6">
                        <!-- Data d'obertura -->
                        <div class="w-1/2">
                            <label class="text-sm text-gray-600">Data d'obertura *</label>
                            <input type="date" name="opened_at" required class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                                value="{{ old('opened_at', date('Y-m-d')) }}">
                        </div>
                        <div class="w-1/2">
                            <label class="text-sm text-gray-600">Estat *</label>
                            <select name="status" required class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pendent</option>
                                <option value="in_process" {{ old('status') == 'in_process' ? 'selected' : '' }}>En process</option>
                                <option value="urgent" {{ old('status') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Finalitzat</option>
                            </select>
                        </div>

                    </div>

                    <!-- Descripción -->
                    <div>
                        <label class="text-sm text-gray-600">Descripció *</label>
                        <textarea name="description" required rows="4" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" placeholder="Afegeix notes o comentaris addicionals">{{ old('description') }}</textarea>
                    </div>

                    <!-- Arxius  -->
                    <div>
                        <label class="text-sm text-gray-600">Document adjunt</label>
                        <input type="file" name="files[]" multiple class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-between items-center border-t pt-6">
                        <a href="{{ route('hr_pending_issue.index') }}" class="border border-[#ff7300] text-orange-500 hover:underline px-6 py-4 rounded-xl">
                            Cancel·lar
                        </a>

                        <button type="submit" class="bg-orange-500 text-white px-6 py-4 rounded-md hover:bg-white hover:text-[#ff7300] hover:border-[#ff7300] border flex items-center">
                            <svg class="w-6 h-6 mr-2">
                                <use xlink:href="#maintenance_icon"></use>
                            </svg>
                            Afegir nou tema pendent
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
