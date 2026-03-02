{{-- resources/views/colocations/index.blade.php --}}
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colocations | EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f9f9fb;
        }
    </style>
</head>

<body class="min-h-screen p-6">

    <div class="max-w-6xl mx-auto">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fa-solid fa-house-chimney-window text-indigo-600 mr-2"></i>
                Colocations disponibles
            </h1>

        </div>

        {{-- Grid des colocations --}}
        @if (!$colocation)
            <div class="bg-white p-10 rounded-lg border border-gray-200 text-center">
                <i class="fa-solid fa-house-circle-xmark text-indigo-500 text-4xl mb-3"></i>
                <h2 class="text-lg font-bold mb-1">Aucune colocation pour l'instant</h2>
                <p class="text-gray-500 mb-3">Créez votre première colocation !</p>
                <a href="{{ route('colocations.create') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition text-sm">
                    Créer
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @if ($colocation)
                    <div class="bg-white p-4 rounded-lg border border-gray-200 flex flex-col justify-between">

                        {{-- Titre et Description --}}
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $colocation->titre }}</h3>
                            <p class="text-gray-500 text-sm line-clamp-2">
                                {{ $colocation->description ?? 'Aucune description fournie.' }}</p>
                        </div>

                        {{-- Membres --}}
                        <div class="flex items-center justify-between mt-3 mb-2 text-xs text-gray-600">
                            <span>{{ $colocation->memberships->count() }} membre(s)</span>
                            <div class="flex -space-x-1">
                                @forelse ($colocation->memberships->take(3) as $membership)
                                    <div
                                        class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs border border-white">
                                        {{ substr($membership->user->name ?? '?', 0, 1) }}
                                    </div>
                                @empty
                                    <div
                                        class="w-6 h-6 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center text-xs border border-white">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                @endforelse
                                @if ($colocation->memberships->count() > 3)
                                    <div
                                        class="w-6 h-6 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center text-xs border border-white">
                                        +{{ $colocation->memberships->count() - 3 }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex gap-2 mt-2">
                            <a href="{{ route('colocations.show', $colocation) }}"
                                class="flex-1 text-center py-1 px-2 bg-indigo-50 text-indigo-700 rounded-lg font-semibold hover:bg-indigo-600 hover:text-white transition text-sm">
                                Voir
                            </a>
                            <a href="{{ route('colocations.edit', $colocation) }}"
                                class="flex-1 text-center py-1 px-2 bg-yellow-50 text-yellow-700 rounded-lg font-semibold hover:bg-yellow-600 hover:text-white transition text-sm">
                                Éditer
                            </a>
                            <form action="{{ route('colocations.destroy', $colocation) }}" method="POST"
                                class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full py-1 px-2 bg-red-50 text-red-700 rounded-lg font-semibold hover:bg-red-600 hover:text-white transition text-sm">
                                    Supprimer
                                </button>
                            </form>
                        </div>

                    </div>
                @endif
            </div>
        @endif

    </div>

</body>

</html>
