<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Detalls del contacte</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-orange-50 min-h-screen">
@include('partials.icons')

@auth
    @include('components.navbar')
    <main class="flex justify-center py-10">
        <div class="w-3/4">

            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6 text-orange-500">
                        <use xlink:href="#add_prof_icon"></use>
                    </svg>
                    <h1 class="text-2xl font-semibold">Detalls del contacte</h1>
                </div>
                
                <div class="flex gap-4">
                    <a href="{{ route('external_contacts.edit', $external_contact->id) }}" 
                       class="bg-orange-500 text-white px-6 py-3 rounded-md hover:bg-white hover:text-orange-500 hover:border-orange-500 border flex items-center">
                        <svg class="w-5 h-5 mr-2">
                            <use xlink:href="#edit_icon"></use>
                        </svg>
                        Editar
                    </a>
                    
                    <form action="{{ route('external_contacts.destroy', $external_contact->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('¿Estàs segur que vols eliminar aquest contacte?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 text-white px-6 py-3 rounded-md hover:bg-red-600 transition flex items-center">
                            <svg class="w-5 h-5 mr-2">
                                <use xlink:href="#delete_icon"></use>
                            </svg>
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <!-- Capçalera -->
                <div class="bg-orange-500 text-white px-6 py-3">
                    <p class="font-semibold">Informació del contacte</p>
                </div>

                <!-- Contingut -->
                <div class="p-8 flex flex-col gap-8">
                    <!-- Informació bàsica -->
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700 border-b pb-2">Informació bàsica</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-500">Nom complet</p>
                                <p class="text-lg font-medium mt-1">{{ $external_contact->name }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500">Tipus de contacte</p>
                                <p class="text-lg font-medium mt-1">
                                    @if($external_contact->type == 'assistencials')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                                            Assistencials
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-green-100 text-green-800">
                                            Servei Generals
                                        </span>
                                    @endif
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500">Organització</p>
                                <p class="text-lg font-medium mt-1">{{ $external_contact->organization }}</p>
                            </div>
                        </div>
                    </section>

                    <!-- Finalitat i origen -->
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700 border-b pb-2">Finalitat i origen</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-500">Tipus de finalitat</p>
                                <p class="text-lg font-medium mt-1">
                                    @if($external_contact->purpose_type == 'motiu')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-purple-100 text-purple-800">
                                            Motiu
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-800">
                                            Servei
                                        </span>
                                    @endif
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500">Tipus d'origen</p>
                                <p class="text-lg font-medium mt-1">
                                    @if($external_contact->origin_type == 'company')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-indigo-100 text-indigo-800">
                                            Companya
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-pink-100 text-pink-800">
                                            Departament
                                        </span>
                                    @endif
                                </p>
                            </div>
                            
                            @if($external_contact->purpose)
                                <div class="md:col-span-2">
                                    <p class="text-sm text-gray-500">Finalitat</p>
                                    <p class="text-lg font-medium mt-1 bg-gray-50 p-4 rounded-md">{{ $external_contact->purpose }}</p>
                                </div>
                            @endif
                        </div>
                    </section>

                    <!-- Detalls de contacte -->
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700 border-b pb-2">Detalls de contacte</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($external_contact->manager)
                                <div>
                                    <p class="text-sm text-gray-500">Responsable</p>
                                    <p class="text-lg font-medium mt-1">{{ $external_contact->manager }}</p>
                                </div>
                            @endif
                            
                            <div>
                                <p class="text-sm text-gray-500">Telèfon</p>
                                <p class="text-lg font-medium mt-1">
                                    <a href="tel:{{ $external_contact->phone_numer }}" class="text-orange-500 hover:underline">
                                        {{ $external_contact->phone_numer }}
                                    </a>
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500">Correu electrònic</p>
                                <p class="text-lg font-medium mt-1">
                                    <a href="mailto:{{ $external_contact->email_address }}" class="text-orange-500 hover:underline">
                                        {{ $external_contact->email_address }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </section>

                    <!-- Informació addicional -->
                    @if($external_contact->comments)
                        <section class="flex flex-col gap-4">
                            <h2 class="font-semibold text-gray-700 border-b pb-2">Informació addicional</h2>
                            <div class="bg-gray-50 p-4 rounded-md">
                                <p class="text-gray-700 whitespace-pre-line">{{ $external_contact->comments }}</p>
                            </div>
                        </section>
                    @endif

                    <!-- Informació del sistema -->
                    <section class="flex flex-col gap-4 pt-4 border-t">
                        <h2 class="font-semibold text-gray-700">Informació del sistema</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm text-gray-500">
                            <div>
                                <p>ID del contacte:</p>
                                <p class="font-medium">{{ $external_contact->id }}</p>
                            </div>
                            
                            <div>
                                <p>Creat el:</p>
                                <p class="font-medium">{{ $external_contact->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            
                            <div>
                                <p>Actualitzat el:</p>
                                <p class="font-medium">{{ $external_contact->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </section>

                    <!-- Botons -->
                    <div class="flex justify-between items-center border-t pt-6">
                        <a href="{{ route('external_contacts.edit', $external_contact->id) }}" 
                            class="bg-orange-500 text-white px-6 py-4 rounded-md hover:bg-white hover:text-orange-500 hover:border-orange-500 border flex items-center">
                            <svg class="w-6 h-6 mr-2">
                                <use xlink:href="#edit_icon"></use>
                            </svg>
                            Editar contacte
                        </a>

                        <a href="{{ route('external_contacts.index') }}" 
                           class="border border-orange-500 text-orange-500 hover:underline px-6 py-4 rounded-xl">
                            Tornar a la llista
                        </a>


                    </div>
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