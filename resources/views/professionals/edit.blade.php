<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulari Modificacio Professional</title>
    @vite("resources/css/app.css")
</head>
<body class="min-h-screen flex flex-col bg-[#2D3E50]">
    @auth
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
        @include('components.navbar')   
        @yield('contingut')
            <main class="flex flex-col items-center w-full py-10">
                <h1 class="text-white text-3xl w-10/12 text-center p-10 border-b-6 border-[#ff7300]">Formulari modificio professional</h1>
                <form action="{{ route('professional.update', $professional) }}" method="POST" class="m-10 flex flex-col w-5/12 p-10  bg-black-transparent rounded-3xl">
                    @csrf
                    @method('PUT')
                    <label for="name" class="text-white text-xl">Nom:</label>
                    <input type="text" name="name" id="name" value="{{ $professional->name }}" required class="bg-white-transparent p-3 mb-2 text-white rounded-3xl">

                    <label for="surnames" class="text-white text-xl">Cognoms:</label>
                    <input type="text" name="surnames" id="surnames" value="{{ $professional->surnames }}" required class="bg-white-transparent p-3 mb-2 text-white rounded-3xl">

                    <label for="username" class="text-white text-xl">Nom d’usuari:</label>
                    <input type="text" name="username" id="username" value="{{ $professional->username }}" required class="bg-white-transparent p-3 mb-2 text-white rounded-3xl">

                    <label for="password" class="text-white text-xl">Contrasenya:</label>
                    <input type="password" name="password" id="password" value="" class="bg-white-transparent p-3 mb-2 text-white rounded-3xl">

                    <label for="phone_number" class="text-white text-xl">Telèfon:</label>
                    <input type="text" name="phone_number" id="phone_number" value="{{ $professional->phone_number }}" required class="bg-white-transparent p-3 mb-2 text-white rounded-3xl">

                    <label for="email_address" class="text-white text-xl">Correu electrònic:</label>
                    <input type="text" name="email_address" id="email_address" value="{{ $professional->email_address }}" required class="bg-white-transparent p-3 mb-2 text-white rounded-3xl">

                    <label for="address" class="text-white text-xl">Adreça:</label>
                    <input type="text" name="address" id="address" value="{{ $professional->address }}" required class="bg-white-transparent p-3 mb-2 text-white rounded-3xl">

                    <label for="number_locker" class="text-white text-xl">Número de taquilla:</label>
                    <input type="text" name="number_locker" id="number_locker" value="{{ $professional->number_locker }}" required class="bg-white-transparent p-3 mb-2 text-white rounded-3xl">

                    <label for="clue_locker" class="text-white text-xl">Clau de la taquilla:</label>
                    <input type="text" name="clue_locker" id="clue_locker" value="{{ $professional->clue_locker }}" required class="bg-white-transparent p-3 mb-2 text-white rounded-3xl">

                    <button type="submit" class="m-5 text-lg text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300] transition-all duration-300 rounded-full p-5">Modificar dades de {{ $professional->name }}</button>
                </form>
            </main>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>