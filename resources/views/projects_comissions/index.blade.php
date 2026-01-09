<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Projectes/Comissions</title>
    @vite("resources/css/app.css")

</head>
<body class="min-h-screen flex flex-col bg-[#E9EDF2]">
    @include('partials.icons')     
    @auth
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
        @include('components.navbar')
        <main class="grow flex w-full flex-1">
            @yield('contingut')
            @include('components.sidebar')
            <section class="flex flex-col items-center w-full">
                <h1 class="text-[#2D3E50] text-4xl pt-7 pb-1 w-11/12 border-b-4 border-[#213c57] mb-10">Gestió Projectes i Comissions</h1>                 
                
                <div class="flex w-11/12">
                    <section class="comissions w-2/4 h-[50vh] border border-[#ff7300] rounded-2xl flex flex-col items-center mr-5 bg-[#fef2e6]">
                        
                        <div class="w-11/12 flex items-center justify-between my-4">
                            <h2 class="txt-orange text-2xl py-5 w-2/4">Gestió de comissions</h2>
                            <a href="{{route('project_comission.create')}}"
                                class="flex items-center text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                                transition-all duration-300 rounded-xl px-5 py-2 text-center h-3/4">
                                <svg class="w-6 h-6 mr-2">
                                    <use xlink:href="#add_prof_icon"></use>
                                </svg>
                                Afegir Projecte/Comissió
                            </a>
                        </div>
                        
                        @foreach ($projects_comissions as $project_comission)
                            @if ($project_comission->type=="Comissió")
                                <div class="comission-info w-11/12 bg-white flex rounded-3xl p-5 my-3 border border-[#FF7400]
                                        justify-between shadow-md hover:scale-102 transition-all duration-400">
                                    <div id="{{$project_comission->id}}" class="comission flex items-center cursor-pointer">
                                        <svg class="w-8 h-8 txt-orange mr-3">
                                            <use xlink:href="#evaluations_icon"></use>
                                        </svg>
                                        <p class="txt-orange text-lg">
                                            {{ $project_comission->name }}
                                        </p>
                                    </div>
                                    <a href="{{route('project_comission.edit', $project_comission)}}" title="Editar dades">
                                        <svg class="w-10 h-10 txt-orange mr-3">
                                            <use xlink:href="#edit_icon"></use>
                                        </svg>                                            
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </section>
                    <section class="projects w-2/4 h-[50vh] border border-[#ff7300] ml-5 rounded-2xl flex flex-col items-center bg-[#fef2e6] overflow-auto">
                        <div class="w-11/12 flex items-center justify-between my-4">
                            <h2 class="txt-orange text-2xl py-5 w-2/4">Gestió de Projectes</h2>
                            <a href="{{route('project_comission.create')}}"
                                class="flex items-center text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300]
                                transition-all duration-300 rounded-xl px-5 py-2 text-center h-3/4">
                                <svg class="w-6 h-6 mr-2">
                                    <use xlink:href="#add_prof_icon"></use>
                                </svg>
                                Afegir Projecte/Comissió
                            </a>
                        </div>
                        @foreach ($projects_comissions as $project_comission)
                            @if ($project_comission->type=="Projecte")
                                <div class="comission-info w-11/12 bg-white flex rounded-3xl p-5 my-3 border border-[#FF7400]
                                        justify-between shadow-md hover:scale-102 transition-all duration-400">
                                    <div id="{{$project_comission->id}}" class="comission flex items-center cursor-pointer">
                                        <svg class="w-8 h-8 txt-orange mr-3">
                                            <use xlink:href="#evaluations_icon"></use>
                                        </svg>
                                        <p class="txt-orange text-lg">
                                            {{ $project_comission->name }}
                                        </p>
                                    </div>
                                    <a href="{{route('project_comission.edit', $project_comission)}}" title="Editar dades">
                                        <svg class="w-10 h-10 txt-orange mr-3">
                                            <use xlink:href="#edit_icon"></use>
                                        </svg>                                            
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </section>
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