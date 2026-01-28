<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/documents_center.js'])
</head>
<body class="min-h-screen flex flex-col bg-body">
    @include('partials.icons')     
    @auth
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
        @include('components.navbar')
        <main class="grow flex w-full">
            @include('components.sidebar')
            @yield('contingut')
                <section class="flex flex-col items-center w-full">
                    <div class="w-full bg-white flex items-center justify-between py-4 px-[5%]">
                        <div class="">
                            <h1 class="text-[#2D3E50] text-3xl pb-1 w-full font-bold">Gestió d'Accidentabilitat</h1>
                            <p class="text-[#2D3E50]">Control i seguiment d'accidents laborals</p>
                        </div>
                        
                    </div>
                                        
                    <div class="w-11/12 bg-white flex flex-col mt-10 rounded-lg">
                        <div class="bg-orange-500 text-white px-6 py-3 rounded-t-lg">
                            <h1 class="text-3xl pb-1 w-full font-bold">Accidents de treball de </h1>
                            <p>Registre</p>
                        </div>
                        
                        <form action="{{ route('maintenance.store') }}" method="POST" enctype="multipart/form-data" class="bg-[#FEF2F2] rounded-lg mx-5 my-7 px-6 py-8 ">
                            @csrf
                            
                            <p class="font-semibold">Nova entrada</p>
                            <div class="flex gap-5">
                                <div class="w-1/2">
                                    <p>Data d'inici de la baixa *</p>
                                    <input type="date" name="start_date" value="{{ old('start_date', date('Y-m-d')) }}" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 bg-white">
                                </div>
                                <div class="w-1/2">
                                    <p>Professional que Emplena</p>
                                    <input type="text" name="registred_professional_id" disabled value="{{Auth::user()->name}}" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 bg-white">
                                </div>
                            </div>
                            <div class="flex gap-5 my-5">
                                <div class="w-1/2">
                                    <p>Data final de la baixa (opcional)</p>
                                    <input type="date" name="end_date" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 bg-white">
                                </div>
                                <div class="w-1/2">
                                    <p>Incidencia</p>
                                    <input type="text" name="issue" placeholder="Escriu el motiu de la incidencia..." value="{{old('issue')}}" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 bg-white">
                                </div>
                                
                                
                            </div>
                            
                            <p >Incidencia</p>
                            <textarea placeholder="Descriu que ha pasat..." name="description" class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 bg-white"></textarea>
                            <div class="flex mt-5 gap-3 justify-end">
                                <input type="reset" value="Cancel·lar" class="px-6 py-3 bg-[#E5E7EB] rounded-lg">
                                <input type="submit" value="Guardar" class="text-white px-6 py-3 bg-linear-to-r from-orange-500 to-[#FEAB51] rounded-lg">
                            </div>
                        </form>
                        
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