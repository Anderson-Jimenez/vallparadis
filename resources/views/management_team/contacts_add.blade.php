<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Añadir contacto</title>
@vite('resources/css/app.css')
</head>
<body class="bg-orange-50 min-h-screen">
    @include('partials.icons')
    @auth
        @include('components.navbar')
        <main class="flex flex-col items-center justify-center py-10">
            <div class="flex w-3/4">
                <svg class="w-6 h-6 mr-2 txt-orange">
                    <use xlink:href="#add_prof_icon"></use>
                </svg>
                <h1 class="font-semibold w-4/5 text-left text-2xl">Afegir nou contacte</h1>
            </div>
            <p class="w-3/4 opacity-50 text-lg text-left pl-7 mb-7">Ompliu informació per guardar un nou contacte</p>

            <form method="POST" action="{{ route('external_contacts.index') }}"
                class="w-3/4  bg-white rounded-lg shadow p-6 flex flex-col gap-6">
                @csrf


                <div class="flex flex-col gap-3">
                    <h2 class="font-semibold text-gray-700">Informació bàsica</h2>
                    <input name="name" required class="input" placeholder="Nom complet *">
                    <input name="type" required class="input" placeholder="Tipus de contacte *">
                    <input name="organization" required class="input" placeholder="Organització *">
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="font-semibold text-gray-700">Finalitat i origen</h2>
                    <select name="purpose_type" required class="input">
                        <option value="">Finalitat *</option>
                        <option value="commercial">Comercial</option>
                        <option value="support">Suport</option>
                    </select>
                    <select name="origin_type" required class="input">
                        <option value="">Origen *</option>
                        <option value="web">Web</option>
                        <option value="email">Email</option>
                    <option value="phone">Telèfon</option>
                    </select>
                    <textarea name="purpose" rows="2" class="input" placeholder="Descripció"></textarea>
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="font-semibold text-gray-700">Detalls de contacte</h2>
                    <input name="manager" required class="input" placeholder="Manager *">
                    <input name="phone" required class="input" placeholder="Telèfon *">
                    <input name="email" type="email" required class="input" placeholder="Email *">
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="font-semibold text-gray-700">Notes</h2>
                    <textarea name="comments" rows="3" class="input" placeholder="Comentaris"></textarea>
                </div>

                <div class="flex justify-between pt-4 border-t">
                    <a href="{{ route('external_contacts.index') }}" class="text-gray-600">Cancel·lar</a>
                    <button class="bg-orange-500 text-white px-5 py-2 rounded hover:bg-orange-600">
                    Afegir contacte
                    </button>
                </div>
            </form>
        </main>
    @endauth
    @guest
        <h1>No has iniciat sessió.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>