<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titol', 'Panell de control')</title>
    @vite("resources/css/app.css")
</head>

<body class="bg-body min-h-screen flex flex-col">
@include('partials.icons')

@auth
@include('components.navbar')

<main class="w-screen flex flex-1">
    @include('components.sidebar')

    <section class="w-full p-6 space-y-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 w-full">

            <div class="bg-white rounded-2xl shadow-md border-l-4 border-orange-500 flex items-center justify-between p-6">
                <div>
                    <p class="text-gray-500 text-sm md:text-base">
                        Professionals Actius
                    </p>
                    <p class="text-3xl md:text-4xl font-bold text-gray-800 mt-4">
                        {{ $professionals_count }}
                    </p>
                </div>

                <div class="w-15 h-15 md:w-17 md:h-17 flex items-center justify-center rounded-full bg-orange-500 text-white shrink-0">
                    <svg class="w-9 h-9 md:w-10 md:h-10">
                        <use xlink:href="#professionals_icon"></use>
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md border-l-4 border-orange-500
                        flex items-center justify-between p-6">
                <div>
                    <p class="text-gray-500 text-sm md:text-base">
                        Projectes Actius
                    </p>
                    <p class="text-3xl md:text-4xl font-bold text-gray-800 my-4">
                        {{ $projects_count }}
                    </p>
                </div>

                <div class="w-15 h-15 md:w-17 md:h-17 flex items-center justify-center rounded-full bg-orange-500 text-white shrink-0">
                    <svg class="w-9 h-9 md:w-10 md:h-10">
                        <use xlink:href="#project_icon"></use>
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md border-l-4 border-orange-500
                        flex items-center justify-between p-6">
                <div>
                    <p class="text-gray-500 text-sm md:text-base">
                        Cursos Programats
                    </p>
                    <p class="text-3xl md:text-4xl font-bold text-gray-800 my-4">
                        {{ $courses_count }}
                    </p>
                </div>

                <div class="w-15 h-15 md:w-17 md:h-17
                            flex items-center justify-center
                            rounded-full bg-orange-500 text-white shrink-0">
                    <svg class="w-9 h-9 md:w-10 md:h-10">
                        <use xlink:href="#courses_icon"></use>
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md border-l-4 border-orange-500 flex items-center justify-between p-6">
                <div>
                    <p class="text-gray-500 text-sm md:text-base">
                        Documents Nous
                    </p>
                    <p class="text-3xl md:text-4xl font-bold text-gray-800 my-4">
                        {{ $document_count }}
                    </p>
                </div>
                <div class="w-15 h-15 md:w-17 md:h-17 flex items-center justify-center rounded-full bg-orange-500 text-white shrink-0">
                    <svg class="w-9 h-9 md:w-10 md:h-10">
                        <use xlink:href="#docs_icon"></use>
                    </svg>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            <div class="xl:col-span-2 bg-white rounded-3xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-6">Activitat Recent</h3>
                
                @if ($recent_activity->isNotEmpty())
                    <div class="space-y-4 overflow-auto h-[60vh]">
                        @foreach ($recent_activity as $item)
                            <div class="space-y-2 p-4 hover:bg-gray-50 rounded-lg transition duration-150">
                                <div class="flex items-center space-x-2">
                                    <span class="inline-block w-2 h-2 bg-[#ff7300] rounded-full"></span>
                                    <p class="text-[#ff7300] font-medium">{{ $item->type }}</p>
                                </div>
                                <p class="text-gray-600 text-sm pl-4">{{ $item->description }}</p>
                                @if($item->created_at)
                                    <p class="text-gray-400 text-xs pl-4">{{ $item->created_at->diffForHumans() }}</p>
                                @endif
                            </div>
                            @if(!$loop->last)
                                <hr class="border-gray-100">
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-400 text-sm">No hi ha activitat recent encara.</p>
                    </div>
                @endif
            </div>
            <div class="bg-white rounded-3xl shadow-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Accions ràpides</h2>
                <div class="flex flex-col gap-4">
                    <a href="{{ route('professional.create') }}" class="pl-3 flex items-center sidebar-gradient text-white p-4 rounded-xl hover:opacity-80 justify-center text-xl">
                        <svg class="w-6 h-6 md:w-7 md:h-7 mr-2">
                            <use xlink:href="#add_icon"></use>
                        </svg>
                        Afegir Professional
                    </a>
                    <a href="{{ route('project_comission.create') }}" class="pl-3 flex items-center border border-[#ff7300] text-[#ff7300] p-4 rounded-xl hover:bg-[#ff7300] hover:text-white justify-center text-xl">
                        <svg class="w-6 h-6 md:w-7 md:h-7 mr-2">
                            <use xlink:href="#add_project_icon"></use>
                        </svg>
                        Afegir Projecte/Commissio
                    </a>
                    <a href="{{ route('course.create') }}" class="pl-3 flex items-center border border-[#FEAB51] text-[#FEAB51] p-4 rounded-xl hover:bg-[#FEAB51] hover:text-white justify-center text-xl">
                        <svg class="w-6 h-6 md:w-7 md:h-7 mr-2">
                            <use xlink:href="#add_docs_icon"></use>
                        </svg>
                        Programar Curs
                    </a>
                    @if (auth()->user()->role_id == 1 )
                        <a href="{{ route('documents_center.index') }}" class="pl-3 flex items-center border border-gray-300 text-gray-600 p-4 rounded-xl hover:bg-gray-100 justify-center text-xl">
                            <svg class="w-6 h-6 md:w-7 md:h-7 mr-2">
                                <use xlink:href="#add_docs_icon"></use>
                            </svg>
                            Pujar Document
                        </a>
                    @endif
                    

                </div>
            </div>

        </div>

    </section>
</main>
@endauth

@guest
<h1>No has iniciado sesión.</h1>
<meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
@endguest

</body>
</html>
