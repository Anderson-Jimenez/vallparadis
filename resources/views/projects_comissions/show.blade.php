<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Detall projecte / comissió</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-orange-50 min-h-screen">

@include('components.navbar')
@include('partials.icons')     

@auth
    <main class="flex justify-center py-10">
        <div class="w-3/4">

            <div class="bg-orange-500 text-white px-6 py-3 mt-6">
                <p class="font-semibold">Informació del projecte / comissió</p>
            </div>

            <div class="p-8 flex flex-col gap-8 bg-white">

                <section class="flex flex-col gap-4">
                    <h2 class="font-semibold text-gray-700">Informació bàsica</h2>

                    <div>
                        <label class="text-sm text-gray-600">Nom</label>
                        <p class="border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                            {{ $project_comission->name }}
                        </p>
                    </div>

                    <div class="flex gap-6">
                        <div class="w-1/2">
                            <label class="text-sm text-gray-600">Data d'inici</label>
                            <p class="border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                                {{ $project_comission->start_date }}
                            </p>
                        </div>

                        <div class="w-1/2">
                            <label class="text-sm text-gray-600">Tipus</label>
                            <p class="border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                                {{ $project_comission->type }}
                            </p>
                        </div>
                    </div>
                </section>

                <section class="flex flex-col gap-4">
                    <h2 class="font-semibold text-gray-700">Professionals implicats</h2>

                    <div class="flex gap-6">
                        <div class="w-1/3">
                            <label class="text-sm text-gray-600">Manager del projecte</label>
                            <p class="border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                                {{ $project_comission->manager->name ?? 'N/A' }}
                            </p>
                        </div>

                        <div class="w-1/3">
                            <label class="text-sm text-gray-600">Centre</label>
                            <p class="border-2 border-gray-200 rounded-md px-3 py-2 mt-1">
                                {{ $project_comission->center->name ?? 'N/A' }}
                            </p>
                        </div>

                        <div class="w-1/3">
                            <label class="text-sm text-gray-600">Estat</label>
                            <p class="border-2 border-gray-200 rounded-md px-3 py-2 mt-1 capitalize">
                                {{ $project_comission->status ?? 'pendent' }}
                            </p>
                        </div>
                    </div>
                </section>

                <section class="flex flex-col gap-4">
                    <h2 class="font-semibold text-gray-700">Descripció</h2>
                    <textarea disabled rows="4"
                        class="border-2 border-gray-200 rounded-md px-3 py-2">
                        {{ $project_comission->description }}
                    </textarea>
                </section>

                <section class="flex flex-col gap-4">
                    <h2 class="font-semibold text-gray-700">Observacions</h2>
                    <textarea disabled rows="4"
                        class="border-2 border-gray-200 rounded-md px-3 py-2">
                        {{ $project_comission->observation }}
                    </textarea>
                </section>

                <section class="flex flex-col gap-4">
                    <h2 class="font-semibold text-gray-700">Documents adjuntats</h2>

                    <div class="max-h-[400px] overflow-y-auto p-2 border-2 border-gray-200 rounded-md bg-gray-50 space-y-3">

                        @forelse ($project_comission->projects_comissions_documents as $doc)

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

                            <div class="bg-white flex items-center justify-between p-3 rounded-lg border border-gray-200 hover:bg-gray-50">
                                <div class="flex items-center gap-3 min-w-0">
                                    <svg class="w-6 h-6 {{ $iconColor }}">
                                        <use xlink:href="#{{ $iconId }}"></use>
                                    </svg>

                                    <div class="min-w-0">
                                        <p class="font-medium text-sm truncate">
                                            {{ $filename }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $doc->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>

                                <a href="{{ route('project_comission.documents.download', $doc) }}"
                                class="text-orange-500 hover:text-orange-600">
                                    <svg class="w-5 h-5 txt-orange">
                                        <use xlink:href="#download_icon"></use>
                                    </svg>
                                </a>
                            </div>

                        @empty
                            <p class="text-sm text-gray-500">
                                No hi ha documents associats a aquest projecte.
                            </p>
                        @endforelse
                    </div>
                </section>

                <div class="flex justify-between items-center border-t pt-6">
                    <a href="{{ route('project_comission.index') }}"
                    class="bg-orange-500 text-white px-6 py-4 rounded-xl hover:bg-orange-600">
                        Tornar a la llista
                    </a>

                    <a href="{{ route('project_comission.edit', $project_comission) }}"
                    class="border border-orange-500 text-orange-500 px-6 py-4 rounded-xl hover:underline">
                        Modificar dades
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
