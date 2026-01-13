<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Afegir projecte/comissio</title>
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
                <h1 class="text-white text-3xl w-10/12 text-center p-10 border-b-6 border-[#ff7300]">Formulari afegir nou projecte / comissió</h1>
                
                <form action="{{ route('project_comission.store') }}" method="POST" enctype="multipart/form-data" class="m-10 flex flex-wrap w-5/12 p-10  bg-black-transparent rounded-3xl">
                    @csrf
                    <label for="name" class="text-white text-xl w-full">Nom del projecte:</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full bg-white-transparent p-3 my-3 text-black rounded-3xl cursor-pointer">

                    <label for="professional_manager_id" class="text-white text-xl">Manager del projecte:</label>
                    <select name="professional_manager_id" id="professional_manager_id" required class="bg-white-transparent p-3 my-3 text-black rounded-3xl cursor-pointer w-full">
                        <option value="">-- Selecciona un professional --</option>
                        @foreach ($professionals as $professional)
                            <option value="{{ $professional->id }}" {{ old('professional_manager_id')}}>{{ $professional->name }} {{ $professional->surnames }}</option>
                        @endforeach
                    </select>

                    <label for="start_date" class="text-white text-xl w-full">Data d'inici:</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required class="bg-white-transparent p-3 my-3 text-white rounded-3xl cursor-pointer w-full">

                    <label for="description" class="text-white text-xl w-full">Descripció:</label>
                    <textarea name="description" id="description" rows="4" required class="bg-white-transparent p-3 my-3 text-white rounded-3xl cursor-pointer w-full">{{ old('description') }}</textarea>

                    <label for="observation" class="text-white text-xl">Observacions:</label>
                    <textarea name="observation" id="observation" rows="4" required class="bg-white-transparent p-3 mb-2 text-white rounded-3xl cursor-pointer w-full">{{ old('observation') }}</textarea>

                    <span class="text-white text-xl w-full my-3">Tipus:</span>
                    <label for="projecte" class="text-white text-xl my-3">Projecte</label>
                    <input type="radio" id="projecte" name="type" value="Projecte" {{ old('type') }} required class="m-2 w-[1vw] cursor-pointer">
                    
                    <label for="comissio" class="text-white text-xl my-3">Comissió</label>
                    <input type="radio" id="comissio" name="type" value="Comissió" {{ old('type') }} class="m-2 w-[1vw] cursor-pointer">
                    

                    <label for="pujar_fitxer" class="text-white text-xl w-full my-3">Pujar arxiu:</label> 
                    <input type="file" name="path[]" id="path" multiple class="bg-white-transparent p-3 mb-2 text-white rounded-3xl cursor-pointer w-full">

                    <button class="m-5 text-lg text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300] transition-all duration-300 rounded-full p-5 w-full">Crear Projecte</button>
                </form>
            </main>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>