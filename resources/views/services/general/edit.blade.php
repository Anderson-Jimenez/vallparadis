<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar servei general</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-body min-h-screen">

@include('components.navbar')

@auth
    @if ($errors->any())
        <div class="fixed top-20 right-4 z-50">
            @foreach ($errors->all() as $error)
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-2 rounded-lg shadow-lg">
                    <p>{{ $error }}</p>
                </div>
            @endforeach
        </div>
    @endif

    <main class="flex justify-center py-10">
        <div class="w-3/4">

            <div class="flex items-center gap-2 mb-1">
                <h1 class="text-2xl font-semibold">Editar servei general</h1>
            </div>
            <p class="text-gray-500 mb-6">Modifiqueu la informació del servei general</p>

            <form action="{{ route('general_service.update', $general_service->id) }}"
                  method="POST"
                  class="bg-white rounded-lg shadow overflow-hidden">
                @csrf
                @method('PUT')

                <div class="bg-orange-500 text-white px-6 py-3">
                    <p class="font-semibold">Informació del servei general</p>
                </div>

                <div class="p-8 flex flex-col gap-8">

                    <!-- Informació bàsica -->
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Informació bàsica</h2>
                        
                        <div class="flex flex-wrap gap-6">
                            <div class="flex-1 min-w-[250px]">
                                <label class="text-sm text-gray-600">Tipus de servei *</label>
                                <input type="text"
                                       name="type"
                                       value="{{ old('type', $general_service->type) }}"
                                       class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                                       readonly>
                                <p class="text-xs text-gray-500 mt-1">Tipus de servei predefinit</p>
                            </div>
                            
                        </div>
                    </section>

                    <!-- Responsable i contacte -->
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Responsable i contacte *</h2>
                        
                        <div class="flex flex-wrap gap-6">
                            <div class="flex-1 min-w-[250px]">
                                <label class="text-sm text-gray-600">Manager/Responsable *</label>
                                <input type="text"
                                       name="manager"
                                       value="{{ old('manager', $general_service->manager) }}"
                                       class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                                       placeholder="Nom del responsable"
                                       required>
                            </div>
                            
                            <div class="flex-1 min-w-[250px]">
                                <label class="text-sm text-gray-600">Contacte *</label>
                                <input type="text"
                                       name="contact"
                                       value="{{ old('contact', $general_service->contact) }}"
                                       class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                                       placeholder="email@exemple.com"
                                       required>
                            </div>
                        </div>
                    </section>

                    <!-- Personal i horari -->
                    <section class="flex flex-col gap-4">
                        <h2 class="font-semibold text-gray-700">Personal i horari *</h2>
                        
                        <div class="flex flex-wrap gap-6">
                            <div class="flex-1 min-w-[250px]">
                                <label class="text-sm text-gray-600">Personal assignat *</label>
                                <input type="text"
                                       name="staff"
                                       value="{{ old('staff', $general_service->staff) }}"
                                       class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                                       placeholder="Personal assignat al servei"
                                       required>
                            </div>
                            
                            <div class="flex-1 min-w-[250px]">
                                <label class="text-sm text-gray-600">Horari *</label>
                                <input type="text"
                                       name="schedule"
                                       value="{{ old('schedule', $general_service->schedule) }}"
                                       class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1"
                                       placeholder="Ex: Dilluns a Divendres 08:00-17:00"
                                       required>
                            </div>
                        </div>
                    </section>

                    <!-- Botons -->
                    <div class="flex justify-between items-center border-t pt-6">
                        <a href="{{ route('general_service.index', $general_service->id) }}"
                           class="border border-orange-500 text-orange-500 px-6 py-4 rounded-xl hover:underline">
                            Cancel·lar
                        </a>

                        <div class="flex gap-4">
                            <button type="submit"
                                    class="bg-orange-500 text-white px-6 py-4 rounded-md border hover:bg-white hover:text-orange-500 hover:border-orange-500 transition">
                                Guardar canvis
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </main>
@endauth

@guest
    <div class="min-h-screen flex items-center justify-center">
        <h1 class="text-center">No has iniciat sessió.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}">
    </div>
@endguest

</body>
</html>