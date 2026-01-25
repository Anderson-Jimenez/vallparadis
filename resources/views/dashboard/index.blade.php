<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titol', 'Panell de control')</title>
    @vite("resources/css/app.css")
</head>

<body class="bg-[#E9EDF2]">
@include('partials.icons')

@auth
@include('components.navbar')

<main class="w-screen flex flex-1">
    @include('components.sidebar')

    <section class="w-full p-6 space-y-8">

        <!-- ================== CARDS SUPERIORES ================== -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <div class="bg-white rounded-3xl border border-[#ff7300] shadow-lg flex flex-col justify-center items-center h-[25vh]">
                <h1 class="txt-orange text-2xl font-semibold">Professionals Actius</h1>
                <p class="text-4xl font-bold mt-2">{{ $professionals_count }}</p>
            </div>

            <div class="bg-white rounded-3xl border border-[#ff7300] shadow-lg flex flex-col justify-center items-center h-[25vh]">
                <h1 class="txt-orange text-2xl font-semibold">Projectes en procés</h1>
                <p class="text-4xl font-bold mt-2">{{ $projects_count }}</p>
            </div>

            <div class="bg-white rounded-3xl border border-[#ff7300] shadow-lg flex flex-col justify-center items-center h-[25vh]">
                <h1 class="txt-orange text-2xl font-semibold">Cursos Actius</h1>
                <p class="text-4xl font-bold mt-2">{{ $courses_count }}</p>
            </div>

            <div class="bg-white rounded-3xl border border-[#ff7300] shadow-lg flex flex-col justify-center items-center h-[25vh]">
                <h1 class="txt-orange text-2xl font-semibold">Documents centre</h1>
                <p class="text-4xl font-bold mt-2">{{ $document_count }}</p>
            </div>
        </div>

        <!-- ================== ZONA INFERIOR ================== -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            <!-- ===== ACTIVITAT RECENT ===== -->
            <div class="xl:col-span-2 bg-white rounded-3xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Activitat recent</h2>
                    <a href="#" class="text-[#ff7300] text-sm hover:underline">
                        Veure tot
                    </a>
                </div>

                <!-- Contenido vacío -->
                @if ($recent_activity->isNotEmpty())
                    @foreach ($recent_activity as $item)
                        <div class="space-y-4 bg-amber-50 w-[40%]">
                            <p class="text-[#ff7300]">{{$item->type}}</p>
                            <p class=" text-gray-400 text-sm">{{$item->description}}</p>
                        </div>
                    @endforeach
                @else
                    <div class="space-y-4 text-gray-400 text-sm">
                        <p>No hi ha activitat recent encara.</p>
                    </div>
                @endif
                
            </div>

            <!-- ===== ACCIONS RÀPIDES ===== -->
            <div class="bg-white rounded-3xl shadow-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Accions ràpides</h2>

                <div class="flex flex-col gap-3">
                    <!-- Botones vacíos, tú pondrás los links -->
                    <button class="bg-[#ff7300] text-white py-3 rounded-xl hover:opacity-90">
                        Acció ràpida 1
                    </button>

                    <button class="border border-[#ff7300] text-[#ff7300] py-3 rounded-xl hover:bg-[#ff7300] hover:text-white">
                        Acció ràpida 2
                    </button>

                    <button class="border border-gray-300 text-gray-600 py-3 rounded-xl hover:bg-gray-100">
                        Acció ràpida 3
                    </button>
                </div>
            </div>

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
