<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Curs</title>
    @vite(['resources/css/app.css', 'resources/js/courses_assignment.js'])
</head>

<body class="min-h-screen bg-body flex flex-col">
    @include('partials.icons')
    @auth
        @include('components.navbar')
        <main class="flex flex-1 min-h-0">
            @include('components.sidebar')
            <section class="flex flex-col w-full min-h-0">
                <div class="w-full bg-white flex items-center justify-between py-6 px-10 shadow-md border-b border-gray-200 shrink-0">
                    <div>
                        <h1 class="text-[#2D3E50] text-4xl font-bold pb-2">
                            Assignar professionals
                        </h1>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <use xlink:href="#clipboard_icon"></use>
                            </svg>
                            <p class="text-lg">{{ $course->training_name }}</p>
                        </div>
                    </div>

                    <span class="px-4 py-2 bg-orange-100 text-orange-800 rounded-lg font-medium">
                        {{ $course->code_forcem }}
                    </span>
                </div>

                <section class="flex flex-col md:flex-row gap-6 p-6 flex-1 min-h-0">

                    <aside id="drop_zona"
                           class="md:w-2/5 bg-white rounded-lg p-6 border border-gray-200 flex flex-col shadow-lg min-h-0">

                        <div class="mb-6 shrink-0">
                            <div class="flex justify-between items-center border-b border-gray-100 mb-5 py-3">
                                <h2 class="text-2xl font-bold text-gray-800">
                                    Informació del curs
                                </h2>

                                @if ($course->status == "active")
                                    <span class="text-green-600 text-base">● Actiu</span>
                                @else
                                    <span class="text-red-600 text-base">● Inactiu</span>
                                @endif
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-gray-100 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500 mb-1">Hores</p>
                                    <p class="text-base font-semibold text-gray-800">{{ $course->hours }}</p>
                                </div>
                                <div class="bg-gray-100 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500 mb-1">Modalitat</p>
                                    <p class="text-base font-semibold text-gray-800">{{ $course->mode }}</p>
                                </div>
                                <div class="bg-gray-100 p-4 rounded-lg col-span-2">
                                    <p class="text-sm text-gray-500 mb-1">Tipus</p>
                                    <p class="text-base font-semibold text-gray-800">{{ $course->type }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col flex-1 min-h-0">
                            <h3 class="text-xl font-bold text-gray-800 mb-4 shrink-0">
                                Assignació actual
                            </h3>
                            <div id="assigned_zone"
                                 class="flex-1 border-2 border-dashed border-gray-300 bg-gray-50 rounded-xl p-4 overflow-y-auto transition-all duration-300 hover:border-orange-400 min-h-0">
                            </div>

                            <button id="save_assignments"
                                    class="mt-6 w-full bg-linear-to-r from-orange-500 to-orange-600 text-white px-4 py-3 rounded-xl hover:from-orange-600 hover:to-orange-700 transition-all duration-300 font-semibold text-lg shadow-md hover:shadow-lg shrink-0">
                                <div class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Guardar Assignacions
                                </div>
                            </button>

                            <input type="hidden" id="course_id" value="{{ $course->id }}">
                        </div>
                    </aside>

                    <div class="w-3/5 flex flex-col gap-6 min-h-0">
                        <div id="professionals_list"
                             class="bg-white rounded-lg p-6 border border-gray-200 flex flex-col shadow-lg min-h-0">
                            <div class="mb-6 shrink-0">
                                <div class="flex justify-between items-start border-b border-gray-100 pb-4">
                                    <div>
                                        <h2 class="text-2xl font-bold text-gray-800">
                                            Llista de professionals
                                        </h2>
                                        <p class="text-gray-600 text-sm">
                                            Arrossega per assignar al curs
                                        </p>
                                    </div>

                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-lg font-medium text-sm">
                                        @php
                                            $available_count = 0;
                                            foreach ($professionals as $professional) {
                                                $is_assigned = false;
                                                foreach ($assigned_professionals as $assignment) {
                                                    if ($assignment->professional_id == $professional->id) {
                                                        $is_assigned = true;
                                                    }
                                                }
                                                if ($is_assigned == false) {
                                                    $available_count = $available_count + 1;
                                                }
                                            }
                                            echo $available_count . ' disponibles';
                                        @endphp
                                    </span>
                                </div>
                            </div>

                            <div class="flex-1 min-h-0 overflow-y-auto pr-2">
                            
                                @php
                                    $has_available = false;
                                    foreach ($professionals as $professional) {
                                        $is_assigned = false;
                                        foreach ($assigned_professionals as $assignment) {
                                            if ($assignment->professional_id == $professional->id) {
                                                $is_assigned = true;
                                            }
                                        }
                                        if ($is_assigned == false) {
                                            $has_available = true;
                                        }
                                    }
                                @endphp

                                @if($has_available == true)
                                    <div class="grid grid-cols-2 gap-3">
                                        @foreach ($professionals as $professional)
                                            @php
                                                $is_assigned = false;
                                                foreach ($assigned_professionals as $assignment) {
                                                    if ($assignment->professional_id == $professional->id) {
                                                        $is_assigned = true;
                                                    }
                                                }
                                            @endphp
                                            
                                            @if($is_assigned == false)
                                                <div class="professional-info bg-white rounded-lg p-3 border border-gray-200 hover:border-orange-300 hover:shadow-md transition-all duration-300 cursor-move group flex w-full"
                                                    draggable="true">

                                                    <div draggable="true"
                                                        id="{{ $professional->id }}"
                                                        class="professional flex items-center w-full cursor-move">

                                                        <input type="text" value="{{ $professional->id }}" class="hidden">

                                                        <div class="shrink-0">
                                                            <div class="w-10 h-10 bg-linear-to-br from-orange-100 to-orange-50 rounded-lg flex items-center justify-center group-hover:from-orange-200 group-hover:to-orange-100 transition-all">
                                                                <svg class="w-5 h-5 text-orange-600">
                                                                    <use xlink:href="#professional_icon"></use>
                                                                </svg>
                                                            </div>
                                                        </div>

                                                        <div class="ml-3 grow min-w-0">
                                                            <h3 class="font-semibold text-gray-800 text-base group-hover:txt-orange transition-colors">
                                                                {{ $professional->name }} {{ $professional->surnames }}
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-8">
                                        <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <use xlink:href="#professional_icon"></use>
                                            </svg>
                                        </div>
                                        <p class="text-gray-500">Tots els professionals ja estan assignats</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
                <section class="px-6 pb-6">
                        <div class="bg-white rounded-xl shadow border border-gray-200">
                            <div class="px-6 py-5 border-b border-gray-100">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                                            <svg class="w-5 h-5 text-green-500">
                                                <use xlink:href="#check_icon"></use>
                                            </svg>
                                            Professionals ja assignats
                                        </h2>
                                        <p class="text-sm text-gray-500 mt-1">
                                            Professionals assignats prèviament a aquest curs
                                        </p>
                                    </div>
                                    
                                    <span class="inline-flex items-center px-3 py-1.5 bg-green-100 text-green-800 text-sm font-medium rounded-lg border border-green-200">
                                        {{ count($assigned_professionals) }} assignats
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-6">
                                @if(count($assigned_professionals) > 0)
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                                        @foreach ($assigned_professionals as $assignment)
                                            <div class="bg-gray-50 rounded-xl border border-gray-200 hover:border-gray-300 transition-colors">
                                                <div class="p-4">
                                                    <div class="flex items-start justify-between">
                                                        <div class="flex items-center gap-3">
                                                            <div class="w-10 h-10 bg-gradient-to-br from-green-100 to-green-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                                                <svg class="w-5 h-5 text-green-600">
                                                                    <use xlink:href="#check_icon"></use>
                                                                </svg>
                                                            </div>
                                                            <div class="min-w-0">
                                                                <h3 class="font-semibold text-gray-800 text-sm truncate">
                                                                    {{ $assignment->professional->name }} {{ $assignment->professional->surnames }}
                                                                </h3>
                                                                <p class="text-xs text-gray-500 mt-1">
                                                                    Assignat: {{ date('d/m/Y', strtotime($assignment->start_date)) }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Accions a la dreta -->
                                                        <div class="flex items-center gap-1 ml-2">
                                                            <!-- Botó Editar -->
                                                            <a href="{{ route('professional-courses.edit', $assignment->id) }}"
                                                               class="p-1.5 text-gray-400 hover:text-orange-600 hover:bg-orange-50 rounded transition-colors"
                                                               title="Editar assignació">
                                                                <svg class="w-4 h-4">
                                                                    <use xlink:href="#edit_icon"></use>
                                                                </svg>
                                                            </a>
                                                            
                                                            <!-- Botó Eliminar -->
                                                            <form action="{{ route('professional-courses.destroy', $assignment->id) }}" 
                                                                  method="POST" 
                                                                  class="inline"
                                                                  onsubmit="return confirm('Segur que voleu eliminar aquesta assignació?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" 
                                                                        class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors"
                                                                        title="Eliminar assignació">
                                                                    <svg class="w-4 h-4">
                                                                        <use xlink:href="#delete_icon"></use>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="mt-3 pt-3 border-t border-gray-200">
                                                        <div class="flex items-center justify-between">
                                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium 
                                                                @if($assignment->certificate == 'Donat')
                                                                    bg-green-100 text-green-800
                                                                @else
                                                                    bg-yellow-100 text-yellow-800
                                                                @endif">
                                                                <svg class="w-3 h-3 mr-1.5">
                                                                    <use xlink:href="#attached_icon"></use>
                                                                </svg>
                                                                Cerficiat: {{ $assignment->certificate }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="flex flex-col items-center justify-center py-12">
                                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-10 h-10 text-gray-400">
                                                <use xlink:href="#professional_icon"></use>
                                            </svg>
                                        </div>
                                        <p class="text-gray-600 font-medium mb-2">Encara no hi ha professionals assignats</p>
                                        <p class="text-gray-400 text-sm text-center max-w-md">
                                            Arrossegueu professionals des del panell superior per començar a assignar
                                        </p>
                                    </div>
                                @endif
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