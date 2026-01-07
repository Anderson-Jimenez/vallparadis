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
        <main class="flex flex-col items-center w-full py-10">
            <h1 class="text-white text-2xl w-10/12 text-center p-10 border-b-6 border-[#ff7300]">Gestió uniformes professional</h1>
            <form action="{{ route('professional.uniform', $professional) }}" method="POST" enctype="multipart/form-data" class="m-10 flex flex-col w-5/12 p-10  bg-black-transparent rounded-3xl">
                @csrf                
                <label for="shirt_size" class="text-white text-xl">Talla camisa:</label>
                <select name="shirt_size" id="shirt_size" class="bg-white-transparent p-3 my-3 text-black rounded-3xl cursor-pointer w-full">
                    
                    <option value="">Uniforme para elegir</option>
                    <option value="XS" {{ old('shirt_size') }}>XS</option>
                    <option value="S" {{ old('shirt_size') }}>S</option>
                    <option value="M" {{ old('shirt_size') }}>M</option>
                    <option value="L" {{ old('shirt_size') }}>L</option>
                    <option value="XL" {{ old('shirt_size') }}>XL</option>
                    <option value="2XL" {{ old('shirt_size') }}>2XL</option>
                    <option value="3XL" {{ old('shirt_size') }}>3XL</option>
                    <option value="4XL" {{ old('shirt_size') }}>4XL</option>
                </select>
                
                <label for="trausers_size" class="text-white text-xl">Talla pantalón:</label>
                <select name="trausers_size" id="trausers_size" class="bg-white-transparent p-3 my-3 text-black rounded-3xl cursor-pointer w-full">
                    <option value="">Uniforme para elegir</option>
                    @for ($i = 36; $i <= 56; $i++)
                        <option value="{{ $i }}" {{ old('shirt_size') }}>{{ $i }}</option>
                    @endfor
                </select>

                <label for="shoes_size" class="text-white text-xl">Talla calzado:</label>
                <select name="shoes_size" id="shoes_size" class="bg-white-transparent p-3 my-3 text-black rounded-3xl cursor-pointer w-full">
                    <option value="">Uniforme para elegir</option>
                    @for ($i = 36; $i <= 56; $i++)
                        <option value="{{ $i }}" {{ old('shirt_size') }}>{{ $i }}</option>
                    @endfor
                </select>

                <label for="renovation_date" class="text-white text-xl">Fecha de renovación:</label>
                <input type="date" name="renovation_date" id="renovation_date" value="{{ old('renovation_date') }}" required class="bg-white-transparent p-3 my-3 text-black rounded-3xl cursor-pointer w-full">

                <label for="docs_route" class="text-white text-xl">Documento:</label>
                <input type="file" name="docs_route" id="docs_route" class="bg-white-transparent p-3 my-3 text-black rounded-3xl cursor-pointer w-full">
                <button class="m-5 text-lg text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300] transition-all duration-300 rounded-full p-5">Crear Uniforme</button>
            </form>
        </main>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>