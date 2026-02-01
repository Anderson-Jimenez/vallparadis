<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar contacte</title>
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
                <h1 class="text-2xl font-semibold">Editar contacte</h1>
            </div>
            <p class="text-gray-500 mb-6">
                Modifiqueu la informació del contacte
            </p>

            @if ($errors->any())
                <ul class="mb-4 px-10">
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('external_contacts.update', $external_contact->id) }}" class="bg-white rounded-lg shadow overflow-hidden">
                @csrf
                @method('PUT')
                
                <div class="bg-orange-500 text-white px-6 py-3">
                    <p class="font-semibold">Informació del contacte</p>
                    <p class="text-sm opacity-80">Els camps marcats amb * són obligatoris</p>
                </div>

                <div class="p-8 flex flex-col gap-8">
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Informació bàsica</h2>
                        <div>
                            <label class="text-sm text-gray-600">Nom complet *</label>
                            <input name="name" required 
                                   class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" 
                                   value="{{ old('name', $external_contact->name) }}"
                                   placeholder="Introdueix el teu nom complet">
                        </div>
                        <div class="flex gap-4">
                            <div class="w-1/2">
                                <label class="text-sm text-gray-600">Tipus de contacte *</label>
                                <select name="type" required
                                        class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                                    <option value="">Selecciona el tipus de contacte</option>
                                    <option value="assistencials" {{ old('type', $external_contact->type) == 'assistencials' ? 'selected' : '' }}>Assistencials</option>
                                    <option value="serveis generals" {{ old('type', $external_contact->type) == 'serveis generals' ? 'selected' : '' }}>Serveis Generals</option>
                                </select>
                            </div>
                            <div class="w-1/2">
                                <label class="text-sm text-gray-600">Organització *</label>
                                <input name="organization" required 
                                       class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" 
                                       value="{{ old('organization', $external_contact->organization) }}"
                                       placeholder="Nom de l'organització">
                            </div>
                        </div>
                    </section>
                    
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Finalitat i origen</h2>

                        <div class="flex gap-4">
                            <div class="w-1/2">
                                <label class="text-sm text-gray-600">Tipus de finalitat *</label>
                                <select name="purpose_type" required
                                        class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                                    <option value="">Selecciona la finalitat</option>
                                    <option value="motiu" {{ old('purpose_type', $external_contact->purpose_type) == 'motiu' ? 'selected' : '' }}>Motiu</option>
                                    <option value="servei" {{ old('purpose_type', $external_contact->purpose_type) == 'servei' ? 'selected' : '' }}>Servei</option>
                                </select>
                            </div>

                            <div class="w-1/2">
                                <label class="text-sm text-gray-600">Tipus d'origen *</label>
                                <select name="origin_type" required
                                        class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                                    <option value="">Selecciona quin tipus d'origen</option>
                                    <option value="company" {{ old('origin_type', $external_contact->origin_type) == 'company' ? 'selected' : '' }}>Companya</option>
                                    <option value="department" {{ old('origin_type', $external_contact->origin_type) == 'department' ? 'selected' : '' }}>Departament</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Finalitat</label>
                            <textarea name="purpose" rows="4"
                                      class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                                      placeholder="Fes una descripció de la finalitat d'aquest contacte">{{ old('purpose', $external_contact->purpose) }}</textarea>
                        </div>
                    </section>
                    
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Detalls de contacte</h2>

                        <div class="flex gap-4">
                            <div class="w-1/2">
                                <label class="text-sm text-gray-600">Responsable</label>
                                <input name="manager" 
                                       class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" 
                                       value="{{ old('manager', $external_contact->manager) }}"
                                       placeholder="Nom del responsable">
                            </div>

                            <div class="w-1/2">
                                <label class="text-sm text-gray-600">Telèfon *</label>
                                <input name="phone_numer" required 
                                       class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" 
                                       value="{{ old('phone_numer', $external_contact->phone_numer) }}"
                                       placeholder="+34 600 000 000">
                            </div>
                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Correu electrònic *</label>
                            <input type="email" name="email_address" required 
                                   class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1" 
                                   value="{{ old('email_address', $external_contact->email_address) }}"
                                   placeholder="email@exemple.com">
                        </div>
                    </section>
                    
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Informació addicional</h2>
                        <textarea name="comments" rows="3" 
                                  class="w-full border-2 border-gray-200 rounded-md px-3 py-2" 
                                  placeholder="Afegeix notes o comentaris addicionals">{{ old('comments', $external_contact->comments) }}</textarea>
                    </section>

                    <div class="flex justify-between items-center border-t pt-6">
                        <a href="{{ route('external_contacts.index') }}" 
                           class="border border-orange-500 text-orange-500 hover:underline px-6 py-4 rounded-xl">
                            Cancel·lar
                        </a>

                        <button type="submit" 
                                class="bg-orange-500 text-white px-6 py-4 rounded-md hover:bg-white hover:text-orange-500 hover:border-orange-500 border flex items-center">
                            <svg class="w-6 h-6 mr-2">
                                <use xlink:href="#save_icon"></use>
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
    <h1 class="text-center mt-10">No has iniciat sessió.</h1>
    <meta http-equiv="refresh" content="2; URL={{ route('login') }}">
@endguest
</body>
</html>