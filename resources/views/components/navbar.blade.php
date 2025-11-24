<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tu Título</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<nav class="w-screen flex items-center justify-between px-4 bg-white border-b-8 border-[#ff7300] h-[7vw]">
    <a href="{{route('principal')}}"><img src="{{ asset('img/logo.png') }}" alt="logo_vallparadis" class="w-[13vw]"></a>
    <el-dropdown class="inline-block">
        <button class="txt-orange flex items-center justify-center w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring-1  hover:bg-gray-50">
            Hola <strong>{{Auth::user()->name}}</strong>👋
            <svg class="w-7 h-7 txt-orange">
                <use xlink:href="#dropdown_arrow"></use>
            </svg>
        </button>
        <el-menu anchor="bottom end" popover class="w-56 origin-top-right rounded-md bg-white shadow-lg outline-1 outline-black/5 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
            <div class="py-1">
                <a href="{{route('principal')}}" class="flex txt-orange items-center px-4 py-4 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                    <svg class="w-6 h-6 txt-orange m-1">
                        <use xlink:href="#settings_icon"></use>
                    </svg>
                    Account settings</a>
                </a>
                <a href="{{ route('logout') }}" class="flex txt-orange items-center px-4 py-4 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                    <svg class="w-6 h-6 txt-orange mr-2">
                        <use xlink:href="#log_out_icon"></use>
                    </svg>
                    Tarcar sessió
                </a>
            </div>
        </el-menu>
    </el-dropdown>
</nav>