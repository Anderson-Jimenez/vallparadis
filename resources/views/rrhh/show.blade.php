<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Detall tema pendent RRHH</title>
    @vite(['resources/css/app.css', 'resources/js/documents_center.js'])
</head>

<body class="bg-orange-50 min-h-screen">
@include('partials.icons')

@auth
@include('components.navbar')

<main class="flex justify-center py-10">
    <div class="w-3/4">
        <!-- Header -->
        <div class="bg-orange-500 text-white px-6 py-3 mt-6">
            <p class="font-semibold">Informació del tema pendent RRHH</p>
        </div>

        <div class="p-8 flex flex-col gap-8 bg-white">

            <!-- Informació bàsica -->
            <section class="flex flex-col gap-4">
                <h2 class="font-semibold text-gray-700">Informació bàsica</h2>

                <div>
                    <label class="text-sm text-gray-600">Context</label>
                    <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                        {{ $issue->context }}
                    </p>
                </div>

                <div class="flex gap-6">
                    <div class="w-1/2">
                        <label class="text-sm text-gray-600">Data d'obertura</label>
                        <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                            {{ $issue->opened_at }}
                        </p>
                    </div>
                    @if($issue->status == 'urgent')
                        <div class="w-1/2">
                            <label class="text-sm text-gray-600">Estat</label>
                            <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 capitalize">
                                Urgent
                            </p>
                        </div>
                    @elseif($issue->status == 'in_process')
                        <div class="w-1/2">
                            <label class="text-sm text-gray-600">Estat</label>
                            <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 capitalize">
                                En procés
                            </p>
                        </div>
                    @elseif($issue->status == 'completed')
                        <div class="w-1/2">
                            <label class="text-sm text-gray-600">Estat</label>
                            <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 capitalize">
                                Finalitzat
                            </p>
                        </div>
                    @else
                        <div class="w-1/2">
                            <label class="text-sm text-gray-600">Estat</label>
                            <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1 capitalize">
                                Pendent
                            </p>
                        </div>
                    @endif
                </div>
            </section>

            <!-- Professionals -->
            <section class="flex flex-col gap-4">
                <h2 class="font-semibold text-gray-700">Professionals implicats</h2>

                <div class="flex gap-6">
                    <div class="w-1/3">
                        <label class="text-sm text-gray-600">Registrat per</label>
                        <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                            {{ $issue->registered_by_professional->name }}
                        </p>
                    </div>

                    <div class="w-1/3">
                        <label class="text-sm text-gray-600">Professional afectat</label>
                        <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                            {{ $issue->affected_professional->name }}
                        </p>
                    </div>

                    <div class="w-1/3">
                        <label class="text-sm text-gray-600">Derivat a</label>
                        <p class="w-full border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                            {{ $issue->derived_to_professional->name ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            </section>

            <!-- Descripció -->
            <section class="flex flex-col gap-4">
                <h2 class="font-semibold text-gray-700">Descripció</h2>
                <textarea disabled rows="4" class="border-2 border-gray-200 rounded-md py-2">
                    {{ $issue->description }}
                </textarea>
            </section>
            <h2 class="font-semibold text-gray-700">Documents adjuntats</h2>
            <div class="flex-1 overflow-y-auto pr-1 max-h-[500px] p-2 border-2 border-gray-200 rounded-md bg-gray-50">
                <div class="space-y-3">

                    @forelse ($issue->documents as $doc)

                        @php
                            $extension = strtolower(pathinfo($doc->path, PATHINFO_EXTENSION));

                            $iconId = match ($extension) {
                                'pdf' => 'icon-pdf',
                                'doc', 'docx' => 'icon-word',
                                'xls', 'xlsx', 'csv' => 'icon-excel',
                                default => 'icon-file',
                            };

                            $iconColor = match ($extension) {
                                'pdf' => 'text-red-500',
                                'doc', 'docx' => 'text-blue-500',
                                'xls', 'xlsx', 'csv' => 'text-green-600',
                                default => 'text-gray-400',
                            };

                            $filename = basename($doc->path);
                        @endphp

                        <div class="bg-white flex items-center justify-between p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                            <div class="flex items-center gap-3 min-w-0 flex-1">
                                <svg class="w-6 h-6 {{ $iconColor }} shrink-0">
                                    <use xlink:href="#{{ $iconId }}"></use>
                                </svg>

                                <div class="min-w-0 flex-1">
                                    <p class="font-medium text-gray-800 text-sm truncate">
                                        {{ $filename }}
                                    </p>
                                    <p class="text-xs text-gray-500 truncate">
                                        {{ $doc->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            <div class="shrink-0 ml-2">
                                <a href="{{ route('hr_pending_issue.documents.download', $doc) }}"
                                class="text-[#ff7300] hover:text-orange-600">
                                    <svg class="w-5 h-5">
                                        <use xlink:href="#download_icon"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>

                    @empty
                        <p class="text-sm text-gray-500">
                            No hi ha documents associats a aquest tema pendent.
                        </p>
                    @endforelse

                </div>
            </div>
            <!-- Accions -->
            <div class="flex justify-between items-center border-t pt-6">
                <a href="{{ route('hr_pending_issue.edit', $issue) }}"
                   class="border border-[#ff7300] text-orange-500 hover:underline px-6 py-4 rounded-xl">
                    Modificar dades
                </a>
                <a href="{{ route('hr_pending_issue.index') }}"
                    class="bg-[#ff7300] text-white hover:underline px-6 py-4 rounded-xl">
                        Tornar a la llista de temes pendents
                </a>


            </div>

        </div>
    </div>
</main>

@endauth

@guest
    <h1>No has iniciat sessió.</h1>
    <meta http-equiv="refresh" content="2; URL={{ route('login') }}">
@endguest
</body>
</html>
