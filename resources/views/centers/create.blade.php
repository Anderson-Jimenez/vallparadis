<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Afegir nou centre</title>
    @vite('resources/css/app.css')
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
            <h1 class="text-2xl font-semibold">Afegir nou centre</h1>
            <p class="text-gray-500 mb-6">
                Ompliu la informació per crear un nou centre
            </p>

            <!-- Formulario -->
            <form action="{{ route('center.store') }}" method="POST" class="bg-white rounded-lg shadow overflow-hidden">
                @csrf

                <div class="bg-orange-500 text-white px-6 py-3">
                    <p class="font-semibold">Informació del centre</p>
                    <p class="text-sm opacity-80">Els camps marcats amb * són obligatoris</p>
                </div>
                <div class="p-8 flex flex-col gap-8">

                    <div>
                        <label class="text-sm text-gray-600">Nom del centre *</label>
                        <input
                            type="text"
                            name="center_name"
                            required
                            value="{{ old('center_name') }}"
                            class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                            placeholder="Nom del centre">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Ubicació *</label>
                        <input
                            type="text"
                            name="location"
                            required
                            value="{{ old('location') }}"
                            class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                            placeholder="Adreça o ciutat">
                    </div>

                    <div class="flex gap-6">
                        <div class="w-1/2">
                            <label class="text-sm text-gray-600">Telèfon *</label>
                            <input
                                type="text"
                                name="phone_number"
                                required
                                value="{{ old('phone_number') }}"
                                class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                                placeholder="Número de telèfon">
                        </div>

                        <div class="w-1/2">
                            <label class="text-sm text-gray-600">Correu electrònic *</label>
                            <input type="email" name="email_address" required value="{{ old('email_address') }}" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                                placeholder="email@centre.com">
                        </div>
                    </div>

                    <div class="flex justify-between items-center border-t pt-6">
                        <a href="{{ route('center.index') }}"
                           class="border border-orange-500 text-orange-500 hover:underline px-6 py-4 rounded-xl">
                            Cancel·lar
                        </a>

                        <button type="submit"
                                class="bg-orange-500 text-white px-6 py-4 rounded-md hover:bg-white hover:text-orange-500 hover:border-orange-500 border transition flex items-center">
                            Crear centre
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
