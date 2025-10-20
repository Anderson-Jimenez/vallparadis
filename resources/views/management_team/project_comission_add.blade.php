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
            <main class="flex-grow flex flex-col items-center w-full py-10">
                <h1 class="text-white text-3xl w-10/12 text-center p-10 border-b-6 border-[#ff7300]">Formulari afegir nou projecte / comissió</h1>
                <form action="{{ route('project_comission.store') }}" method="POST" enctype="multipart/form-data" class="m-10 flex flex-col w-5/12 p-10  bg-black-transparent rounded-3xl">
                    @csrf
                    <label for="name" class="text-white text-xl">Nom del projecte:</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required>

                    <label for="professional_manager_id" class="text-white text-xl">Manager del projecte:</label>
                    <select name="professional_manager_id" id="professional_manager_id" required>
                        <option value="">-- Selecciona un professional --</option>
                        @foreach ($professionals as $professional)
                            <option value="{{ $professional->id }}" {{ old('professional_manager_id')}}>{{ $professional->name }} {{ $professional->surnames }}</option>
                        @endforeach
                    </select>

                    <label for="start_date" class="text-white text-xl">Data d'inici:</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required>

                    <label for="description" class="text-white text-xl">Descripció:</label>
                    <textarea name="description" id="description" rows="4" required>{{ old('description') }}</textarea>

                    <label for="observation" class="text-white text-xl">Observacions:</label>
                    <textarea name="observation" id="observation" rows="4" required>{{ old('observation') }}</textarea>

                    <span>Tipus:</span>
                    <input type="radio" id="projecte" name="type" value="Projecte" {{ old('type') }} required>
                    <label for="projecte">Projecte</label><br>

                    <input type="radio" id="comissio" name="type" value="Comissió" {{ old('type') }}>
                    <label for="comissio">Comissió</label><br><br>

                    Pujar arxiu: <input type="file" name="path[]" id="path" multiple>

                    <button type="submit" class="m-5 text-lg text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300] transition-all duration-300 rounded-full p-5">Crear Projecte</button>
                </form>
            </main>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>