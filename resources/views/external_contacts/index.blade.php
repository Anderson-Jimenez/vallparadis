<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Contactes Externs</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/contacts.js'])
</head>

<body class="min-h-screen flex flex-col bg-body">
    @include('partials.icons')
    @auth
        @include('components.navbar')

        <main class="flex w-full">
            @include('components.sidebar') 

            <section id="principal-content" class="flex flex-col items-center w-full flex-1 overflow-y-auto min-h-0">
                    <div class="w-full bg-white flex items-center justify-between py-4 px-[5%] shadow-sm">
                        <div>
                            <h1 class="text-[#2D3E50] text-4xl pb-1">Gestió de Contactes Externs</h1>
                            <p class="text-[#2d3e50b7] text-lg pl-2">Gestió de dades de contactes externs</p>
                        </div>
                        
                        <a href="{{ route('external_contacts.create') }}"
                        class="flex items-center text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                                    transition-all duration-300 rounded-xl px-5 py-3 text-center font-medium">
                            + Nuevo Tema
                        </a>
                    </div>
                
                <div class="w-11/12 mt-8 bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-[#2D3E50] flex items-center">
                            <svg class="w-6 h-6 mr-3 text-[#ff7300]">
                                <use xlink:href="#search_loupe"></use>
                            </svg>
                            Cerca i Filtra Contactes
                        </h2>
                        <p class="text-gray-600 ml-9">Troba ràpidament els contactes que necessites</p>
                    </div>
                    
                    <form method="GET" action="{{ route('external_contacts.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="relative">
                            <label class="text-sm font-semibold text-[#2D3E50] mb-2">Cerca contactes</label>
                            <div class="relative">
                                <input type="search" id="search_input" name="text" value="{{ request('text') }}" placeholder="Nom, empresa, correu..." 
                                    class="w-full bg-white border-2 border-gray-200 rounded-xl px-4 py-3 pl-12 focus:border-[#ff7300] focus:ring-2 focus:ring-orange-200 transition-all duration-300 shadow-sm">
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-[#ff7300]">
                                    <use xlink:href="#search_loupe"></use>
                                </svg>
                            </div>
                        </div>
                        
                        <div>
                            <label for="type_filter" class="text-sm font-semibold text-[#2D3E50] mb-2">Tipus de servei</label>
                            <div class="relative">
                                <select name="type" id="type_filter" 
                                        class="w-full bg-white border-2 border-gray-200 rounded-xl px-4 py-3 pr-10 appearance-none focus:border-[#ff7300] focus:ring-2 focus:ring-orange-200 transition-all duration-300 shadow-sm">
                                    <option value="">Tots els tipus</option>
                                    <option value="assistencials" {{ request('type') == 'assistencials' ? 'selected' : '' }}>Assistencials</option>
                                    <option value="serveis generals" {{ request('type') == 'serveis generals' ? 'selected' : '' }}>Serveis Generals</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-[#ff7300]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Filtro origen -->
                        <div>
                            <label for="origin_filter" class="block text-sm font-semibold text-[#2D3E50] mb-2">Origen</label>
                            <div class="relative">
                                <select name="origin_type" id="origin_filter" 
                                        class="w-full bg-white border-2 border-gray-200 rounded-xl px-4 py-3 pr-10 appearance-none focus:border-[#ff7300] focus:ring-2 focus:ring-orange-200 transition-all duration-300 shadow-sm">
                                    <option value="">Tots els orígens</option>
                                    <option value="company" {{ request('origin_type') == 'company' ? 'selected' : '' }}>Empresa</option>
                                    <option value="department" {{ request('origin_type') == 'department' ? 'selected' : '' }}>Departament</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-[#ff7300]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-end space-x-3">
                            <button type="submit" 
                                    class="text-sm sidebar-gradient text-white px-8 py-3 rounded-lg hover:bg-orange-600 transition-all duration-300 font-semibold shadow-md hover:shadow-lg">
                                Aplicar Filtres
                            </button>
                            <a href="{{ route('external_contacts.index') }}" 
                               class="text-sm bg-gray-300 text-gray-700 px-4 py-3 rounded-xl hover:bg-gray-400 
                                      transition-all duration-300 font-semibold shadow-md hover:shadow-lg">
                                Netejar
                            </a>
                        </div>
                    </form>
                </div>

                @if(request()->anyFilled(['text', 'type', 'origin_type']))
                <div class="w-full mt-6">
                    <div class="bg-linear-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 p-4 rounded-xl shadow-sm">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-blue-500 mr-3">
                                    <use xlink:href="#info_icon"></use>
                                </svg>
                                <div>
                                    <p class="font-semibold text-blue-800">
                                        Filtres aplicats: 
                                        <span class="font-normal text-blue-700">
                                            @if(request('type'))
                                                {{ request('type') == 'assistencials' ? 'ASSISTENCIALS' : 'SERVEIS GENERALS' }}
                                            @endif
                                            @if(request('origin_type'))
                                                | {{ request('origin_type') == 'company' ? 'EMPRESA' : 'DEPARTAMENT' }}
                                            @endif
                                            @if(request('text'))
                                                | Cerca: "{{ request('text') }}"
                                            @endif
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full">
                                {{ $external_contacts->total() }} resultats
                            </span>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="w-11/12 mt-8 bg-linear-to-br from-white to-gray-50 p-6 rounded-2xl shadow-xl border border-gray-100 mb-10">
                    @if($external_contacts->count() > 0)
                        <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-linear-to-r from-[#2D3E50] to-[#3A506B]">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2">
                                                    <use xlink:href="#user_icon"></use>
                                                </svg>
                                                Contacte
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2">
                                                    <use xlink:href="#type_icon"></use>
                                                </svg>
                                                Tipus
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2">
                                                    <use xlink:href="#service_icon"></use>
                                                </svg>
                                                Servei
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2">
                                                    <use xlink:href="#organization_icon"></use>
                                                </svg>
                                                Organització
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2">
                                                    <use xlink:href="#link_icon"></use>
                                                </svg>
                                                Responsable
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2">
                                                    <use xlink:href="#phone_icon"></use>
                                                </svg>
                                                Contacte
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2">
                                                    <use xlink:href="#notes_icon"></use>
                                                </svg>
                                                Observacions
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2">
                                                    <use xlink:href="#actions_icon"></use>
                                                </svg>
                                                Accions
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    @foreach ($external_contacts as $external_contact)
                                    <tr class="hover:bg-linear-to-r hover:from-orange-50 hover:to-orange-25 transition-all duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="shrink-0 h-10 w-10 bg-linear-to-br from-orange-100 to-orange-200 rounded-xl flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-[#ff7300]">
                                                        <use xlink:href="#professional_icon"></use>
                                                    </svg>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-semibold text-gray-900">{{ $external_contact->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $external_contact->email_address }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $external_contact->type == 'assistencials' ? 'bg-linear-to-r from-blue-100 to-blue-200 text-blue-800' : 'bg-linear-to-r from-green-100 to-green-200 text-green-800' }}">
                                                {{ $external_contact->type == 'assistencials' ? 'ASSISTENCIAL' : 'SERVEI GENERAL' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-medium">
                                            {{ $external_contact->purpose_type ?? 'No especificat' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex flex-col space-y-1">
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                                    {{ $external_contact->origin_type == 'company' ? 'bg-linear-to-r from-purple-100 to-purple-200 text-purple-800' : 'bg-linear-to-r from-yellow-100 to-yellow-200 text-yellow-800' }}">
                                                    {{ $external_contact->origin_type == 'company' ? 'EMPRESA' : 'DEPARTAMENT' }}
                                                </span>
                                                <span class="text-sm text-gray-700">{{ $external_contact->organization }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $external_contact->manager ?? 'No especificat' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="space-y-1">
                                                <div class="flex items-center text-sm text-gray-700">
                                                    <svg class="w-4 h-4 mr-2 text-green-600">
                                                        <use xlink:href="#phone_icon"></use>
                                                    </svg>
                                                    <a href="tel:{{ $external_contact->phone_numer }}" 
                                                       class="hover:text-green-800 hover:underline transition-colors">
                                                        {{ $external_contact->phone_numer }}
                                                    </a>
                                                </div>
                                                <div class="flex items-center text-sm text-gray-700">
                                                    <svg class="w-4 h-4 mr-2 text-blue-600">
                                                        <use xlink:href="#email_icon"></use>
                                                    </svg>
                                                    <a href="mailto:{{ $external_contact->email_address }}" 
                                                       class="hover:text-blue-800 hover:underline transition-colors truncate max-w-xs">
                                                        {{ $external_contact->email_address }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-700 max-w-xs">
                                                <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
                                                    {{ $external_contact->observations ?? 'Sense observacions' }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('external_contacts.edit', $external_contact->id) }}" 
                                                   class="bg-linear-to-r from-blue-50 to-blue-100 text-blue-600 hover:from-blue-100 hover:to-blue-200 
                                                          p-2 rounded-lg hover:text-blue-800 transition-all duration-300 shadow-sm hover:shadow">
                                                    <svg class="w-5 h-5">
                                                        <use xlink:href="#edit_icon"></use>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('external_contacts.destroy', $external_contact->id) }}" 
                                                      method="POST" 
                                                      class="inline"
                                                      onsubmit="return confirm('Estàs segur que vols eliminar aquest contacte?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="bg-linear-to-r from-red-50 to-red-100 text-red-600 hover:from-red-100 hover:to-red-200 
                                                                   p-2 rounded-lg hover:text-red-800 transition-all duration-300 shadow-sm hover:shadow">
                                                        <svg class="w-5 h-5">
                                                            <use xlink:href="#delete_icon"></use>
                                                        </svg>
                                                    </button>
                                                </form>
                                                <a href="#" 
                                                   class="bg-linear-to-r from-gray-50 to-gray-100 text-gray-600 hover:from-gray-100 hover:to-gray-200 
                                                          p-2 rounded-lg hover:text-gray-800 transition-all duration-300 shadow-sm hover:shadow">
                                                    <svg class="w-5 h-5">
                                                        <use xlink:href="#view_icon"></use>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                    @else
                        <div class="text-center py-16">
                            <div class="mx-auto w-24 h-24 bg-linear-to-r from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-6">
                                <svg class="w-12 h-12 text-gray-400">
                                    <use xlink:href="#no_results_icon"></use>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-700 mb-3">No s'han trobat contactes</h3>
                            <p class="text-gray-500 mb-8 max-w-md mx-auto">No hi ha contactes que coincideixin amb els filtres aplicats. Prova a canviar els criteris de cerca o a afegir un nou contacte.</p>
                            <a href="{{ route('external_contacts.create') }}" 
                               class="inline-flex items-center text-white bg-linear-to-r from-[#ff7300] to-[#ff9500] hover:from-[#e56700] hover:to-[#ff8500] 
                                      transition-all duration-300 rounded-xl px-6 py-3 text-center font-semibold shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2">
                                    <use xlink:href="#add_prof_icon"></use>
                                </svg>
                                Afegir Nou Contacte
                            </a>
                        </div>
                    @endif
                </div>
            </section>
        </main>
    @endauth

    @guest
        <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#2D3E50] to-[#1C2B3A]">
            <div class="text-center bg-white/10 backdrop-blur-lg p-12 rounded-2xl border border-white/20 shadow-2xl">
                <h1 class="text-4xl font-bold text-white mb-6">No has iniciat sessió</h1>
                <p class="text-gray-200 mb-8 text-lg">Redirigint al login...</p>
                <div class="w-24 h-1 bg-gradient-to-r from-[#ff7300] to-[#ff9500] rounded-full mx-auto animate-pulse"></div>
            </div>
        </div>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>