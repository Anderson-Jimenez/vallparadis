<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Temas Pendientes RRHH</title>
    @vite("resources/css/app.css")
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
                <section class="flex flex-col items-center w-4/5 flex-1 overflow-hidden min-h-0">
                    <div class="w-full bg-white flex items-center justify-between py-4 px-[5%] shadow-sm">
                        <div>
                            <h1 class="text-[#2D3E50] text-4xl pb-1">Temes Pendents amb RRHH</h1>
                            <p class="text-[#2d3e50b7] text-lg pl-2">Gestió d'assumptes i seguiments de Recursos Humans</p>
                        </div>
                        
                        <a href="{{ route('hr_pending_issue.create') }}"
                        class="flex items-center text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                                    transition-all duration-300 rounded-xl px-5 py-3 text-center font-medium">
                            + Nuevo Tema
                        </a>
                    </div>

                    <div class="w-11/12 my-6 flex items-center justify-between p-4 bg-white rounded-lg shadow-sm">
                        <div class="relative w-3/4">
                            <input type="search" 
                                id="search_rrhh"
                                name="text"
                                placeholder="Cercar per professional o descripció..." 
                                class="bg-white border border-gray-300 rounded-lg px-4 py-3 w-full h-12 shadow-sm focus:border-[#ff7300] focus:ring-1 focus:ring-[#ff7300] focus:outline-none">
                            <svg class="absolute right-4 top-3 w-6 h-6 text-gray-400">
                                <use xlink:href="#search_loupe"></use>
                            </svg>
                        </div>
                        <select class="bg-white border border-gray-300 rounded-lg px-4 py-3 shadow-sm focus:border-[#ff7300] focus:outline-none">
                            <option>Tots els estats</option>
                            <option>En process</option>
                            <option>Urgent</option>
                            <option>Finalitzat</option>
                        </select>
                        
                    </div>
                                        
                    <!-- Lista de temas -->
                    <div class="w-11/12 flex flex-col space-y-6 mb-10 overflow-y-auto flex-1 min-h-0">
                        @foreach($hr_pending_issues as $issue)
                            <div class="bg-white rounded-xl shadow-md border border-gray-300 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                <!-- Estado -->
                                <div class="px-6 pt-4 flex justify-between border border-[#f0f0f0] bg-gray-50">
                                    <div class="mb-4">
                                        <h3 class="text-xl font-semibold text-gray-900 mb-1">
                                            {{ $issue->context }}
                                        </h3>
                                        <div class="flex items-center text-gray-600 text-sm">
                                            <span class="font-medium">Data Obertura:</span>
                                            <span class="ml-2">{{ $issue->opened_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                    
                                    @if($issue->status == 'urgent')
                                        <span class=" px-3 py-2 bg-red-100 text-red-800 rounded-2xl text-sm font-medium flex items-center h-max">
                                            Urgent
                                        </span>
                                    @elseif($issue->status == 'in_process')
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-2xl text-sm font-medium flex items-center h-max">
                                            En process
                                        </span>
                                    @elseif($issue->status == 'completed')
                                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-2xl text-sm font-medium flex items-center h-max">
                                            Finalitzat
                                        </span>
                                    @else
                                        <span class="px-3 bg-orange-100 text-orange-800 rounded-2xl text-sm font-medium inline items-center h-max">
                                            Pendent
                                        </span>
                                    @endif
                                </div>
                        
                                <div class="p-6">
                                    <!-- Professionals implicats -->
                                    <div class="flex items-center mb-4 space-x-6 justify-start gap-20">
                                        <div>
                                            <span class="font-medium text-gray-700">Registrat per</span>
                                            <div class="flex mt-1 items-center">
                                                <svg class="w-6 h-6 text-gray-500 mr-2">
                                                    <use xlink:href="#professional_icon"></use>
                                                </svg>
                                                <span class="text-gray-500 text-sm flex items-center">
                                                    {{ $issue->registered_by_professional->name }}
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">Professional Afectat</span>
                                            <div class="flex items-center mt-1">
                                                <svg class="w-5 h-5 text-gray-500 mr-2">
                                                    <use xlink:href="#professional_icon"></use>
                                                </svg>
                                                <span class="text-gray-500 text-sm flex items-center">
                                                    {{ $issue->affected_professional->name }}
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">Derivat a</span>
                                            <div class="flex mt-1 items-center">
                                                <svg class="w-6 h-6 text-gray-500 mr-2">
                                                    <use xlink:href="#professional_icon"></use>
                                                </svg>
                                                <span class="text-gray-500 text-sm flex items-center">
                                                    {{ $issue->derived_to_professional?->name ?? 'No derivat' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Descripción -->
                                    <div class="flex"></div>
                                    <div class="mb-6">
                                        <h4 class="font-medium text-gray-700 mb-2">Descripció</h4>
                                        <p class="text-gray-600 line-clamp-2">
                                            {{ $issue->description }}
                                        </p>
                                    </div>
                                    <hr class="text-gray-300">
                                    <!-- Documentos -->
                                    <div class="flex items-center justify-between mt-3">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-gray-400 mr-2">
                                                <use xlink:href="#attached_icon"></use>
                                            </svg>
                                            <span class="text-gray-600 text-sm flex items-center">
                                                {{ $issue->documents->count() }} document(s) adjunt(s)
                                            </span>
                                        </div>
                                        
                                        <!-- Accions -->
                                        <div class="flex space-x-3">
                                            <a href="{{ route('hr_pending_issue.index', $issue) }}" 
                                               class="text-[#ff7300] hover:text-orange-700 font-medium text-sm px-4 py-2 rounded-lg border border-[#ff7300] hover:bg-orange-50 transition-colors duration-200">
                                               Veure detalls
                                            </a>
                                            <a href="{{ route('hr_pending_issue.index', $issue) }}" 
                                               class="text-gray-700 hover:text-gray-900 font-medium text-sm px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                                Editar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                        @if($hr_pending_issues->isEmpty())
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4">
                                    <use xlink:href="#folder_icon"></use>
                                </svg>
                                <h3 class="text-xl font-medium text-gray-900 mb-2">No hay temas pendientes</h3>
                                <p class="text-gray-600 mb-6">Comienza creando un nuevo tema pendiente</p>
                                <a href="{{ route('hr_pending_issue.index') }}" 
                                   class="inline-flex items-center text-white bg-[#ff7300] hover:bg-orange-700 rounded-lg px-5 py-3 font-medium">
                                    + Crear primer tema
                                </a>
                            </div>
                        @endif
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