<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Professionals</title>
    @vite(['resources/css/app.css', 'resources/js/professional_info.js'])

</head>

<body class="h-screen bg-body flex flex-col overflow-hidden font-sans">
    @include('partials.icons')
    @auth
        @include('components.navbar')
        <main class="grow flex w-full overflow-hidden">
            @include('components.sidebar')
            @yield('contingut')
            <section class="w-full bg-[#fdf8f3] flex flex-col items-center ">
                
                <div class="bg-white p-6 flex items-center justify-between shadow-sm w-full">
                    <div>
                        <h1 class="text-[#2D3E50] text-3xl flex items-center gap-3">
                            Gestió de Professionals
                        </h1>
                    </div>
                    <div class="flex gap-5">
                        <a href="{{ route('professionals.exportar-locker') }}" class="group bg-white border border-orange-200 hover:border-[#ff7300] px-3 py-1.5 rounded-lg text-sm font-semibold text-gray-700 flex items-center gap-2 transition-all">
                            <div class="p-1 bg-orange-50 rounded group-hover:bg-[#ff7300] transition-colors">
                                <svg class="w-5 h-5 group-hover:text-white text-[#ff7300]"><use xlink:href="#icon-excel"></use></svg>
                            </div>
                            Exportar Guixetes
                        </a>
                        <a href="{{ route('professional.create') }}"
                        class="bg-[#ff7300] hover:bg-[#2D3E50] text-white px-5 py-2.5 rounded-xl transition-all duration-300 font-bold flex items-center gap-2 shadow-lg shadow-orange-200 active:scale-95">
                            <svg class="w-5 h-5"><use xlink:href="#add_prof_icon"></use></svg>
                            Afegir Nou
                        </a>
                    </div>
                </div>

                <div class="overflow-hidden flex-1 w-full p-8">
                    <div class="bg-white rounded-lg shadow-sm border border-orange-100 h-full flex flex-col overflow-hidden">
                        
                        <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between">
                            <h2 class="text-gray-500 font-bold text-xs uppercase tracking-widest">
                                Llistat de Professionals ({{ count($professionals) }})
                            </h2>
                            <div class="lg:col-span-4 flex flex-col gap-2 lg:items-end">
                                @if ($status == 'active')
                                    <a href="{{ route('professional.index', ['status' => 'inactive']) }}" class="bg-red-50 text-red-600 hover:bg-red-600 hover:text-white px-4 py-1.5 rounded-lg text-sm font-bold border border-red-100 transition-all flex items-center gap-2">
                                        <svg class="w-4 h-4"><use xlink:href="#see_evaluations"></use></svg>
                                        Veure Professionals Inactius
                                    </a>
                                @else
                                    <a href="{{ route('professional.index', ['status' => 'active']) }}" class="bg-green-50 text-green-600 hover:bg-green-600 hover:text-white px-4 py-1.5 rounded-lg text-sm font-bold border border-green-100 transition-all flex items-center gap-2">
                                        <svg class="w-4 h-4"><use xlink:href="#see_evaluations"></use></svg>
                                        Veure Professionals Actius
                                    </a>
                                @endif
                            </div>


                        </div>
                        <div class="flex-1 overflow-y-auto p-6 space-y-3 bg-[#f5f5f5] ">
                            @forelse ($professionals as $professional)
                                <div class="professional-info group bg-white border border-gray-100 hover:border-orange-300 rounded-2xl p-4 shadow-sm hover:shadow-md transition-all duration-200">
                                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                                        
                                        <div class="flex items-center gap-4 flex-1">
                                            <div class="w-12 h-12 rounded-xl bg-linear-to-br from-orange-400 to-[#ff7300] flex items-center justify-center text-white shadow-inner">
                                                <svg class="w-6 h-6"><use xlink:href="#professional_icon"></use></svg>
                                            </div>
                                            <div class="min-w-0">
                                                <h3 class="font-bold text-[#2D3E50] text-lg group-hover:text-[#ff7300] transition-colors truncate">
                                                    {{ $professional->name }} {{ $professional->surnames }}
                                                </h3>
                                                <div class="flex items-center gap-3 mt-0.5 text-xs">
                                                    <span class="font-bold {{ $professional->status == 'active' ? 'text-green-500' : 'text-gray-400' }}">
                                                        ● {{ $professional->status == 'active' ? 'Actiu' : 'Inactiu' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex flex-wrap items-center gap-2">
                                            <a href="{{ route('professional.show', $professional) }}" class="text-xs font-bold text-gray-400 hover:text-[#ff7300] px-3 py-2 transition-colors">
                                                Veure fitxa
                                            </a>

                                            <form action="{{ route('professional.activate', $professional) }}" method="GET">
                                                @csrf
                                                <button class="text-[11px] font-black uppercase px-4 py-2 rounded-xl transition-all
                                                    {{ $professional->status == 'inactive' 
                                                        ? 'bg-green-100 text-green-700 hover:bg-green-600 hover:text-white' 
                                                        : 'bg-red-50 text-red-600 hover:bg-red-600 hover:text-white' }}">
                                                    {{ $professional->status == 'inactive' ? 'Activar' : 'Desactivar' }}
                                                </button>
                                            </form>

                                            <div class="flex items-center bg-gray-100 rounded-xl p-1 gap-1">
                                                <el-dropdown>
                                                    <button class="bg-[#2D3E50] text-white px-4 py-1.5 rounded-lg text-xs font-bold flex items-center gap-2 hover:bg-[#ff7300] transition-all">
                                                        Opcions
                                                        <svg class="w-4 h-4"><use xlink:href="#dropdown_arrow"></use></svg>
                                                    </button>
                                                    <el-menu anchor="bottom end" class="w-56 bg-white shadow-2xl rounded-xl border border-orange-100 p-2">
                                                        <a href="{{ route('professionals.evaluations', $professional->id) }}" class="flex items-center p-2 text-sm text-gray-700 hover:bg-orange-50 rounded-lg"><svg class="w-4 h-4 mr-2 text-orange-400"><use xlink:href="#see_evaluations"></use></svg> Avaluacions</a>
                                                        <a href="{{ route('monitoring.monitorings', $professional->id) }}" class="flex items-center p-2 text-sm text-gray-700 hover:bg-orange-50 rounded-lg"><svg class="w-4 h-4 mr-2 text-orange-400"><use xlink:href="#evaluations_icon"></use></svg> Seguiments</a>
                                                        <a href="{{ route('professionals.accidents.index', $professional) }}" class="flex items-center p-2 text-sm text-gray-700 hover:bg-orange-50 rounded-lg"><svg class="w-4 h-4 mr-2 text-orange-400"><use xlink:href="#accident_icon"></use></svg> Accidentabilitat</a>
                                                        <a href="{{ route('professional.send_uniform', $professional) }}" class="flex items-center p-2 text-sm text-gray-700 hover:bg-orange-50 rounded-lg"><svg class="w-4 h-4 mr-2 text-orange-400"><use xlink:href="#uniform_icon"></use></svg> Uniforme</a>
                                                    </el-menu>
                                                </el-dropdown>

                                                <a href="{{ route('professional.edit', $professional) }}" class="p-1.5 text-gray-500 hover:text-[#ff7300] transition-colors" title="Editar">
                                                    <svg class="w-5 h-5"><use xlink:href="#edit_icon"></use></svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            @empty
                                <div class="h-full flex flex-col items-center justify-center text-gray-400 opacity-60">
                                    <svg class="w-16 h-16 mb-4"><use xlink:href="#professional_icon"></use></svg>
                                    <p class="font-bold">Cap professional trobat amb aquest filtre</p>
                                </div>
                            @endforelse
                        </div>

                        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 flex items-center justify-between text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                            <span class="text-[#ff7300]">Centre de Professionals</span>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    @endauth

    @guest
        <div class="h-screen flex flex-col items-center justify-center bg-[#FEF2E6]">
            <div class="w-16 h-16 border-4 border-[#ff7300] border-t-transparent rounded-full animate-spin mb-4"></div>
            <p class="text-gray-600 font-bold">Redirigint a l'accés...</p>
        </div>
        <meta http-equiv="refresh" content="1; URL={{ route('login') }}">
    @endguest
</body>
</html>