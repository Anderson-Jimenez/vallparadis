<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestió Serveis Generals</title>
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

                {{-- Header --}}
                <div class="flex items-center mb-8 bg-white py-4 px-10 w-full">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Gestió Serveis Generals</h1>
                        <p class="text-gray-600 mt-2">Administració i modificació de serveis generals</p>
                    </div>
                </div>

                <div class="flex gap-6 mb-8 w-11/12 justify-center">
                    <div class="flex-1 min-w-[200px] bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Serveis</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">
                                    {{ $services->count() }}
                                </p>
                            </div>
                            <div class="p-3 bg-blue-50 rounded-lg">
                                <svg class="w-8 h-8 text-blue-500">
                                    <use xlink:href="#service_icon"></use>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 min-w-[200px] bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Actius</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">
                                    {{ $services->where('status', 'active')->count() }}
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
                                    {{ $services->where('status', 'inactive')->count() }}
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
                                        <use xlink:href="#services_icon"></use>
                                    </svg>
                                    <h2 class="text-xl font-bold text-white">Serveis</h2>
                                </div>
                                <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $services->count() }} Elements
                                </span>
                            </div>
                        </div>

                        <div class="p-6 max-h-[500px] overflow-y-auto">
                            @if($services->isEmpty())
                                <div class="flex flex-col items-center justify-center py-12">
                                    <svg class="w-16 h-16 text-gray-300 mb-4">
                                        <use xlink:href="#service_icon"></use>
                                    </svg>
                                    <p class="text-gray-500 text-lg mb-2">No hi ha serveis generals</p>
                                    <a href="{{ route('general_service.create') }}"
                                       class="text-orange-500 hover:text-orange-600 font-medium">
                                        Crear servei
                                    </a>
                                </div>
                            @else
                                <div class="space-y-4">
                                    @foreach ($services as $service)
                                        <div class="group bg-gray-50 hover:bg-orange-50 border border-gray-200 rounded-xl p-5 transition-all duration-300 hover:border-orange-300 hover:shadow-md flex justify-between items-start">
                                            <div class="flex-1">
                                                <div class="flex items-center mb-3">
                                                    <svg class="w-6 h-6 text-orange-500 mr-3 shrink-0">
                                                        <use xlink:href="#evaluations_icon"></use>
                                                    </svg>
                                                    <h3 class="text-lg font-semibold text-gray-800 group-hover:text-orange-700">
                                                        {{ $service->type }}
                                                    </h3>
                                                </div>

                                                <div class="flex flex-wrap gap-4 mb-3">
                                                    @if($service->manager)
                                                        <div class="flex items-center">
                                                            <svg class="w-4 h-4 text-gray-400 mr-2 shrink-0">
                                                                <use xlink:href="#user_icon"></use>
                                                            </svg>
                                                            <span class="text-sm text-gray-600">
                                                                {{ $service->manager }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                    <div class="flex items-center">
                                                        @if($service->status === 'active')
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

                                                @if($service->staff)
                                                    <div class="flex items-start mb-2">
                                                        <svg class="w-4 h-4 text-gray-400 mt-1 mr-2 shrink-0">
                                                            <use xlink:href="#staff_icon"></use>
                                                        </svg>
                                                        <p class="text-gray-600 text-sm line-clamp-2">
                                                            {{ $service->staff }}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if($service->schedule)
                                                    <div class="flex items-start">
                                                        <svg class="w-4 h-4 text-gray-400 mt-1 mr-2 shrink-0">
                                                            <use xlink:href="#schedule_icon"></use>
                                                        </svg>
                                                        <p class="text-gray-600 text-sm line-clamp-2">
                                                            {{ $service->schedule }}
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="ml-4 flex items-start">
                                                <a href="{{ route('general_service.edit', $service) }}" 
                                                   class="flex items-center justify-center w-10 h-10 text-gray-400 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-all duration-300"
                                                   title="Editar servei">
                                                    <svg class="w-7 h-7">
                                                        <use xlink:href="#edit_icon"></use>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
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
