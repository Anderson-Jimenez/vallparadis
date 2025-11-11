<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resultats Avaluació</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="min-h-screen flex flex-col bg-[#E9EDF2]">
    @include('partials.icons')
    @auth
        @include('components.navbar')
            
        <div class="flex flex-col w-4/5 mx-auto p-6 items-center bg-white">
            <a href="{{ route('professionals.evaluations', $evaluation->assessed_professional_id) }}" class="flex items-center w-max mt-4 bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-full">
                <svg class="w-8 h-8 text-white mr-2">
                    <use xlink:href="#back_arrow_icon"></use>
                </svg>
                Tornar enrere
            </a>
            <h1 class="text-2xl font-bold mb-4">Informe de Avaluació</h1>

            <table class="w-4/5 text-left border mt-6 border-collapse">
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
                            @for ($i = 1; $i <= 4; $i++)


                                <td class="text-center border">
                                    <input type="text" name="q{{ $index + 1 }}" value="" class="w-1/12">
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
        @include('components.footer')
    @endauth

    @guest
        <h1>No has iniciat sessió.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest

</body>
</html>