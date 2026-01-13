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
            <main class="flex flex-col items-center w-full py-10">
                <h1 class="text-white text-3xl w-10/12 text-center p-10 border-b-6 border-[#ff7300]">Formulari modificar projecte / comissió</h1>
                <form action="{{ route('project_comission.update', $project_comission) }}" method="POST" enctype="multipart/form-data" class="m-10 flex flex-wrap w-5/12 p-10  bg-black-transparent rounded-3xl">
                    @csrf
                    @method('PUT')
                    <label for="name" class="text-white text-xl w-full">Nom del projecte:</label>
                    <input type="text" name="name" id="name" value="{{ $project_comission->name }}" required class="w-full bg-white-transparent p-3 my-3 text-black rounded-3xl cursor-pointer">

                    <label for="professional_manager_id" class="text-white text-xl w-full">Manager del projecte:</label>
                    <select name="professional_manager_id" id="professional_manager_id" required class="w-full bg-white-transparent p-3 my-3 text-black rounded-3xl cursor-pointer">
                        <option value="{{ $project_comission->professional_manager_id }}">{{ $professional_name }}</option>
                        @foreach ($professionals as $professional)
                            <option value="{{ $professional->id }}" {{ old('professional_manager_id')}}>{{ $professional->name }} {{ $professional->surnames }}</option>
                        @endforeach
                    </select>

                    <label for="start_date" class="text-white text-xl w-full">Data d'inici:</label>
                    <input type="date" name="start_date" id="start_date" value="{{ $project_comission->start_date }}" required class="w-full bg-white-transparent p-3 my-3 text-black rounded-3xl cursor-pointer">

                    <label for="description" class="text-white text-xl w-full">Descripció:</label>
                    <textarea name="description" id="description" rows="4" required class="w-full bg-white-transparent p-3 my-3 text-black rounded-3xl cursor-pointer">{{ $project_comission->description }}</textarea>

                    <label for="observation" class="text-white text-xl w-full">Observacions:</label>
                    <textarea name="observation" id="observation" rows="4" required class="w-full bg-white-transparent p-3 my-3 text-black rounded-3xl cursor-pointer">{{ $project_comission->observation }}</textarea>

                    <span class="text-white text-xl w-full my-3">Tipus:</span>

                    <label for="projecte" class="text-white text-xl my-3">Projecte</label>
                    <input type="radio" id="projecte" name="type" value="Projecte" 
                        {{ $project_comission->type == 'Projecte' ? 'checked' : '' }} required class="m-2 w-[1vw] cursor-pointer">
                    
                    <label for="comissio" class="text-white text-xl my-3">Comissió</label>
                    <input type="radio" id="comissio" name="type" value="Comissió" 
                        {{ $project_comission->type == 'Comissió' ? 'checked' : '' }} class="m-2 w-[1vw] cursor-pointer">
                    

                    <span class="text-white text-xl w-full my-3">Pujar fitxer</span> 
                    <input type="file" name="path[]" id="path" multiple class="w-full bg-white-transparent p-3 my-3 text-black rounded-3xl cursor-pointer">

                    <button type="submit" class="m-5 text-lg text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300] transition-all duration-300 rounded-full p-5 w-full">Modificar Projecte</button>
                </form>
            </main>
        
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>