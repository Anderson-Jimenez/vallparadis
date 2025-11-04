<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Curs</title>
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
        <main class="grow flex w-full">
            @include('components.aside')
            @yield('contingut')
                <section class="flex flex-col items-center w-4/5">
                    <h1 class="txt-orange text-2xl w-10/12 text-center p-10 border-b-6 border-[#ff7300]">Gestió Cursos</h1>
                        <div class="w-5/6 h-full flex flex-wrap">
                            @foreach ($courses as $course)
                                <a href="{{route('course.assign_professional', $course)}}" class="w-[22.3%] h-3/12 mt-8 m-4 flex items-center justify-center bg-courses rounded-2xl">
                                    
                                    <h1 class="text-white text-center">{{$course->training_name}}</h1>
                                    
                                </a>
                                
                            @endforeach
                        </div>
                        
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