<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestió Professionals</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-[#E9EDF2]">
    @include('partials.icons')
    @auth
        @include('components.navbar')

        <main class="flex w-full">
            @yield('contingut')
            @include('components.aside')

            <section id="principal-content" class="w-4/5 flex items-center">
                <aside class="bg-white relative left-20 flex flex-col items-center justify-center w-1/4 text-center border-2 border-[#FF7400] h-[70%] rounded-2xl">
                    <svg class="w-40 h-40 txt-orange">
                        <use xlink:href="#professional_icon"></use>
                    </svg>
                    <h2 class="txt-orange text-3xl py-3">{{ $professional->name }} {{ $professional->surnames }}</h3>
                    <h3 class="text-[#2D3E50] text-xl my-2">{{ $professional->email_address }}</h3>
                    <h3 class="text-[#2D3E50] text-xl my-2">{{ $professional->address }}</h3>
                    <h3 class="text-[#2D3E50] text-xl my-2">{{ $professional->phone_number }}</h3>

                    @if ($professional->status != 'inactive')      
                        <button class="bg-[#DCFCE7] text-[#16A34A]
                                    rounded-full px-7 py-2 shadow-md hover:bg-[#BBF7D0]
                                    transition  my-2">
                            Actiu
                        </button>                 
                    @else                    
                        <button class="bg-[#FEE2E2] text-[#DC2626]
                                rounded-full px-7 py-2 shadow-md hover:bg-[#FECACA]
                                transition my-2">
                            Inactiu
                        </button>
                    @endif
                </aside>
                <div id="monitoring_section" class="bg-white w-3/5 relative m-10 left-20 rounded-2xl border-2 border-[#FF7400] items-center h-4/5">
                    <div class="w-full flex justify-end ">
                        <button id="add_monitoring_btn"
                            class="text-lg text-white bg-[#ff7300] hover:bg-[#ff73008a]
                            transition-all duration-300 rounded-2xl px-7 py-4 mt-5 mr-5">
                            + Nou seguiment
                    </button>
                    </div>

                </div>
                <div id="add_monitoring" class="hidden h-11/12 w-3/5 bg-white rounded-3xl shadow-black-500 shadow-2xl absolute left-[30%]">
                    <form action="{{ route('monitoring.store') }}" method="POST" class="m-10 flex flex-col w-5/12 p-10 ">
                        @csrf
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripció del seguiment</label>
                        <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
                    </form>



                    
                </div>
                
            </section>
        </main>

        @include('components.footer')
    @endauth

    @guest
        <h1>No has iniciat sessió.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>
