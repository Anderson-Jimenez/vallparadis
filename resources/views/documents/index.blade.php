<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Documents Externs</title>
</head>
<body class="min-h-screen flex flex-col bg-[#E9EDF2]">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
    @include('components.navbar')
    <main class="flex w-full max-h-screen">
        @include('components.sidebar')
        @yield('contingut')
            <section class="flex flex-col items-center w-4/5 mt-5">
                <div class="w-11/12 border-b-4 border-[#213c57] flex items-center py-4">
                    <h1 class="text-[#2D3E50] text-4xl pt-7 pb-1 w-4/5">Gestió Professionals</h1>
                </div>

                <div class="flex">
                    <div class="w-1/2">
                        <div class="flex">
                            <svg class="bg-[#ff7300] rounded-full w-10 h-10 p-2 mr-3 text-white">
                                <use xlink:href="#cloud_icon"></use>
                            </svg>
                            <h2 class="text-[#2D3E50] text-2xl font-bold">Pujar un nou document</h2>
                        </div>
                        <input type="file" name="documents" id="internal-documents" class="my-4 w-4/5 h-[20vh]"/>
                    </div>
                    <div class="w-1/2">
                        <h2 class="text-[#2D3E50] text-2xl font-bold">Documents</h2>
                    </div>
                </div>


                
            </section>
    </main>


</body>
</html>