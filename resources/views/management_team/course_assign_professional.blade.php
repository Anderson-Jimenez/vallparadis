<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
        <main class="grow flex w-full">
            @extends('layouts.app')
            @include('components.aside')
            @yield('contingut')
                <main class="flex flex-col items-center w-4/5">
                    <h1 class="txt-orange text-2xl w-10/12 text-center p-10 border-b-6 border-[#ff7300]">Assignar professionals a cursos</h1>
                    <section class="w-full h-full flex flex-wrap flex-col items-center">
                        <aside id="drop_zona" class="h-4/5 w-3/12 bg-white rounded-3xl p-6 border border-[#FF7400] flex-col items-center mt-8 ">
                            <h2 class="text-2xl font-bold text-[#FF7400] mb-3">{{$course->training_name}}</h2>
                            <p class="text-gray-600 mb-1">{{$course->code_forcem}}</p>
                            <p class="text-gray-600 mb-1">{{$course->hours}}</p>
                            <p class="text-gray-600 mb-4">{{$course->type}}</p>
                            <p class="text-gray-600 mb-4">{{$course->mode}}</p>
                            <!-- ZONA DE ASIGNACIÓN -->
                            <h3 class="mt-6 text-lg font-semibold text-[#FF7400]">Professionals assignats</h3>

                            <div id="assigned_zone" 
                                class="min-h-32 border-2 border-dashed border-[#FF7400] bg-[#FFF4E9] rounded-xl p-3 mt-2">
                            </div>

                            <!-- BOTÓN -->
                            <button id="save_assignments"
                                class="mt-6 bg-[#FF7400] text-white px-4 py-2 rounded-xl hover:bg-[#e36300] transition">
                                Guardar Assignació
                            </button>

                            <input type="hidden" id="course_id" value="{{ $course->id }}">
                        </aside>
                        <div id="professionals_list" class="h-4/5 w-3/6 bg-white rounded-3xl p-6 border border-[#FF7400] flex-col items-center mt-8 ">
                            <h2 class="text-xl font-bold text-[#FF7400] mb-4">Llista de professionals</h2>
                            @foreach ($professionals as $professional)
                                <div  class="professional-info w-full bg-white flex rounded-3xl p-5 my-3 border border-[#FF7400]
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
                        </div>
                    </section>
                    
                </main>
            
        </main>

        @include('components.footer')
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>