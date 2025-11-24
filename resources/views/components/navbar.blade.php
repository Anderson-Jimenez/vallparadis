<nav class="w-screen flex items-center justify-between px-4 bg-white border-b-8 border-[#ff7300]">
    <a href="{{route('principal')}}"><img src="{{ asset('img/logo.png') }}" alt="logo_vallparadis" class="w-[13vw]"></a>
    <div class=" bg-white py-6 flex flex-col justify-center">
        <div class="flex items-center justify-center">
            <div class="dropdown">
                <span class="rounded-md shadow-sm">
                    <button class="flex justify-center items-center w-full px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800" 
                    type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">
                        <span class="txt-orange">Hola <strong>{{Auth::user()->name}}</strong>👋</span>
                        <svg class="w-7 h-7 txt-orange mr-3">
                            <use xlink:href="#dropdown_arrow"></use>
                        </svg>
                    </button>
                </span>
                <div class="hidden dropdown-menu">
                <div class="z-50 absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none" aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                    <div class="py-1">
                        <a href="{{route('principal')}}" class="txt-orange flex w-full items-center px-4 py-2 text-sm leading-5 text-left"  role="menuitem">
                            <svg class="w-6 h-6 txt-orange m-1">
                                <use xlink:href="#settings_icon"></use>
                            </svg>
                            Account settings</a>
                    </div>
                    <div class="py-1">
                        <a href="{{ route('logout') }}" class="txt-orange flex w-full items-center px-4 py-2 text-sm leading-5 text-left"  role="menuitem" >
                            <svg class="w-6 h-6 txt-orange m-1">
                                <use xlink:href="#log_out_icon"></use>
                            </svg>
                            Tancar Sessió</a>
                    </div>
                </div>
                </div>
            </div>
        </div>              
    </div>  
    <style>
        .dropdown:focus-within .dropdown-menu {
        /* @apply block; */
        display:block;
        }
    </style>
</nav>