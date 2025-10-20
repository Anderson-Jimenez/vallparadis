<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Professionals</title>
    @vite("resources/css/app.css")

</head>

<body class="min-h-screen flex flex-col bg-[#2D3E50]">
    @include('partials.icons')
    @auth
        @include('components.navbar')
        @yield('contingut')
            <main class="flex-grow flex flex-col items-center w-full py-10">
                <h1 class="text-white text-3xl w-10/12 text-center p-10 border-b-6 border-[#ff7300]">Gestió Professionals</h1>
                <table class="border-solid w-[50vw] m-15">
                
                    <tr class="table-row">
                        <th class="p-4 text-sm txt-orange hover:bg-[#b4b4b459] transition duration-300">Nom</th>
                        <th class="p-4 text-sm txt-orange hover:bg-[#b4b4b459] transition duration-300">Cognoms</th>
                        <th class="p-4 text-sm txt-orange hover:bg-[#b4b4b459] transition duration-300">Estat</th>
                    </tr>

                    @foreach ($professionals as $professional)
                        
                        <tr class="table-row">
                            <td class="p-4 text-sm hover:bg-[#b4b4b459] transition duration-300">{{ $professional->name }}</td>
                            <td class="p-4 text-sm hover:bg-[#b4b4b459] transition duration-300">{{ $professional->surnames }}</td>
                            <td class="p-4 text-sm hover:bg-[#b4b4b459] transition duration-300">{{ $professional->link_status }}</td>
                            
                            <td class="p-4 text-sm hover:bg-[#b4b4b459] transition duration-300">
                                
                                <form action="{{ route('professional.activate', $professional) }}">
                                    @csrf
                                
                                    <button type="submit">{{ $professional->status }}</button>
                                </form>
                            </td>

                            <td class="p-4 text-sm hover:bg-[#b4b4b459] transition duration-300"><a href="{{route('professional.edit', $professional)}}">Modificar</a></td>

                            <td class="p-4 text-sm hover:bg-[#b4b4b459] transition duration-300">
                                <form action="{{ route('professional.destroy', $professional) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                
                </table>
                <a href="{{route('professional.create')}}" class="text-lg text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300] transition-all duration-300 rounded-full p-8">Afegir Professionals</a>
            </main>
            @include('components.footer')
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>