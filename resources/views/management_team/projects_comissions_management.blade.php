<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Projectes/Comissions</title>
    @vite("resources/css/app.css")

</head>
<body class="min-h-screen flex flex-col">
    @include('partials.icons')     
    @auth
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
        @include('components.navbar')
        <main class="flex-grow flex w-full flex-1">
            @yield('contingut')
            @include('components.sidebar')
            <section class="flex flex-col items-center w-full">
                <h1 class="text-[#213c57] text-2xl w-11/12 py-6  border-b-6 border-[#213c57] mb-10">Gestió Projectes i Comissions</h1>                 
                <div class="flex w-11/12">
                    <section class="comissions w-2/4 h-[50vh] border border-[#ff7300] rounded-2xl flex flex-col items-center mr-5">
                        <h2 class="txt-orange text-2xl p-5">Gestió de comissions</h2>
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
                <section class="projects w-2/4 h-[50vh] border border-[#ff7300] ml-5 rounded-2xl flex flex-col items-center">
                    <h2 class="txt-orange text-2xl p-5">Gestió de projectes</h2>
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
               
                
                            <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition duration-300">
                            <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition duration-300">

                            </td>
                        </tr>

                
                </table>
                <a href="{{route('project_comission.create')}}" class="text-lg text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300] transition-all duration-300 rounded-full p-8">Afegir Projectes/Comissions</a>
            </section>
        </main>
        @include('components.footer')
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>