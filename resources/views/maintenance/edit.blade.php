<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Afegir nou contacte</title>
    @vite(['resources/css/app.css', 'resources/js/documents_center.js'])
</head>

<body class="bg-orange-50 min-h-screen">
@include('partials.icons')

@auth
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
    @include('components.navbar')
    <main class="flex justify-center py-10">
        <div class="w-3/4">
            <form action="{{ route('maintenance.update', $maintenance) }}" method="POST" class="bg-white rounded-lg shadow overflow-hidden">
                @csrf
                @method('PUT')
                <div class="bg-orange-500 text-white px-6 py-3">
                    <p class="font-semibold">Informació del manteniment</p>
                </div>

                <div class="p-8 flex flex-col gap-8">
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Informació bàsica</h2>
                        <div>
                            <label class="text-sm text-gray-600">Nom manteniment</label>
                            <input name="name" required class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" placeholder="Introdueix el nom" value="{{ $maintenance->name }}">
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Data d'obertura</label>
                            <input type="date" name="start_date" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" value="{{ $maintenance->start_date }}">
                        </div>
                    </section>
                    
                    </section>
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Detalls de contacte del responsable</h2>

                        <div class="flex gap-4">
                            <div class="w-1/2">
                                <label class="text-sm text-gray-600">Responsable</label>
                                <input name="manager" required class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" placeholder="Nom del responsable" value="{{ $maintenance->name }}">
                            </div>

                            <div class="w-1/2">
                                <label class="text-sm text-gray-600">Telèfon</label>
                                <input name="phone" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" placeholder="N/A" value="{{ $maintenance->phone }}">
                            </div>
                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Correu electrònic </label>
                            <input type="email" name="email" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" placeholder="N/A" value="{{ $maintenance->email }}">
                        </div>
                    </section>
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Informació addicional</h2>
                        <textarea name="description" rows="3" class="w-full border-2 border-gray-200 rounded-md px-3 py-2" placeholder="Afegeix notes o comentaris addicionals">{{ $maintenance->description }}</textarea>
                    </section>

                    <div class="flex justify-between items-center border-t pt-6">
                        <a href="{{ route('maintenance.show', $maintenance) }}" class="border border-[#ff7300] txt-orange hover:underline px-6 py-4 rounded-xl">
                            Cancel·lar edició
                        </a>

                        <button type="submit" class="bg-orange-500 text-white px-6 py-4 rounded-md hover:bg-white hover:text-[#ff7300] hover:border-[#ff7300] border flex items-center">
                            <svg class="w-6 h-6 mr-2">
                                <use xlink:href="#maintenance_icon"></use>
                            </svg>
                            Guardar noves dades
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
