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
    @include('components.navbar')
    <main class="flex justify-center py-10">
        <div class="w-3/4">

            <div class="flex items-center gap-2 mb-1">
                <svg class="w-6 h-6 text-orange-500">
                    <use xlink:href="#add_prof_icon"></use>
                </svg>
                <h1 class="text-2xl font-semibold">Afegir nova entrada de manteniment</h1>
            </div>
            <p class="text-gray-500 mb-6">
                Ompliu informació per guardar la entrada de manteniment
            </p>

            <form method="POST" action="{{ route('maintenance.index') }}" class="bg-white rounded-lg shadow overflow-hidden">
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
                            <input name="name" required class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" placeholder="Introdueix el nom">
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Data d'obertura *</label>
                            <input type="date" name="start_date" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" value="{{ old('date', date('Y-m-d')) }}">
                        </div>
                    </section>
                    
                    </section>
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Detalls de contacte del responsable</h2>

                        <div class="flex gap-4">
                            <div class="w-1/2">
                                <label class="text-sm text-gray-600">Responsable</label>
                                <input name="manager" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" placeholder="Nom del responsable">
                            </div>

                            <div class="w-1/2">
                                <label class="text-sm text-gray-600">Telèfon *</label>
                                <input name="phone_numer" required class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" placeholder="+34 600 000 000">
                            </div>
                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Correu electrònic *</label>
                            <input type="email" name="email_address" required class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" placeholder="email@exemple.com">
                        </div>
                    </section>
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Informació addicional</h2>
                        <textarea name="comments" rows="3" class="w-full border-2 border-gray-200 rounded-md px-3 py-2" placeholder="Afegeix notes o comentaris addicionals"></textarea>
                    </section>

                    <div class="flex justify-between items-center border-t pt-6">
                        <a href="{{ route('external_contacts.index') }}" class="border border-[#ff7300] txt-orange hover:underline px-6 py-4 rounded-xl">
                            Cancel·lar
                        </a>

                        <button type="submit" class="bg-orange-500 text-white px-6 py-4 rounded-md hover:bg-white hover:text-[#ff7300] hover:border-[#ff7300] border flex items-center">
                            <svg class="w-6 h-6 mr-2">
                                <use xlink:href="#add_prof_icon"></use>
                            </svg>
                            Afegir contacte
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
