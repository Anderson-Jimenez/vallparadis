<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Detall servei general</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-orange-50 min-h-screen">
@include('partials.icons')

@auth
@include('components.navbar')

<main class="flex justify-center py-10">
    <div class="w-3/4">
        <!-- Header -->
        <div class="bg-orange-500 text-white px-6 py-3 mt-6">
            <p class="font-semibold">Informació del servei general</p>
        </div>

        <div class="p-8 flex flex-col gap-8 bg-white">

            <!-- Informació bàsica -->
            <section class="flex flex-col gap-4">
                <h2 class="font-semibold text-gray-700">Informació bàsica</h2>

                <div class="flex gap-6">
                    <div class="w-1/2">
                        <label class="text-sm text-gray-600">Tipus de servei</label>
                        <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                            {{ $general_service->type }}
                        </p>
                    </div>
                    
                    <div class="w-1/2">
                        <label class="text-sm text-gray-600">Centre</label>
                        <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                            {{ $general_service->centers->name ?? 'No assignat' }}
                        </p>
                    </div>
                </div>
            </section>

            <!-- Contacte i responsable -->
            <section class="flex flex-col gap-4">
                <h2 class="font-semibold text-gray-700">Contacte i responsable</h2>

                <div class="flex gap-6">
                    <div class="w-1/2">
                        <label class="text-sm text-gray-600">Manager/Responsable</label>
                        <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                            {{ $general_service->manager ?? 'No assignat' }}
                        </p>
                    </div>

                    <div class="w-1/2">
                        <label class="text-sm text-gray-600">Contacte</label>
                        <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                            @if($general_service->contact)
                                <a href="mailto:{{ $general_service->contact }}" class="text-orange-500 hover:underline">
                                    {{ $general_service->contact }}
                                </a>
                            @else
                                No definit
                            @endif
                        </p>
                    </div>
                </div>
            </section>

            <!-- Personal i horari -->
            <section class="flex flex-col gap-4">
                <h2 class="font-semibold text-gray-700">Personal i horari</h2>

                <div class="flex gap-6">
                    <div class="w-1/2">
                        <label class="text-sm text-gray-600">Personal assignat</label>
                        <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                            {{ $general_service->staff ?? 'No assignat' }}
                        </p>
                    </div>

                    <div class="w-1/2">
                        <label class="text-sm text-gray-600">Horari</label>
                        <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                            {{ $general_service->schedule ?? 'No definit' }}
                        </p>
                    </div>
                </div>
            </section>

            <!-- Informació del sistema -->
            <section class="flex flex-col gap-4">
                <h2 class="font-semibold text-gray-700">Informació del sistema</h2>

                <div class="flex gap-6">
                    <div class="w-1/3">
                        <label class="text-sm text-gray-600">ID del servei</label>
                        <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                            {{ $general_service->id }}
                        </p>
                    </div>

                    <div class="w-1/3">
                        <label class="text-sm text-gray-600">Creat el</label>
                        <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                            {{ $general_service->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    <div class="w-1/3">
                        <label class="text-sm text-gray-600">Actualitzat el</label>
                        <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                            {{ $general_service->updated_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                </div>
            </section>

            <!-- Accions -->
            <div class="flex justify-between items-center border-t pt-6">
                <div class="flex gap-4">
                    <a href="{{ route('general_service_followup.index', $general_service) }}"
                       class="border border-orange-500 text-orange-500 hover:underline px-6 py-4 rounded-xl flex items-center">
                        <svg class="w-5 h-5 mr-2">
                            <use xlink:href="#evaluations_icon"></use>
                        </svg>
                        Veure seguiments
                    </a>
                    
                    <a href="{{ route('general_service.edit', $general_service) }}"
                       class="border border-orange-500 text-orange-500 hover:underline px-6 py-4 rounded-xl flex items-center">
                        <svg class="w-5 h-5 mr-2">
                            <use xlink:href="#edit_icon"></use>
                        </svg>
                        Modificar dades
                    </a>
                </div>
                
                <a href="{{ route('general_service.index') }}"
                   class="bg-orange-500 text-white hover:underline px-6 py-4 rounded-xl flex items-center">
                    <svg class="w-5 h-5 mr-2">
                        <use xlink:href="#arrow_left_icon"></use>
                    </svg>
                    Tornar a la llista
                </a>
            </div>

        </div>
    </div>
</main>

@endauth

@guest
    <h1 class="text-center mt-10">No has iniciat sessió.</h1>
    <meta http-equiv="refresh" content="2; URL={{ route('login') }}">
@endguest

</body>
</html>