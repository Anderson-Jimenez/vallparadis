<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Afegir projecte/comissio</title>
    @vite("resources/css/app.css")
</head>
<body>
    @auth
        <form action="{{ route('project_comission.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="name">Nom del projecte:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            <br><br>

            <label for="professional_manager_id">Manager del projecte:</label>
            <select name="professional_manager_id" id="professional_manager_id" required>
                <option value="">-- Selecciona un professional --</option>
                @foreach ($professionals as $professional)
                    <option value="{{ $professional->id }}" {{ old('professional_manager_id')}}>{{ $professional->name }} {{ $professional->surnames }}</option>
                @endforeach
            </select>
            <br><br>

            <label for="start_date">Data d'inici:</label>
            <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
            <br><br>

            <label for="description">Descripció:</label>
            <textarea name="description" id="description" rows="4" required>{{ old('description') }}</textarea>
            <br><br>

            <label for="observation">Observacions:</label>
            <textarea name="observation" id="observation" rows="4" required>{{ old('observation') }}</textarea>
            <br><br>

            <span>Tipus:</span><br>
            <input type="radio" id="projecte" name="type" value="Projecte" {{ old('type') }} required>
            <label for="projecte">Projecte</label><br>

            <input type="radio" id="comissio" name="type" value="Comissió" {{ old('type') }}>
            <label for="comissio">Comissió</label><br><br>

            Pujar arxiu: <input type="file" name="path[]" id="path" multiple><br><br>

            <button type="submit">Crear Projecte</button>
        </form>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>