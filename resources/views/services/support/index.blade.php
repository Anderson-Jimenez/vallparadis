<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestió Serveis Complementaris</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

                <div class="flex items-center mb-8 bg-white py-4 px-10 w-full">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Gestió Serveis Complementaris</h1>
                        <p class="text-gray-600 mt-2">Administració i seguiment de serveis complementaris</p>
                    </div>
                    <div class="ml-auto">
                        <a href="{{ route('supplementary_service.create') }}"
                           class="flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5">
                                <use xlink:href="#add_prof_icon"></use>
                            </svg>
                            Afegir servei complementari
                        </a>
                    </div>
                </div>

                <div class="flex gap-6 mb-8 w-11/12 justify-center">
                    <div class="flex-1 min-w-[200px] bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Serveis</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">
                                    {{ $supp_services->count() }}
                                </p>
                            </div>
                            <div class="p-3 bg-orange-50 rounded-lg">
                                <svg class="w-8 h-8 text-orange-500">
                                    <use xlink:href="#services_icon"></use>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 min-w-[200px] bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Aquest mes</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">
                                    {{ $supp_services->filter(function($service) {
                                        return $service->start_date && 
                                               strtotime($service->start_date) >= strtotime(date('Y-m-01'));
                                    })->count() }}
                                </p>
                            </div>
                            <div class="p-3 bg-blue-50 rounded-lg">
                                <svg class="w-8 h-8 text-blue-500">
                                    <use xlink:href="#calendar_icon"></use>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 min-w-[200px] bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Amb contacte</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">
                                    {{ $supp_services->filter(function($service) {
                                        return $service->email_address || $service->phone_number;
                                    })->count() }}
                                </p>
                            </div>
                            <div class="p-3 bg-green-50 rounded-lg">
                                <svg class="w-8 h-8 text-green-500">
                                    <use xlink:href="#contact_icon"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row gap-8 w-11/12">
                    <div class="flex-1 bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="bg-linear-to-r from-orange-500 to-[#FEAB51] px-6 py-5">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="w-7 h-7 text-white mr-3">
                                        <use xlink:href="#supplementary_services_icon"></use>
                                    </svg>
                                    <h2 class="text-xl font-bold text-white">Llistat de Serveis Complementaris</h2>
                                </div>
                                <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $supp_services->count() }} Elements
                                </span>
                            </div>
                        </div>

                        <div class="p-6 max-h-[500px] overflow-y-auto">
                            @if($supp_services->isEmpty())
                                <div class="flex flex-col items-center justify-center py-12">
                                    <svg class="w-16 h-16 text-gray-300 mb-4">
                                        <use xlink:href="#service_icon"></use>
                                    </svg>
                                    <p class="text-gray-500 text-lg mb-2">No hi ha serveis complementaris</p>
                                    <a href="{{ route('supplementary_service.create') }}"
                                       class="text-orange-500 hover:text-orange-600 font-medium">
                                        Afegir el primer servei
                                    </a>
                                </div>
                            @else
                                <div class="space-y-4">
                                    @foreach ($supp_services as $service)
                                        <div class="group bg-gray-50 hover:bg-orange-50 border border-gray-200 rounded-xl p-5 transition-all duration-300 hover:border-orange-300 hover:shadow-md">
                                            <div class="flex justify-between items-start">
                                                <div class="flex-1">
                                                    <div class="flex items-center mb-3">
                                                        <svg class="w-6 h-6 text-orange-500 mr-3 shrink-0">
                                                            <use xlink:href="#evaluations_icon"></use>
                                                        </svg>
                                                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-orange-700">
                                                            {{ $service->type }}
                                                        </h3>
                                                    </div>

                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                                        @if($service->start_date)
                                                            <div class="flex items-center">
                                                                <svg class="w-4 h-4 text-gray-400 mr-2 shrink-0">
                                                                    <use xlink:href="#calendar_icon"></use>
                                                                </svg>
                                                                <span class="text-sm text-gray-600">
                                                                    <span class="font-medium">Inici:</span> 
                                                                    {{ date('d/m/Y', strtotime($service->start_date)) }}
                                                                </span>
                                                            </div>
                                                        @endif
                                                        
                                                        @if($service->manager)
                                                            <div class="flex items-center">
                                                                <svg class="w-4 h-4 text-gray-400 mr-2 shrink-0">
                                                                    <use xlink:href="#professionals_icon"></use>
                                                                </svg>
                                                                <span class="text-sm text-gray-600">
                                                                    <span class="font-medium">Responsable:</span> {{ $service->manager }}
                                                                </span>
                                                            </div>
                                                        @endif

                                                        @if($service->email_address)
                                                            <div class="flex items-center">
                                                                <svg class="w-4 h-4 text-gray-400 mr-2 shrink-0">
                                                                    <use xlink:href="#email_icon"></use>
                                                                </svg>
                                                                <span class="text-sm text-gray-600">
                                                                    {{ $service->email_address }}
                                                                </span>
                                                            </div>
                                                        @endif

                                                        @if($service->phone_number)
                                                            <div class="flex items-center">
                                                                <svg class="w-4 h-4 text-gray-400 mr-2 shrink-0">
                                                                    <use xlink:href="#phone_icon"></use>
                                                                </svg>
                                                                <span class="text-sm text-gray-600">
                                                                    {{ $service->phone_number }}
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    @if($service->comments)
                                                        <div class="flex items-start mb-2">
                                                            <svg class="w-4 h-4 text-gray-400 mt-1 mr-2 shrink-0">
                                                                <use xlink:href="#comment_icon"></use>
                                                            </svg>
                                                            <p class="text-gray-600 text-sm line-clamp-2">
                                                                {{ $service->comments }}
                                                            </p>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="flex flex-col gap-2 ml-4">
                                                    <button class="view-service-btn flex items-center justify-center gap-2 bg-blue-50 hover:bg-blue-100 text-blue-600 font-medium py-2 px-4 rounded-lg transition-all duration-300 min-w-[140px]"
                                                            data-type="{{ $service->type }}"
                                                            data-start_date="{{ $service->start_date }}"
                                                            data-manager="{{ $service->manager }}"
                                                            data-email_address="{{ $service->email_address }}"
                                                            data-phone_number="{{ $service->phone_number }}"
                                                            data-comments="{{ $service->comments }}">
                                                        <svg class="w-4 h-4">
                                                            <use xlink:href="#see_evaluations"></use>
                                                        </svg>
                                                        Veure detalls
                                                    </button>

                                                    <button class="edit-service-btn flex items-center justify-center gap-2 bg-orange-50 hover:bg-orange-100 text-orange-600 font-medium py-2 px-4 rounded-lg transition-all duration-300 min-w-[140px]"
                                                            data-id="{{ $service->id }}"
                                                            data-type="{{ $service->type }}"
                                                            data-start_date="{{ $service->start_date }}"
                                                            data-manager="{{ $service->manager }}"
                                                            data-email_address="{{ $service->email_address }}"
                                                            data-phone_number="{{ $service->phone_number }}"
                                                            data-comments="{{ $service->comments }}">
                                                        <svg class="w-4 h-4">
                                                            <use xlink:href="#edit_icon"></use>
                                                        </svg>
                                                        Editar servei
                                                    </button>

                                                    <a href="{{ route('supplementary_service_followup.index', $service) }}"
                                                       class="flex items-center justify-center gap-2 sidebar-gradient hover:opacity-90 text-white font-medium py-2 px-4 rounded-lg transition-all duration-300 min-w-[140px]">
                                                        <svg class="w-4 h-4">
                                                            <use xlink:href="#evaluations_icon"></use>
                                                        </svg>
                                                        Fer seguiment
                                                    </a>
                                                </div>
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
        <div id="viewServiceModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-hidden">
                <div class="bg-linear-to-r from-orange-500 to-[#FEAB51] px-6 py-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-white mr-3">
                                <use xlink:href="#services_icon"></use>
                            </svg>
                            <h2 class="text-xl font-bold text-white">Detalls del Servei</h2>
                        </div>
                        <button id="closeViewModal" class="text-white hover:text-gray-200 transition-colors">
                            <svg class="w-6 h-6">
                                <use xlink:href="#close_icon"></use>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="p-6 overflow-y-auto max-h-[calc(90vh-80px)]">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Nom del servei</label>
                            <div class="bg-gray-50 rounded-xl p-4">
                                <p id="modalViewType" class="text-gray-800 font-medium">—</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Data d'inici</label>
                                <div class="bg-gray-50 rounded-xl p-4">
                                    <p id="modalViewStartDate" class="text-gray-800">—</p>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Responsable</label>
                                <div class="bg-gray-50 rounded-xl p-4">
                                    <p id="modalViewManager" class="text-gray-800">—</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Email de contacte</label>
                                <div class="bg-gray-50 rounded-xl p-4">
                                    <p id="modalViewEmail" class="text-gray-800">—</p>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Telèfon</label>
                                <div class="bg-gray-50 rounded-xl p-4">
                                    <p id="modalViewPhone" class="text-gray-800">—</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Comentaris</label>
                            <div class="bg-gray-50 rounded-xl p-4 min-h-[100px]">
                                <p id="modalViewComments" class="text-gray-800 whitespace-pre-wrap">—</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal per editar servei --}}
        <div id="editServiceModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden">
                <form id="editServiceForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="bg-linear-to-r from-orange-500 to-[#FEAB51] px-6 py-5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-white mr-3">
                                    <use xlink:href="#edit_icon"></use>
                                </svg>
                                <h2 class="text-xl font-bold text-white">Editar Servei</h2>
                            </div>
                            <button id="closeEditModal" type="button" class="text-white hover:text-gray-200 transition-colors">
                                <svg class="w-6 h-6">
                                    <use xlink:href="#close_icon"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <div class="p-6 overflow-y-auto max-h-[calc(90vh-80px)]">
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Nom del servei *</label>
                                <input type="text" name="type" id="editType" required
                                       class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 focus:outline-none transition-all">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-2">Data d'inici</label>
                                    <input type="date" name="start_date" id="editStartDate"
                                           class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 focus:outline-none transition-all">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-2">Responsable</label>
                                    <input type="text" name="manager" id="editManager"
                                           class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 focus:outline-none transition-all">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-2">Email de contacte</label>
                                    <input type="email" name="email_address" id="editEmail"
                                           class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 focus:outline-none transition-all">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-2">Telèfon</label>
                                    <input type="tel" name="phone_number" id="editPhone"
                                           class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 focus:outline-none transition-all">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Comentaris</label>
                                <textarea name="comments" id="editComments" rows="4"
                                          class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 focus:outline-none transition-all resize-none"></textarea>
                            </div>

                            <div class="flex justify-end gap-3 pt-4">
                                <button type="button" id="cancelEditModal"
                                        class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition-all duration-300">
                                    Cancel·lar
                                </button>
                                <button type="submit"
                                        class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-medium rounded-xl transition-all duration-300 shadow-md hover:shadow-lg">
                                    Guardar canvis
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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