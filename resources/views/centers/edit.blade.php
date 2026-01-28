<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Modificar centre</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-orange-50 min-h-screen">

@auth
    @if ($errors->any())
        <ul class="mb-4 px-10">
            @foreach ($errors->all() as $error)
                <li class="text-red-500">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @include('components.navbar')

    <main class="flex justify-center py-10">
        <div class="w-3/4">

            <form action="{{ route('center.update', $center) }}" method="POST" class="bg-white rounded-lg shadow overflow-hidden">
                @csrf
                @method('PUT')

                <div class="bg-orange-500 text-white px-6 py-3">
                    <p class="font-semibold">Modificar dades del centre</p>
                    <p class="text-sm opacity-80">Actualitzeu la informació del centre</p>
                </div>

                <div class="p-8 flex flex-col gap-8">

                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Informació bàsica</h2>

                        <div>
                            <label class="text-sm text-gray-600">Nom del centre *</label>
                            <input
                                type="text"
                                name="center_name"
                                required
                                class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                                value="{{ old('center_name', $center->center_name) }}">
                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Ubicació *</label>
                            <input
                                type="text"
                                name="location"
                                required
                                class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                                value="{{ old('location', $center->location) }}">
                        </div>
                    </section>

                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Informació de contacte</h2>

                        <div class="flex gap-6">
                            <div class="w-1/2">
                                <label class="text-sm text-gray-600">Telèfon *</label>
                                <input
                                    type="text"
                                    name="phone_number"
                                    required
                                    class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                                    value="{{ old('phone_number', $center->phone_number) }}">
                            </div>

                            <div class="w-1/2">
                                <label class="text-sm text-gray-600">Correu electrònic *</label>
                                <input
                                    type="email"
                                    name="email_address"
                                    required
                                    class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                                    value="{{ old('email_address', $center->email_address) }}">
                            </div>
                        </div>
                    </section>

                    <div class="flex justify-between items-center border-t pt-6">
                        <a href="{{ route('center.index') }}"
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
