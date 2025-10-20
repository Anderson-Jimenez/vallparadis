<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Centre</title>
    @vite("resources/css/app.css")

</head>
<body class="min-h-screen flex flex-col bg-[#2D3E50]">
    @include('partials.icons')     
    @auth
        @include('components.navbar')
        @yield('contingut')
            <main class="flex-grow flex flex-col items-center w-full py-10">

                <h1 class="text-white text-3xl w-10/12 text-center p-10 border-b-6 border-[#ff7300]">Gestió Centre</h1>
                
                <table class=" border-solid w-[80vw] m-15">
                    <tr class="table-row">
                        <th class="p-4 text-sm txt-orange hover:bg-[#b4b4b459] transition-all duration-300">Nom</th>
                        <th class="p-4 text-sm txt-orange hover:bg-[#b4b4b459] transition-all duration-300">Ubicació</th>
                        <th class="p-4 text-sm txt-orange hover:bg-[#b4b4b459] transition-all duration-300">Teléfon</th>
                        <th class="p-4 text-sm txt-orange hover:bg-[#b4b4b459] transition-all duration-300">Email</th>
                    </tr>

                    @foreach ($centers as $center)
                        <tr class="table-row">
                            <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition-all duration-300">{{ $center->center_name }}</td>
                            <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition-all duration-300">{{ $center->location }}</td>
                            <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition-all duration-300">{{ $center->phone_number }}</td>
                            <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition-all duration-300">{{ $center->email_address }}</td>
                            <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition-all duration-300"><a href="">Modificar</a></td>
                            <td class="p-4 text-sm hover:bg-[#b4b4b459] hover:text-[#ff7300] transition-all duration-300"><a href="">Eliminar</a></td>
                        </tr>
                    @endforeach
                
                </table>

                <a class="text-lg text-white bg-[#ff7300] hover:bg-white hover:text-[#ff7300] transition-all duration-300 rounded-full p-8">
                Afegir Centre
                </a>
            </main>
            
        @include('components.footer')
    @endauth

    @guest
        <h1>No has iniciado sesión.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>