<nav class="w-screen flex items-center justify-between p-4 bg-white border-b-15 border-[#ff7300]">
    <img src="{{ asset('img/logo.png') }}" alt="logo_vallparadis" class="w-[15vw]">
    <div>
            <ul class="flex items-center mr-13">
            <li class="m-3 txt-orange text-2xl">
                    "barra de busqueda"
            </li>
            <li class="m-3 txt-orange text-2xl">Hola <strong>{{ Auth::user()->name }}</strong>👋</li>
        </ul>
    </div>
</nav>