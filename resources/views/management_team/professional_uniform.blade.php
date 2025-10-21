<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Afegir professional</title>
    @vite("resources/css/app.css")
</head>
<body>
    @auth
        
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif

        <form action="{{ route('professional.uniform', $professional) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <h1><strong>Uniformes de professional</strong></h1><br><br>
            <label for="shirt_size">Talla camisa:</label>
            <select name="shirt_size" id="shirt_size">
                
                <option value="{{ $uniform ? $uniform->shirt_size : '' }}">
                    {{ $uniform ? $uniform->shirt_size : 'Uniforme para elegir' }}
                </option>
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="2XL">2XL</option>
                <option value="3XL">3XL</option>
                <option value="4XL">4XL</option>
            </select>
            
            <label for="trausers_size">Talla pantalón:</label>
            <select name="trausers_size" id="trausers_size">
                <option value="{{ $uniform ? $uniform->trausers_size : '' }}">
                    {{ $uniform ? $uniform->trausers_size : 'Uniforme para elegir' }}
                </option>
                @for ($i = 36; $i <= 56; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>

            <label for="shoes_size">Talla calzado:</label>
            <select name="shoes_size" id="shoes_size">
                <option value="{{ $uniform ? $uniform->shoes_size : '' }}">
                    {{ $uniform ? $uniform->shoes_size : 'Uniforme para elegir' }}
                </option>
                @for ($i = 36; $i <= 56; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>

            <label for="renovation_date">Fecha de renovación:</label>
            <input type="date" name="renovation_date" id="renovation_date" value="{{ $uniform ? $uniform->renovation_date : '' }}">

            <label for="docs_route">Documento:</label>
            <input type="file" name="docs_route" id="docs_route">
            <button >Crear Uniforme</button>
        </form>
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>