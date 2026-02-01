<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestió Curs</title>
    @vite(['resources/css/app.css', 'resources/js/courses.js'])

</head>
<body class="min-h-screen flex flex-col bg-body">
    @include('partials.icons')     
    @auth
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
        @include('components.navbar')
        <main class="grow flex w-full">
            @include('components.sidebar')
            @yield('contingut')
            <section class="flex flex-col items-center w-full">
                <div class="w-full bg-white flex items-center justify-between py-4 px-10 shadow-sm border-b-2 border-gray-300">
                    <div>
                        <h1 class="text-[#2D3E50] text-4xl pb-1">Gestió de Cursos</h1>
                        <p class="text-[#2d3e50b7] text-lg pl-2">Administracio i modificacio de cursos</p>
                    </div>
                    <div class="flex gap-5">
                        <a href="{{ route('courses.export_excel') }}"
                           class="text-sm text-white sidebar-gradient hover:opacity-70 p-2 rounded-lg text-center flex items-center transition-all duration-300">
                            Exportar professionals assignats
                        </a>
                        <a href="{{route('course.create')}}" 
                            class="text-sm text-white sidebar-gradient hover:opacity-40 transition-all duration-300 rounded-lg p-4">
                            <svg class="w-5 h-5 inline-block mr-2">
                                <use xlink:href="#add_icon"></use>
                            </svg>
                            Afegir curs
                        </a>
                    </div>

                </div>
                
                <section class="flex w-full h-full">
                    <aside class="flex flex-col w-1/4 bg-white h-auto border-r border-gray-300">
                        <div class="p-6 border-b border-gray-300">
                            <h2 class="text-2xl font-semibold text-gray-700">Llista de Cursos</h2>
                            <p class="text-gray-500">Gestiona els cursos des d'aquesta secció.</p>
                        </div>
                        <div class="flex flex-col overflow-y-auto p-3">
                            @foreach ($courses as $course)
                                <div
                                    class="course-item mx-1 my-2 rounded-lg cursor-pointer p-4 border border-gray-300 hover:bg-gray-50 transition-all duration-200"
                                    data-id="{{ $course->id }}"
                                    data-name="{{ $course->training_name }}"
                                    data-code="{{ $course->code_forcem ?? 'Sense codi' }}"
                                    data-hours="{{ $course->hours ?? 0 }}"
                                    data-type="{{ $course->type ?? 'No especificat' }}"
                                    data-mode="{{ $course->mode ?? 'No especificat' }}"
                                    data-status="{{ $course->status ?? 'active' }}"
                                    data-center-id="{{ $course->center_id ?? '' }}"
                                    @if($course->center)
                                        data-center-name="{{ $course->center->center_name ?? 'Centre no assignat' }}"
                                    @else
                                        data-center-name="Centre no assignat"
                                    @endif
                                >
                                    <div class="flex justify-between items-start">
                                        <div class="w-full">
                                            <div class="flex justify-between items-start">
                                                <div class="flex-1">
                                                    <h3 class="font-semibold text-lg my-1">{{ $course->training_name }}</h3>
                                                    <p class="text-sm text-gray-500 my-1">{{ $course->code_forcem ?? 'Sense codi FORCEM' }}</p>
                                                </div>
                                                <div class="flex gap-2 ml-2">
                                                    <a href="{{ route('course.assign_professional', $course) }}" 
                                                       class="text-blue-600 hover:text-blue-800 p-1"
                                                       title="Assignar professional">
                                                        <svg class="w-5 h-5">
                                                            <use xlink:href="#add_prof_icon"></use>
                                                        </svg>
                                                    </a>
                                                    <a href="{{ route('course.edit', $course) }}" 
                                                       class="text-blue-600 hover:text-blue-800 p-1"
                                                       title="Editar curs">
                                                        <svg class="w-5 h-5">
                                                            <use xlink:href="#edit_icon"></use>
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('course.destroy', $course) }}" 
                                                          method="POST" 
                                                          class="inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="text-red-600 hover:text-red-800 p-1"
                                                                title="Eliminar curs"
                                                                onclick="return confirm('Estàs segur que vols eliminar aquest curs?')">
                                                            <svg class="w-5 h-5">
                                                                <use xlink:href="#course_delete_icon"></use>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            
                                            @if ($course->status === 'active')
                                                <span class="text-green-600 text-sm pl-2 inline-block">
                                                    ● Actiu
                                                </span>
                                            @else
                                                <span class="text-red-600 text-sm pl-2 inline-block">
                                                    ● Inactiu
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </aside>
                    
                    <section id="course-detail" class="w-3/4 p-6">
                        <div id="detail-content" class="hidden">
                            <!-- Contenido dinámico se cargará aquí -->
                        </div>
                        
                        <div id="no-course-selected" class="flex flex-col items-center justify-center h-full text-gray-500">
                            <svg class="w-24 h-24 mb-4 text-gray-300">
                                <use xlink:href="#course_icon"></use>
                            </svg>
                            <h2 class="text-2xl font-semibold mb-2">Selecciona un curs</h2>
                            <p class="text-lg">Fes clic en un curs de la llista per veure'n els detalls.</p>
                        </div>
                    </section>
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