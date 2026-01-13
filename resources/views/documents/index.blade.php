<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Documents Externs</title>
    @vite(['resources/css/app.css', 'resources/js/documents_center.js'])
</head>
<body class="min-h-screen flex flex-col bg-[#E9EDF2]">

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
    @include('partials.icons')
    @auth
        @include('components.navbar')

        <main class="flex w-full flex-1">
            @include('components.sidebar')
            @yield('contingut')
                <section class="w-full flex flex-col items-center">
                    <div class="w-11/12 border-b-4 border-[#213c57] flex items-center py-4">
                        <h1 class="text-[#2D3E50] text-4xl pt-7 pb-1 w-4/5">Gestió Documents del Centre</h1>
                    </div>

                    <section class="flex justify-between items-center mt-8 w-11/12">
                        <aside class="w-1/2 bg-[#fef2e6] rounded-lg p-6 mr-4 flex flex-col items-center">

                            <form action="{{ route('documents_center.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="professional_id" value="{{ auth()->user()->professional_id ?? old('professional_id') }}">
                                <input type="hidden" name="center_id" value="{{ auth()->user()->professional->center_id ?? old('center_id') }}">

                                <div class="flex items-center w-11/12">
                                    <svg class="bg-[#ff7300] rounded-full w-12 h-12 p-2 mr-3 text-white">
                                        <use xlink:href="#cloud_icon"></use>
                                    </svg>
                                    <h2 class="text-[#2D3E50] text-2xl font-bold">Pujar un nou document</h2>
                                </div>

                                <!-- Sección per pujar arxius -->
                                <div class="flex items-center justify-center w-full bg-white my-5">
                                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-[25vh] bg-neutral-secondary-medium border-2 border-dashed border-[#ff7300] rounded-base cursor-pointer hover:bg-neutral-tertiary-medium">
                                        <div class="flex flex-col items-center justify-center text-body pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 txt-orange">
                                                <use xlink:href="#add_docs_icon"></use>
                                            </svg>
                                            <p class="mb-2 text-sm txt-orange">
                                                <span class="font-semibold">Click per pujar arxius</span> o arrossega i deixa anar
                                            </p>
                                            <p class="text-xs txt-orange">PDF, CSV, DOCX o DOC</p>
                                        </div>
                                        <input id="dropzone-file" type="file" class="hidden" name="files[]" multiple accept=".pdf,.csv,.docx,.doc" required />
                                    </label>
                                </div>

                                <!-- Contenidor per arxius seleccionats-->
                                <div id="selected-files" class="hidden mb-4 p-3 bg-gray-50 rounded-lg">
                                    <h3 class="text-lg font-semibold mb-2 text-[#2D3E50]">Arxius seleccionats:</h3>
                                    <ul id="file-list" class="space-y-2"></ul>
                                </div>

                                <div class="w-full flex flex-col md:flex-row justify-between gap-4">
                                    <div class="w-full md:w-2/5 flex flex-col">
                                        <label for="type" class="text-xl my-2 text-[#2D3E50]">Tipus de document</label>
                                        <select class="w-full bg-white border border-[#ff7300] rounded-lg p-2 focus:ring-2 focus:ring-[#ff7300] focus:border-transparent" required name="type" id="type">
                                            <option value="">Selecciona tipus de document</option>
                                            <option value="informe" {{ old('type') == 'informe' ? 'selected' : '' }}>Informe</option>
                                            <option value="contracte" {{ old('type') == 'contracte' ? 'selected' : '' }}>Contracte</option>
                                            <option value="altres" {{ old('type') == 'altres' ? 'selected' : '' }}>Altres</option>
                                        </select>
                                        @error('type')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="w-full md:w-2/5 flex flex-col">
                                        <label for="date" class="text-xl my-2 text-[#2D3E50]">Data del document</label>
                                        <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" id="date" class="w-full bg-white border border-[#ff7300] rounded-lg p-2 focus:ring-2 focus:ring-[#ff7300]" required />
                                        @error('date')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <label for="description" class="w-full text-xl my-4 text-[#2D3E50]">Descripció</label>
                                <textarea name="description" 
                                        id="description" 
                                        cols="30" 
                                        rows="5" 
                                        class="w-full bg-white border border-[#ff7300] rounded-lg p-2 focus:ring-2 focus:ring-[#ff7300] focus:border-transparent" 
                                        placeholder="Descripció del document..."
                                        required>{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                                
                                <button type="submit" class="cursor-pointer mt-6 w-full bg-[#ff7300] text-white rounded-lg p-3 font-semibold hover:bg-white hover:text-[#ff7300] border-2 border-[#ff7300] transition-all duration-300">
                                    Pujar document
                                </button>
                            </form>
                            



                        </aside>
                        <aside class="w-1/2 bg-[#fef2e6] rounded-lg p-6 mr-4 flex flex-col items-center">
                            <div class="flex items-center w-11/12 justify-between">
                                <div class="flex items-center">
                                    <svg class="bg-[#ff7300] rounded-full w-12 h-12 p-2 mr-3 text-white">
                                        <use xlink:href="#download_icon"></use>
                                    </svg>
                                    
                                    <h2 class="text-[#2D3E50] text-xl font-bold">Documents</h2>
                                </div>
                                <div class="relative flex items-center ml-[5%]">
                                    <input type="search" 
                                        id="search_input"
                                        name="text"
                                        placeholder="Cercar documents del centre..." 
                                        class="bg-white border border-[#ff7300] rounded-lg px-3 py-1 w-[17vw] h-[5vh]"
                                        >
                                    <svg class="relative w-6 h-6 txt-orange right-10">
                                        <use xlink:href="#search_loupe"></use>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex w-11/12">
                                
                            </div>

                        </aside>
                    </section>


                    
                </section>
        </main>
    @endauth
    @guest
        <h1>No has iniciat sessió.</h1>
        <meta http-equiv="refresh" content="2; URL={{ route('login') }}" />
    @endguest
</body>
</html>