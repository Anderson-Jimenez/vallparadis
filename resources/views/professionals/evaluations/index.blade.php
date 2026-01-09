<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Professionals</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-[#E9EDF2]">
    @include('partials.icons')
    @auth
        @include('components.navbar')

        <main class="flex w-full">
            @include('components.sidebar')
            @yield('contingut')
            <section id="principal-content" class="w-full flex gap-10 px-10 py-10 justify-center items-center">
                <!-- PANEL IZQUIERDO -->
                <aside class="bg-white flex flex-col items-center justify-center 
                            w-1/4 min-h-[65vh] text-center border border-[#FF7400] rounded-2xl">

                    <svg class="w-40 h-40 txt-orange">
                        <use xlink:href="#professional_icon"></use>
                    </svg>

                    <h2 class="txt-orange text-3xl py-3">{{ $professional->name }} {{ $professional->surnames }}</h2>
                    <h3 class="text-[#2D3E50] text-xl my-2">{{ $professional->email_address }}</h3>
                    <h3 class="text-[#2D3E50] text-xl my-2">{{ $professional->address }}</h3>
                    <h3 class="text-[#2D3E50] text-xl my-2">{{ $professional->phone_number }}</h3>

                    @if ($professional->status != 'inactive')      
                        <button class="bg-[#DCFCE7] text-[#16A34A] rounded-full px-7 py-2 shadow-md hover:bg-[#BBF7D0] transition my-2">
                            Actiu
                        </button>                 
                    @else                    
                        <button class="bg-[#FEE2E2] text-[#DC2626] rounded-full px-7 py-2 shadow-md hover:bg-[#FECACA] transition my-2">
                            Inactiu
                        </button>
                    @endif
                </aside>

                <!-- PANEL DERECHO -->
                <div id="evaluations_section" 
                    class="flex flex-col bg-white w-3/5 rounded-2xl border border-[#FF7400] p-6 min-h-[75vh]">
                    <div class="w-full flex justify-between items-center mb-4">
                        <input type="search" name="search_evaluation" id="search_evaluation" 
                            class="w-2/5 rounded-3xl px-4 py-3 bg-white border border-[#FF7400]"
                            placeholder="Cerca avaluació...">
                    
                        <a id="add_evaluations_btn" href="{{ route('evaluations.create_evaluations',$professional) }}"
                        class="text-lg text-white bg-[#ff7300] hover:bg-[#ff73008a] transition-all duration-300 rounded-2xl px-7 py-4">
                            + Nova Avaluació
                        </a>
                    </div>

                    <!-- LISTA SCROLLEABLE -->
                    <div id="prof-info-container"
                        class="w-full flex flex-col items-center overflow-auto h-[70vh] rounded-xl p-4 bg-[#213c573f]">

                        @foreach ($evaluations as $evaluation)
                            <div class="evaluation-info w-11/12 bg-white flex rounded-3xl p-7 my-3 
                                        border border-[#FF7400] justify-between shadow-md hover:scale-102 
                                        transition-all duration-400 cursor-pointer">
                                <a href="{{ route('evaluations.show_results_evaluation',$evaluation) }}" class="w-full">
                                    <div id="{{$evaluation->assessed_professional_id}}" class="professional_evaluated flex items-center">
                                        <svg class="w-10 h-10 txt-orange mr-3">
                                            <use xlink:href="#documentation_icon"></use>
                                        </svg>
                                        <p class="txt-orange text-lg">
                                            Evaluació dia {{ $evaluation->evaluation_date }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>

                </div>
            </section>

        </main>
    @endauth

    @guest
        <h1>No has iniciat sessió.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>