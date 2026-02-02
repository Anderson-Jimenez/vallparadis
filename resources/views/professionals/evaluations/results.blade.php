<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resultats Avaluació</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="min-h-screen flex flex-col bg-body">
    @include('partials.icons')
    @auth
        @include('components.navbar')
            
        <div class="flex flex-col w-9/12 mx-auto p-6 items-center bg-white m-10 rounded-3xl">
            <h1 class="text-4xl mb-10 text-center w-11/12 border-b-gray-400 border-b-2 p-4">Informe de Avaluació </h1>

            <table class="w-11/12 text-left border-amber-600  border-collapse">
                <thead class="bg-orange-100 border">
                    <tr class="border">
                        <th class="p-2 border">Pregunta</th>
                        <th class="text-center border">Gens d’acord</th>
                        <th class="text-center border">Poc d’acord</th>
                        <th class="text-center border">Bastant d’acord</th>
                        <th class="text-center border">Molt d’acord</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $index => $question)
                        <tr class="bg-white border">
                            <td class="p-2">{{ $question }}</td>
                            @php
                                $answer = optional($evaluation->results)->{'q'.($index+1)};
                            @endphp
                            @for ($i = 1; $i <= 4; $i++)
                                <td class="text-center border 
                                    @if($answer == $i)
                                        {{ $i == 1 ? 'bg-red-300' : '' }}
                                        {{ $i == 2 ? 'bg-yellow-300' : '' }}
                                        {{ $i == 3 ? 'bg-orange-300' : '' }}
                                        {{ $i == 4 ? 'bg-green-300' : '' }}
                                    @endif
                                    ">
                                    @if($answer == $i)
                                        ✔
                                    @endif
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="w-11/12">
                <a href="{{ route('professionals.evaluations', $evaluation->assessed_professional_id) }}" class="flex items-center w-max mt-4 bg-orange-500 hover:bg-orange-600 text-white px-7 py-4 rounded-lg">
                    <svg class="w-6 h-6 text-white mr-2">
                        <use xlink:href="#back_icon"></use>
                    </svg>
                    Tornar enrere
                </a>
            </div>


        </div>
    @endauth

    @guest
        <h1>No has iniciat sessió.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest

</body>
</html>