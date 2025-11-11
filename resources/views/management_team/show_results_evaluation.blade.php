<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body class="min-h-screen flex flex-col bg-[#E9EDF2]">
    @extends('layouts.app')
    @include('partials.icons')
    @auth
        @include('components.navbar')
        <div class="max-w-4xl mx-auto p-6">
            <h1 class="text-2xl font-bold mb-4">Informe de Avaluació</h1>
            <p class="mb-2"><strong>Professional:</strong> {{ $evaluation->assessedProfessional->name }}</p>
            <p class="mb-4"><strong>Data:</strong> {{ $evaluation->evaluation_date }}</p>

            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-orange-100">
                    <tr>
                        <th class="border p-2">Pregunta</th>
                        <th class="border p-2">Resposta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($evaluation->results as $index => $result)
                        @php
                            $value = $result->score;
                            $color = match($value) {
                                1 => 'bg-red-200 text-red-800',
                                2 => 'bg-yellow-200 text-yellow-800',
                                3 => 'bg-blue-200 text-blue-800',
                                4 => 'bg-green-200 text-green-800',
                                default => ''
                            };
                        @endphp
                        <tr class="border-b">
                            <td class="border p-2">{{ $questions[$index] }}</td>
                            <td class="border p-2 text-center font-bold {{ $color }}">{{ $value }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('professionals.evaluations', $evaluation->assessed_professional_id) }}" class="inline-block mt-4 bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-full">
                Tornar enrere
            </a>
        </div>
    @endauth

    @guest
        <h1>No has iniciat sessió.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest

</body>
</html>