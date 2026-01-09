    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Gestió Curs</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="min-h-screen flex flex-col bg-[#E9EDF2]">
        @include('partials.icons')     
        @auth
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @endif
            @include('components.navbar')
            <main class="flex w-full max-h-screen">
                @include('components.sidebar')
                @yield('contingut')
                    <section class="flex flex-col items-center w-4/5 mt-5">
                        <h1 class="txt-orange text-4xl w-10/12 text-center p-7 border-b-6 border-[#ff7300]">
                            Assignar professionals a cursos
                        </h1>

                        <section class="flex w-4/5 flex-wrap justify-between mt-8">
                            <!-- ZONA DE ASIGNACIÓN -->
                            <aside id="drop_zona" class="w-2/6 bg-white rounded-3xl p-6 border border-[#FF7400] flex flex-col">
                                <h2 class="text-2xl font-bold text-[#FF7400] mb-3">{{$course->training_name}}</h2>
                                <p class="text-gray-600 mb-1">{{$course->code_forcem}}</p>
                                <p class="text-gray-600 mb-1">{{$course->hours}}</p>
                                <p class="text-gray-600 mb-4">{{$course->type}}</p>
                                <p class="text-gray-600 mb-4">{{$course->mode}}</p>

                                <h3 class="mt-6 text-lg font-semibold text-[#FF7400]">Professionals assignats</h3>
                                <div id="assigned_zone" 
                                    class="min-h-32 h-[10vw] border-2 border-dashed border-[#FF7400] bg-[#FFF4E9] rounded-xl p-3 mt-2 w-full flex flex-col overflow-y-auto">
                                </div>

                                <button id="save_assignments"
                                        class="mt-6 bg-[#FF7400] text-white px-4 py-2 rounded-xl hover:bg-[#e36300] transition">
                                    Guardar Assignació
                                </button>
                                <input type="hidden" id="course_id" value="{{ $course->id }}">
                            </aside>

                            <!-- LISTA DE PROFESIONALES -->
                            <div id="professionals_list" class="w-3/5 bg-white rounded-3xl p-6 border border-[#FF7400] flex flex-col items-center max-h-[80vh] overflow-y-auto">
                                <h2 class="text-xl font-bold text-[#FF7400] mb-4">Llista de professionals</h2>
                                @foreach ($professionals as $professional)
                                    <div class="professional-info w-full bg-white flex rounded-3xl p-5 my-3 border border-[#FF7400]
                                        justify-between shadow-md hover:scale-105 transition-all duration-400">
                                        <div draggable="true" id="{{ $professional->id }}" class="professional flex items-center cursor-pointer">
                                            <input type="text" value="{{ $professional->id }}" class="hidden">
                                            <svg class="w-8 h-8 txt-orange mr-3">
                                                <use xlink:href="#professional_icon"></use>
                                            </svg>
                                            <p class="txt-orange text-lg">
                                                {{ $professional->name }} {{ $professional->surnames }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="w-full flex justify-around mt-6 mb-4">
                                    
                                </div>
                            </div>
                        </section>
                    </section>
                
            </main>
        @endauth

        @guest
            <h1>No has iniciado sesión.</h1>
            <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
        @endguest
    </body>
    </html>