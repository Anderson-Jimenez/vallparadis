<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Contactes Externs</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-[#E9EDF2]">
    @include('partials.icons')
    @auth
        @include('components.navbar')

        <main class="flex w-full flex-1">
            @include('components.sidebar')
            
            <section id="principal-content" class="w-full flex flex-col items-center">
                <div class="w-11/12 border-b-4 border-[#213c57] flex items-center justify-between py-4">
                    <h1 class="text-[#2D3E50] text-4xl pt-7 pb-1 w-4/5">Gestió de Contactes Externs</h1>
                </div>
                
                <div class="flex space-x-3 w-11/12 items-center justify-between mt-4">
                    <div class="flex justify-around items-center space-x-4">
                        <!-- Formulario único para todos los filtros -->
                        <form method="GET" action="{{ route('external_contacts.index') }}" class="flex space-x-4 items-center">
                            <!-- Campo de búsqueda -->
                            <div class="relative flex items-center">
                                <input type="search" 
                                    id="search_input"
                                    name="text"
                                    placeholder="Cercar contactes del centre..." 
                                    class="bg-white border border-[#ff7300] rounded-lg px-3 py-1 w-[17vw] h-[5vh]"
                                    >
                                <svg class="relative w-6 h-6 txt-orange right-10">
                                    <use xlink:href="#search_loupe"></use>
                                </svg>
                            </div>
                            
                            <!-- Filtro purpose_type -->
                            <div>
                                <select name="type" id="type_filter" class="rounded-lg px-3 py-1 h-[5vh] bg-white border border-[#ff7300] txt-orange">
                                    <option value="">Tipus de servei</option>
                                    <option value="assistencials" {{ request('type') == 'assistencials' ? 'selected' : '' }}>Assistencials</option>
                                    <option value="serveis generals" {{ request('type') == 'serveis generals' ? 'selected' : '' }}>Serveis Generals</option>
                                </select>
                            </div>
                            
                            <!-- Filtro origin_type -->
                            <div>
                                <select name="origin_type"  id="origin_filter" class="rounded-lg px-4 py-1 h-[5vh] bg-white border border-[#ff7300] txt-orange">
                                    <option value="">Tots els orígens</option>
                                    <option value="company" {{ request('origin_type') == 'company' ? 'selected' : '' }}>Companya</option>
                                    <option value="department" {{ request('origin_type') == 'department' ? 'selected' : '' }}>Department</option>
                                </select>
                            </div>
                            
                            <!-- Botones de acción -->
                            <div class="flex space-x-2">
                                <button type="submit" class="bg-[#ff7300] text-white px-6 py-1 rounded hover:bg-[#e56700] h-[5vh]">
                                    Filtrar
                                </button>
                                <a href="{{ route('external_contacts.index') }}" class="h-[5vh] bg-gray-300 text-gray-700 px-6 py-1 rounded hover:bg-gray-400 flex items-center">
                                    Netejar
                                </a>
                                <a href="{{ route('external_contacts.create') }}" class="flex-end h-[5vh] bg-[#ff7300] text-white px-6 py-1 rounded-xl hover:bg-white hover:text-[#ff7300] flex items-center">
                                    <svg class="w-6 h-6 mr-2">
                                        <use xlink:href="#add_prof_icon"></use>
                                    </svg>
                                    Afegir nou contacte
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Listado de contactos -->
                <div class="w-11/12 flex items-center flex-col mt-8 bg-[#fef2e6] p-10 rounded-xl overflow-auto h-[60vh]" id="search_results">
                    @if($external_contacts->count() > 0)
                        @foreach ($external_contacts as $external_contact)
                            <div class="contact-info bg-white w-full px-5 mb-3 shadow flex justify-between items-center h-[10vh] rounded-xl">
                                    <div class="flex items-center w-1/6">
                                        <svg class="w-10 h-10 txt-orange mr-3">
                                            <use xlink:href="#professional_icon"></use>
                                        </svg>
                                        <h2 class="font-bold text-sm ">{{ $external_contact->name }}</h2>
                                    </div>
                                    <h3 class="w-3/12 text-sm"><strong>Organització: </strong>{{ $external_contact->organization }}</h3>
                                    <h3 class="w-[30%] text-sm"><strong>Correu electrònic: </strong><a target="_BLANK" href="mailto:{{ $external_contact->email_address }}" class="underline">{{ $external_contact->email_address }} </a></h3>
                                    <h3 class="w-1/6 text-sm"><strong>Telefòn: </strong>{{ $external_contact->phone_numer }}</h3>

                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">No s'han trobat contactes amb els filtres aplicats.</p>
                        </div>
                    @endif
                </div>
            </section>
        </main>
    @endauth

    @guest
        <h1>No has iniciat sessió.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>