<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Afegir avaluacio</title>
    @vite(['resources/css/app.css'])

</head>
<body class="min-h-screen flex flex-col bg-body">
    @include('partials.icons')
    @auth
        @include('components.navbar')
        <section id="principal-content" class="w-full flex justify-center items-center">
            <div id="add_evaluation" class="h-4/5 w-3/5 bg-white rounded-3xl shadow-black-500 shadow-xl p-10 m-10">
                <form action="{{ route('evaluations.store', $professional) }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="evaluator_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="assessed_professional_id" value="{{ $professional->id }}">

                    <div class="flex justify-between items-center mb-6 w-full">
                        <h2 class="text-2xl font-bold txt-orange">Nova Avaluació</h2>
                    </div>

                    <div>
                        <label class="text-orange-500 font-semibold uppercase text-sm">Data de l'avaluació</label>
                        <input type="date" name="evaluation_date" class="w-full bg-gray-200 rounded-full px-4 py-2 mt-1" value="{{ now()->format('Y-m-d') }}" required>
                    </div>

                    <table class="w-full text-left border mt-6">
                        <thead class="bg-orange-100">
                            <tr>
                                <th class="p-2">Pregunta</th>
                                <th class="text-center">Gens d’acord</th>
                                <th class="text-center">Poc d’acord</th>
                                <th class="text-center">Bastant d’acord</th>
                                <th class="text-center">Molt d’acord</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $questions = [
                                    "Realitza una correcta atenció a l'usuari",
                                    "Es preocupa per satisfer les seves necessitats dins dels recursos dels que disposa",
                                    "S'ha integrat dins de l'equip de treball i participa i coopera sense dificultats",
                                    "Pot treballar amb altres equips diferents al seu si es necessita",
                                    "Compleix amb les funcions establertes",
                                    "Assolix els objectius utilitzant els recursos disponibles per aconseguir els resultats esperats",
                                    "És coherent amb el que diu i amb les seves actuacions",
                                    "Les seves actuacions van alineades amb els valors de la nostra Entitat",
                                    "Mostra capacitat i interès per aplicar la normativa i els procediments establerts",
                                    "La seva actitud envers els seus responsables/comandaments és correcta",
                                    "Té capacitat per comprendre i acceptar i adequar-se als canvis",
                                    "Desenvolupa amb autonomia les seves funcions, sense necessitat de recolzament immediat/constant",
                                    "Fa suggeriments i propostes de millora",
                                    "Assolix els objectius, esforçant-se per aconseguir el resultat esperat",
                                    "La quantitat de treball que desenvolupa en relació amb el temps és adequada",
                                    "Realitza les tasques amb la qualitat esperada i/o necessària",
                                    "Expressa amb claredat i ordre els aspectes rellevants de la informació",
                                    "Dóna el suport documental necessari per desenvolupar les tasques requerides del lloc de treball",
                                    "Mostra interès i motivació envers el seu lloc de treball",
                                    "La seva entrada i permanència en el lloc de treball es duu a terme sense retards o absències no justificades",
                                ];
                            @endphp

                            @foreach ($questions as $index => $question)
                                <tr class="border-b">
                                    <td class="p-2">{{ $question }}</td>
                                    @for ($i = 1; $i <= 4; $i++)
                                        <td class="text-center">
                                            <input type="radio" name="q{{ $index + 1 }}" value="{{ $i }}" required>
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" name="total_score" id="total_score" value="0">
                    <p class="mt-4 text-right text-gray-600">
                        <strong>Puntuació total:</strong> <span id="score_display">0</span> / 10
                    </p>
                    <div class="flex justify-between">
                        <a href="{{ route('professionals.index') }}"
                           class="border border-orange-500 text-orange-500 px-6 py-4 rounded-xl hover:underline">
                            Cancel·lar
                        </a>
                        <button type="submit" class=" bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-full transition-all">
                            Guardar Avaluació
                        </button>
                    </div>

                </form>   
            </div>
        </section>
    @endauth

    @guest
        <h1>No has iniciat sessió.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest

</body>
</html>