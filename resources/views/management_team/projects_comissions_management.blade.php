<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Projectes/Comissions</title>
    @vite("resources/css/app.css")

</head>
<body class="min-h-screen flex flex-col bg-[#2D3E50]">
    @include('partials.icons')     
    @auth
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
        @include('components.navbar')
        @yield('contingut')
        <main class="flex-grow flex flex-col items-center w-full py-10">
            <h1 class="text-white text-2xl w-10/12 text-center p-10 border-b-6 border-[#ff7300]">Gestió Projectes i Comissions</h1>

            <table class="border-solid w-[60vw] m-15">
                <tr class="table-row">
                    <th class="p-4 text-sm txt-orange hover:bg-[#b4b4b459] transition duration-300">Responsable</th>
                    <th class="p-4 text-sm txt-orange hover:bg-[#b4b4b459] transition duration-300">Nom</th>
                    <th class="p-4 text-sm txt-orange hover:bg-[#b4b4b459] transition duration-300">Data d'inici</th>
                    <th class="p-4 text-sm txt-orange hover:bg-[#b4b4b459] transition duration-300">Tipus</th>
                </tr>

                @foreach ($projects_comissions as $project_comission)
                    <tr class="table-row">
                        <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition duration-300">{{ $project_comission->manager->name }}</td>
                        <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition duration-300">{{ $project_comission->name }}</td>
                        <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition duration-300">{{ $project_comission->start_date }}</td>
                        <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition duration-300">{{ $project_comission->type }}</td>
                        <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition duration-300">
                            <form action="{{ route('project_comission.activate', $project_comission) }}">
                                @csrf
                                <button>{{ $project_comission->status }}</button>
                            </form>
                        </td>
                        <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition duration-300"><a href="{{route('project_comission.edit', $project_comission)}}">Modificar</a></td>
                        <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition duration-300">
                            <form action="{{ route('project_comission.destroy', $project_comission) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button>Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            
            </table>
            <a href="{{route('project_comission.create')}}" class="text-lg text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300] transition-all duration-300 rounded-full p-8">Afegir Projectes/Comissions</a>
        </main>
        @include('components.footer')
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>