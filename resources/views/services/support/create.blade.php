<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Afegir professional</title>
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
            <main class="grow flex flex-col items-center w-full py-10">
                <h1 class="text-white text-3xl w-10/12 text-center p-10 border-b-6 border-[#ff7300]">Formulari afegir nou servei complementari</h1>
                <form action="{{ route('supplementary_service.store') }}" method="POST" enctype="multipart/form-data" class="m-10 flex flex-col w-5/12 p-10  bg-black-transparent rounded-3xl">
                    @csrf

                    <label for="type" class="text-white text-xl">Tipus:</label>
                    <input type="text" name="type" id="type" value="{{ old('type') }}" required class="bg-white-transparent p-3 mb-2 text-white rounded-3xl"> 

                    <label for="start_date" class="text-white text-xl">Data d'inici:</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required class="bg-white-transparent p-3 mb-2 text-white rounded-3xl">

                    <label for="manager" class="text-white text-xl">Responsable:</label>
                    <input type="text" name="manager" id="manager" value="{{ old('manager') }}" required class="bg-white-transparent p-3 mb-2 text-white rounded-3xl">

                    <label for="email_address" class="text-white text-xl">Correu electrònic:</label>
                    <input type="text" name="email_address" id="email_address" value="{{ old('email_address') }}" required class="bg-white-transparent p-3 mb-2 text-white rounded-3xl">

                    <label for="phone_number" class="text-white text-xl">Telèfon:</label>
                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" required class="bg-white-transparent p-3 mb-2 text-white rounded-3xl">

                    <label for="pujar_fitxer" class="text-white text-xl w-full my-3">Pujar arxiu:</label> 
                    <input type="file" name="docs[]" id="docs" multiple class="bg-white-transparent p-3 mb-2 text-white rounded-3xl cursor-pointer w-full">
                    
                    <label for="comments" class="text-white text-xl w-full my-3">Comentaris:</label> 
                    <textarea name="comments" id="comments" class="bg-white-transparent p-3 mb-2 text-white rounded-3xl cursor-pointer w-full"></textarea>
                    
                    <button type="submit" class="m-5 text-lg text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300] transition-all duration-300 rounded-full p-5">Crear servei</button>
                </form>
            </main>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>