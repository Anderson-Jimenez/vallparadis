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
        <form action="{{ route('project_comission.update', $project_comission) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="name">Nom del projecte:</label>
            <input type="text" name="name" id="name" value="{{ $project_comission->name }}" required>
            <br><br>

            <label for="professional_manager_id">Manager del projecte:</label>
            <select name="professional_manager_id" id="professional_manager_id" required>
                <option value="{{ $project_comission->professional_manager_id }}">{{ $professional_name }}</option>
                @foreach ($professionals as $professional)
                    <option value="{{ $professional->id }}" {{ old('professional_manager_id')}}>{{ $professional->name }} {{ $professional->surnames }}</option>
                @endforeach
            </select>
            <br><br>

            <label for="start_date">Data d'inici:</label>
            <input type="date" name="start_date" id="start_date" value="{{ $project_comission->start_date }}" required>
            <br><br>

            <label for="description">Descripció:</label>
            <textarea name="description" id="description" rows="4" required>{{ $project_comission->description }}</textarea>
            <br><br>

            <label for="observation">Observacions:</label>
            <textarea name="observation" id="observation" rows="4" required>{{ $project_comission->observation }}</textarea>
            <br><br>

            <span>Tipus:</span><br>
            <input type="radio" id="projecte" name="type" value="Projecte" 
                {{ $project_comission->type == 'Projecte' ? 'checked' : '' }} required>
            <label for="projecte">Projecte</label><br>

            <input type="radio" id="comissio" name="type" value="Comissió" 
                {{ $project_comission->type == 'Comissió' ? 'checked' : '' }}>
            <label for="comissio">Comissió</label><br><br>

            Pujar arxiu: <input type="file" name="path[]" id="path" multiple><br><br>

            <button type="submit">Modificar Projecte</button>
        </form>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>