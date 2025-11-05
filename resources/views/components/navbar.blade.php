<nav class="w-screen flex items-center justify-between p-4 bg-white border-b-8 border-[#ff7300]">
    <a href="{{route('principal')}}"><img src="{{ asset('img/logo.png') }}" alt="logo_vallparadis" class="w-[13vw]"></a>
    <div>
            <ul class="flex items-center mr-13">
            <li class="m-3 txt-orange text-lg">
                    "barra de busqueda"
            </li>
            <li class="m-3 txt-orange text-lg">Hola <strong>{{ Auth::user()->name }}</strong>👋</li>
        </ul>
    </div>
</nav>