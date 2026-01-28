<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Projectes i Comissions</title>
    @vite("resources/css/app.css")
</head>
<body class="min-h-screen flex flex-col bg-body">
    @include('partials.icons')     
    @auth
        @if ($errors->any())
            <div class="fixed top-20 right-4 z-50">
                @foreach ($errors->all() as $error)
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-2 rounded-lg shadow-lg">
                        <p>{{ $error }}</p>
                    </div>
                @endforeach
            </div>
        @endif
        
        @include('components.navbar')
        
        <main class="grow flex w-full">
            @include('components.sidebar')

            <div class="flex flex-col w-full items-center">
                <div class="flex items-center justify-between mb-8 bg-white py-4 px-10 w-full">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Gestió Projectes i Comissions</h1>
                        <p class="text-gray-600 mt-2">Administració i modificació de projectes i comissions</p>
                    </div>
                    <a href="{{route('project_comission.create')}}" 
                       class="flex items-center px-6 py-3 bg-linear-to-r from-orange-500 to-orange-600 text-white font-medium rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2">
                            <use xlink:href="#add_icon"></use>
                        </svg>
                        Afegir Projecte/Comissió
                    </a>
                </div>
                <div class="flex gap-6 mb-8 w-11/12 justify-center">
                    <div class="flex-1 min-w-[200px] bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Projectes</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">
                                    {{ $projects_comissions->where('type', 'Projecte')->count() }}
                                </p>
                            </div>
                            <div class="p-3 bg-blue-50 rounded-lg">
                                <svg class="w-8 h-8 text-blue-500">
                                    <use xlink:href="#project_icon"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 min-w-[200px] bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Comissions</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">
                                    {{ $projects_comissions->where('type', 'Comissió')->count() }}
                                </p>
                            </div>
                            <div class="p-3 bg-orange-50 rounded-lg">
                                <svg class="w-8 h-8 text-orange-500">
                                    <use xlink:href="#professionals_icon"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex-1 min-w-[200px] bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Actius</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">
                                    {{ $projects_comissions->where('status', 'active')->count() }}
                                </p>
                            </div>
                            <div class="p-3 bg-green-50 rounded-lg">
                                <svg class="w-8 h-8 text-green-500">
                                    <use xlink:href="#check_icon"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex-1 min-w-[200px] bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Inactius</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">
                                    {{ $projects_comissions->where('status', 'inactive')->count() }}
                                </p>
                            </div>
                            <div class="p-3 bg-red-50 rounded-lg">
                                <svg class="w-8 h-8 text-red-500">
                                    <use xlink:href="#x_icon"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row gap-8 w-11/12">
                    <div class="flex-1 bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">

                        <div class="bg-linear-to-r from-orange-500 to-orange-600 px-6 py-5">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="w-7 h-7 text-white mr-3">
                                        <use xlink:href="#users_icon"></use>
                                    </svg>
                                    <h2 class="text-xl font-bold text-white">Comissions</h2>
                                </div>
                                <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $projects_comissions->where('type', 'Comissió')->count() }} Elements
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6 max-h-[500px] overflow-y-auto custom-scrollbar">
                            @php
                                $commissions = $projects_comissions->where('type', 'Comissió');
                            @endphp
                            
                            @if($commissions->isEmpty())
                                <div class="flex flex-col items-center justify-center py-12">
                                    <svg class="w-16 h-16 text-gray-300 mb-4">
                                        <use xlink:href="#users_icon"></use>
                                    </svg>
                                    <p class="text-gray-500 text-lg mb-2">No hi ha comissions</p>
                                    <a href="{{route('project_comission.create')}}" 
                                       class="text-orange-500 hover:text-orange-600 font-medium">
                                        Crear comissió
                                    </a>
                                </div>
                            @else
                                <div class="space-y-4">
                                    @foreach ($commissions as $project_comission)
                                        <a href="{{ route('project_comission.show', $project_comission) }}">
                                            <div class="group bg-gray-50 hover:bg-orange-50 border border-gray-200 rounded-xl p-5 transition-all duration-300 hover:border-orange-300 hover:shadow-md">
                                                <div class="flex items-start justify-between">
                                                    <div class="flex-1">
                                                        <div class="flex items-center mb-3">
                                                            <svg class="w-6 h-6 text-orange-500 mr-3 shrink-0">
                                                                <use xlink:href="#evaluations_icon"></use>
                                                            </svg>
                                                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-orange-700">
                                                                {{ $project_comission->name }}
                                                            </h3>
                                                        </div>
                                                        
                                                        <div class="flex flex-wrap gap-4 mb-3">
                                                            @if($project_comission->start_date)
                                                                <div class="flex items-center">
                                                                    <svg class="w-4 h-4 text-gray-400 mr-2 shrink-0">
                                                                        <use xlink:href="#calendar_icon"></use>
                                                                    </svg>
                                                                    <span class="text-sm text-gray-600">
                                                                        {{ date('d/m/Y', strtotime($project_comission->start_date)) }}
                                                                    </span>
                                                                </div>
                                                            @endif
                                                            
                                                            <div class="flex items-center">
                                                                @if($project_comission->status === 'active')
                                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                        Actiu
                                                                    </span>
                                                                @else
                                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                                        Inactiu
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                        @if($project_comission->description)
                                                            <div class="flex items-start">
                                                                <svg class="w-4 h-4 text-gray-400 mt-1 mr-2 shrink-0">
                                                                    <use xlink:href="#document_icon"></use>
                                                                </svg>
                                                                <p class="text-gray-600 text-sm line-clamp-2">
                                                                    {{ $project_comission->description }}
                                                                </p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    
                                                    <div class="ml-4 flex items-start">
                                                        <a href="{{route('project_comission.edit', $project_comission)}}" 
                                                        class="flex items-center justify-center w-10 h-10 text-gray-400 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-all duration-300"
                                                        title="Editar comissió">
                                                            <svg class="w-7 h-7">
                                                                <use xlink:href="#edit_icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="bg-linear-to-r from-blue-500 to-blue-600 px-6 py-5">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="w-7 h-7 text-white mr-3">
                                        <use xlink:href="#folder_icon"></use>
                                    </svg>
                                    <h2 class="text-xl font-bold text-white">Projectes</h2>
                                </div>
                                <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $projects_comissions->where('type', 'Projecte')->count() }} Elements
                                </span>
                            </div>
                        </div>
        
                        <div class="p-6 max-h-[500px] overflow-y-auto">
                            @php
                                $projects = $projects_comissions->where('type', 'Projecte');
                            @endphp
                            
                            @if($projects->isEmpty())
                                <div class="flex flex-col items-center justify-center py-12">
                                    <svg class="w-16 h-16 text-gray-300 mb-4">
                                        <use xlink:href="#project_icon"></use>
                                    </svg>
                                    <p class="text-gray-500 text-lg mb-2">No hi ha projectes</p>
                                    <a href="{{route('project_comission.create')}}" 
                                       class="text-blue-500 hover:text-blue-600 font-medium">
                                        Crear projecte
                                    </a>
                                </div>
                            @else
                                <div class="space-y-4">
                                    @foreach ($projects as $project_comission)
                                        <a href="{{ route('project_comission.show', $project_comission) }}">
                                            <div class="group bg-gray-50 hover:bg-blue-50 border border-gray-200 rounded-xl p-5 transition-all duration-300 hover:border-blue-300 hover:shadow-md">
                                                <div class="flex items-start justify-between">
                                                    <div class="flex-1">
                                                        <div class="flex items-center mb-3">
                                                            <svg class="w-6 h-6 text-blue-500 mr-3 shrink-0">
                                                                <use xlink:href="#evaluations_icon"></use>
                                                            </svg>
                                                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-700">
                                                                {{ $project_comission->name }}
                                                            </h3>
                                                        </div>
                                                        
                                                        <div class="flex flex-wrap gap-4 mb-3">
                                                            @if($project_comission->start_date)
                                                                <div class="flex items-center">
                                                                    <svg class="w-4 h-4 text-gray-400 mr-2 shrink-0">
                                                                        <use xlink:href="#calendar_icon"></use>
                                                                    </svg>
                                                                    <span class="text-sm text-gray-600">
                                                                        {{ date('d/m/Y', strtotime($project_comission->start_date)) }}
                                                                    </span>
                                                                </div>
                                                            @endif
                                                            
                                                            <div class="flex items-center">
                                                                @if($project_comission->status === 'active')
                                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                        Actiu
                                                                    </span>
                                                                @else
                                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                                        Inactiu
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                        @if($project_comission->description)
                                                            <div class="flex items-start mb-2">
                                                                <svg class="w-4 h-4 text-gray-400 mt-1 mr-2 shrink-0">
                                                                    <use xlink:href="#document_icon"></use>
                                                                </svg>
                                                                <p class="text-gray-600 text-sm line-clamp-2">
                                                                    {{ $project_comission->description }}
                                                                </p>
                                                            </div>
                                                        @endif
                                                        
                                                        @if($project_comission->observation)
                                                            <div class="flex items-start">
                                                                <svg class="w-4 h-4 text-gray-400 mt-1 mr-2 shrink-0">
                                                                    <use xlink:href="#info_icon"></use>
                                                                </svg>
                                                                <p class="text-gray-500 text-sm line-clamp-2">
                                                                    {{ $project_comission->observation }}
                                                                </p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="ml-4 flex items-start">
                                                        <a href="{{route('project_comission.edit', $project_comission)}}" class="flex items-center justify-center w-10 h-10 text-gray-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-all duration-300"
                                                        title="Editar projecte">
                                                            <svg class="w-7 h-7">
                                                                <use xlink:href="#edit_icon"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-8 bg-white border border-gray-200 rounded-xl p-6 shadow-sm w-11/12 mb-10">
                    <div class="flex items-start">
                        <div class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-gray-500">
                                <use xlink:href="#info_icon"></use>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800 mb-2">Informació important</h4>
                            <p class="text-gray-600 text-sm">
                                Els projectes i comissions es gestionen des d'aquesta secció. Pots afegir nous elements fent clic al botó superior 
                                "Afegir Projecte/Comissió" i editar els existents amb l'icona d'edició de cada element.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @endauth

    @guest
        <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 p-6">
            <div class="text-center max-w-md">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">No has iniciat sessió</h1>
                <p class="text-gray-600 mb-6">Seràs redirigit automàticament a la pàgina d'inici de sessió</p>
                <div class="w-16 h-1 bg-gray-300 rounded-full mx-auto overflow-hidden">
                    <div class="h-full bg-orange-500 animate-pulse"></div>
                </div>
            </div>
            <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
        </div>
    @endguest
</body>
</html>