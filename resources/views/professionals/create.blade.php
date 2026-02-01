<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Afegir projecte / comissió</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-body min-h-screen">

@include('components.navbar')

@auth
    @if ($errors->any())
        <ul class="mb-4 px-10">
            @foreach ($errors->all() as $error)
                <li class="text-red-500">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <main class="flex justify-center py-10">
        <div class="w-3/4">

            <div class="flex items-center gap-2 mb-1">
                <h1 class="text-2xl font-semibold">
                    Afegir nou professional
                </h1>
            </div>
            <p class="text-gray-500 mb-6">
                Ompliu la informació per crear un nou professional
            </p>

            <form action="{{ route('professional.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="bg-white rounded-lg shadow overflow-hidden">
                @csrf

                <div class="bg-orange-500 text-white px-6 py-3">
                    <p class="font-semibold">Informació bàsica</p>
                    <p class="text-sm opacity-80">Els camps marcats amb * són obligatoris</p>
                </div>

                <div class="p-8 flex flex-col gap-8">

                    <div>
                        <label class="text-sm text-gray-600">Nom *</label>
                        <input type="text"
                               name="name"
                               required
                               value="{{ old('name') }}"
                               class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Cognoms *</label>
                        <input type="text"
                               name="surnames"
                               required
                               value="{{ old('surnames') }}"
                               class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Nom d'usuari *</label>
                        <input type="text"
                               name="username"
                               required
                               value="{{ old('username') }}"
                               class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Contrasenya *</label>
                        <input type="text"
                               name="password"
                               required
                               value="{{ old('password') }}"
                               class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                    </div>
                    
                    <div>
                        <label class="text-sm text-gray-600">Seleccionar Rol *</label>
                        <select name="role_id" class=" border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                            @foreach($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->role }}</option>
                            @endforeach
                        </select>
                    </div>
                        
                    
                    <div>
                        <label class="text-sm text-gray-600">Telèfon *</label>
                        <input type="text"
                               name="phone_number"
                               required
                               value="{{ old('phone_number') }}"
                               class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Adreça electrònica *</label>
                        <input type="email"
                               name="email_address"
                               required
                               value="{{ old('email_address') }}"
                               class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Adreça *</label>
                        <input type="text"
                               name="address"
                               required
                               value="{{ old('address') }}"
                               class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Càrrec *</label>
                        <input type="text"
                               name="occupation"
                               required
                               value="{{ old('occupation') }}"
                               class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Número de guixeta *</label>
                        <input type="text"
                               name="number_locker"
                               required
                               value="{{ old('number_locker') }}"
                               class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Clau de guixeta *</label>
                        <input type="text"
                               name="clue_locker"
                               required
                               value="{{ old('clue_locker') }}"
                               class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Documents adjunts</label>
                        <input type="file" name="path[]" multiple class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                    </div>

                    <div class="flex justify-between items-center border-t pt-6">
                        <a href="{{ route('professionals.index') }}"
                           class="border border-orange-500 text-orange-500 px-6 py-4 rounded-xl hover:underline">
                            Cancel·lar
                        </a>

                        <button type="submit"
                                class="bg-orange-500 text-white px-6 py-4 rounded-md border hover:bg-white hover:text-orange-500 hover:border-orange-500 transition">
                            Crear professional
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
