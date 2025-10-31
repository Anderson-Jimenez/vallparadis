<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Curs</title>
    @vite("resources/css/app.css")

</head>
<body class="min-h-screen flex flex-col ">
    @include('partials.icons')     
    @auth
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
        @include('components.navbar')
        <main class="flex-grow flex w-full">
            @include('components.aside')
            @yield('contingut')
                <section class="flex flex-col items-center w-4/5">
                    <h1 class="txt-orange text-2xl w-10/12 text-center p-10 border-b-6 border-[#ff7300]">Gestió Cursos</h1>
                
                    <table class="border-solid w-[60vw] m-15">
                        <tr class="table-row">
                            <th class="p-4 text-sm txt-orange hover:bg-[#b4b4b459] transition duration-300">CODI FORCEM</th>
                            <th class="p-4 text-sm txt-orange hover:bg-[#b4b4b459] transition duration-300">HORES</th>
                            <th class="p-4 text-sm txt-orange hover:bg-[#b4b4b459] transition duration-300">TIPUS</th>
                            <th class="p-4 text-sm txt-orange hover:bg-[#b4b4b459] transition duration-300">PRESENCIAL / ON LINE</th>
                            <th class="p-4 text-sm txt-orange hover:bg-[#b4b4b459] transition duration-300">NOM FORMACIÓ / TALLER / JORNADA / CONGRÉS</th>
                        </tr>

                        @foreach ($courses as $course)
                            <tr class="table-row">
                                <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition duration-300">{{ $course->code_forcem }}</td>
                                <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition duration-300">{{ $course->hours }}</td>
                                <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition duration-300">{{ $course->type }}</td>
                                <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition duration-300">{{ $course->mode }}</td>
                                <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition duration-300">{{ $course->training_name }}</td>
                                <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition duration-300">
                                    <form action="{{ route('course.activate', $course) }}">
                                        @csrf
                                        <button>{{ $course->status }}</button>
                                    </form>
                                </td>
                                <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition duration-300"><a href="{{route('course.edit', $course)}}">Modificar</a></td>
                                <td class="p-4 text-sm hover:bg-[#42131359] hover:text-[#ff7300] transition duration-300">
                                    <form action="{{ route('course.destroy', $course) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button>Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    <a href="{{route('course.create')}}" class="text-sm text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300] transition-all duration-300 rounded-3xl p-4" >
                        afegir curs
                    </a>
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