<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguiments del manteniment</title>
    @vite(['resources/css/app.css', 'resources/js/maintenance_followup.js'])
</head>

<body class="min-h-screen flex flex-col bg-[#E9EDF2]">
@include('partials.icons')

@auth
@include('components.navbar')

<main class="flex w-full">
    @include('components.sidebar')

    <section class="w-4/5 flex items-center justify-center relative">

        {{-- LISTADO --}}
        <div class="bg-white w-3/5 rounded-2xl border-2 border-[#FF7400] h-4/5">

            <div class="flex justify-end p-5">
                <button id="add_followup_btn"
                        class="bg-[#ff7300] text-white px-6 py-3 rounded-xl hover:bg-orange-600">
                    + Nou seguiment
                </button>
            </div>

            <div class="flex flex-col items-center">
                @foreach ($maintenance->maintenance_followups as $index => $followup)
                    <div class="followup-card w-11/12 bg-white flex justify-between rounded-3xl p-5 my-3 border border-[#FF7400]
                                shadow-md cursor-pointer">

                        <div class="flex items-center">
                            <svg class="w-8 h-8 txt-orange mr-3">
                                <use xlink:href="#documentation_icon"></use>
                            </svg>
                            <p class="txt-orange text-lg">
                                {{ $followup->issue }} #{{ $index + 1 }}
                            </p>
                        </div>

                        <p class="txt-orange text-lg">{{ $followup->date }}</p>

                        {{-- DATA PARA JS --}}
                        <input type="hidden" class="fu-date" value="{{ $followup->date }}">
                        <input type="hidden" class="fu-issue" value="{{ $followup->issue }}">
                        <input type="hidden" class="fu-desc" value="{{ $followup->description }}">
                        <input type="hidden" class="fu-docs"
                               value='@json($followup->maintenance_followup_doc)'>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- MODAL AÑADIR --}}
        <div id="add_followup_modal"
             class="hidden absolute bg-white rounded-3xl w-2/5 p-8 z-50">

            <form action="{{ route('maintenance.followup.store', $maintenance) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="space-y-5">
                @csrf

                <div class="flex justify-between">
                    <h2 class="text-2xl txt-orange font-bold">Nou seguiment</h2>
                    <button id="close_add_followup">✕</button>
                </div>

                <input type="date" name="date" required
                       class="w-full bg-gray-200 rounded-full px-4 py-2">

                <input type="text" name="issue" required
                       placeholder="Motiu del seguiment"
                       class="w-full bg-gray-200 rounded-full px-4 py-2">

                <textarea name="description" rows="5" required
                          class="w-full bg-gray-200 rounded-2xl px-4 py-3"
                          placeholder="Descripció"></textarea>

                {{-- DOCUMENTOS --}}
                <input type="file" name="docs[]" multiple
                       class="w-full border rounded-lg p-2">

                <button class="w-full bg-orange-500 text-white py-3 rounded-full">
                    Guardar seguiment
                </button>
            </form>
        </div>

        {{-- MODAL VER --}}
        <div id="view_followup_modal"
             class="hidden absolute bg-white rounded-3xl w-3/5 p-10 z-50 overflow-y-auto">

            <div class="flex justify-between mb-4">
                <h2 class="text-2xl txt-orange font-bold">Detalls del seguiment</h2>
                <button id="close_view_followup">✕</button>
            </div>

            <div class="space-y-4">
                <div>
                    <p class="txt-orange font-semibold">Data</p>
                    <div id="v_date" class="bg-gray-200 rounded-full px-4 py-1"></div>
                </div>

                <div>
                    <p class="txt-orange font-semibold">Motiu</p>
                    <div id="v_issue" class="bg-gray-200 rounded-full px-4 py-1"></div>
                </div>

                <div>
                    <p class="txt-orange font-semibold">Descripció</p>
                    <div id="v_desc"
                         class="bg-gray-200 rounded-2xl p-4 leading-relaxed"></div>
                </div>

                {{-- DOCUMENTOS --}}
                <div>
                    <p class="txt-orange font-semibold">Documents</p>
                    <div id="v_docs" class="space-y-2"></div>
                </div>
            </div>
        </div>

        {{-- OVERLAY --}}
        <div id="overlay"
             class="hidden fixed inset-0 bg-black/40 z-40"></div>

    </section>
</main>
@endauth
</body>
</html>
