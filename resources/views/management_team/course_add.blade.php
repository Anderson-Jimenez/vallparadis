<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Afegir cursos</title>
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
            <main class="flex-grow flex flex-col items-center w-full py-10">
                <h1 class="text-white text-3xl w-10/12 text-center p-10 border-b-6 border-[#ff7300]">Formulari afegir nou curs</h1>
                <form action="{{ route('course.store') }}" method="POST" class="m-10 flex flex-col w-5/12 p-10  bg-black-transparent rounded-3xl">
                    @csrf

                    <label for="code_forcem" class="text-white text-xl">Codi FORCEM:</label>
                    <select id="code_forcem" name="code_forcem" required class="bg-white-transparent p-3 my-3 text-black rounded-3xl cursor-pointer w-full">
                        <option value="HORTA">HORTA</option>
                        <option value="LA PINEDA">LA PINEDA</option>
                        <option value="AMETLLA">AMETLLA</option>
                        <option value="M. BETRIU">M. BETRIU</option>
                        <option value="T. DE LLOPS">T. DE LLOPS</option>
                        <option value="MAS I DALMAU">MAS I DALMAU</option>
                        <option value="MORA LA NOVA">MORA LA NOVA</option>
                        <option value="TAMARIU">TAMARIU</option>
                        <option value="TURSIA">TURSIA</option>
                        <option value="CAMBRILS SUITE">CAMBRILS SUITE</option>
                        <option value="POBLENOU">POBLENOU</option>
                    </select>

                    <label for="hours" class="text-white text-xl">Horas:</label>
                    <input type="number" id="hours" name="hours" value="{{ old('hours') }}" required class="bg-white-transparent p-3 mb-2 text-white rounded-3xl">

                    <label for="type" class="text-white text-xl">Tipus:</label>
                    <select id="type" name="type" required class="bg-white-transparent p-3 my-3 text-black rounded-3xl cursor-pointer w-full">
                        <option value="Formació Interna">Formació Interna</option>
                        <option value="Formació Externa">Formació Externa</option>
                        <option value="Formació Salut Laboral">Formació Salut Laboral</option>
                        <option value="Jorn/Taller/Seminari/Congrés">Jorn/Taller/Seminari/Congrés</option>
                    </select>

                    <label for="mode" class="text-white text-xl">Presencial/Online:</label>
                    <select id="mode" name="mode" required class="bg-white-transparent p-3 my-3 text-black rounded-3xl cursor-pointer w-full">
                        <option value="Presencial">Presencial</option>
                        <option value="Online">Online</option>
                        <option value="Mixte">Mixte</option>
                    </select>

                    <label for="training_name" class="text-white text-xl">Nom formació/Taller/Jornada/Congrés:</label>
                    <input type="text" id="training_name" name="training_name" value="{{ old('training_name') }}" required class="bg-white-transparent p-3 mb-2 text-white rounded-3xl">

                    <button type="submit" class="m-5 text-lg text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300] transition-all duration-300 rounded-full p-5">Crear Curs</button>
                </form>
            </main>
            @include('components.footer')
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>