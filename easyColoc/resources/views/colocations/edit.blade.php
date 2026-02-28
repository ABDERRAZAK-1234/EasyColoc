{{-- resources/views/colocations/edit.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Colocation | EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f9f9fb; }
    </style>
</head>
<body class="min-h-screen p-6">

    <div class="max-w-2xl mx-auto">

        {{-- Back link --}}
        <a href="{{ route('colocations.index') }}"
           class="inline-flex items-center text-sm text-gray-500 hover:text-indigo-600 mb-4">
            <i class="fa-solid fa-arrow-left mr-2"></i> Retour
        </a>

        {{-- Page title --}}
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Modifier la colocation</h1>

        {{-- Form --}}
        <form action="{{ route('colocations.update', $colocation) }}" method="POST" class="space-y-4 bg-white p-5 rounded-lg border border-gray-200">
            @csrf
            @method('PUT')

            {{-- Titre --}}
            <div>
                <label for="titre" class="block text-sm font-semibold text-gray-700 mb-1">Titre</label>
                <input type="text" name="titre" id="titre" value="{{ old('titre', $colocation->titre) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('titre')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="4"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $colocation->description) }}</textarea>
                @error('description')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-3 mt-4">
                <a href="{{ route('colocations.index') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-semibold transition">
                    Annuler
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold transition">
                    Enregistrer
                </button>
            </div>
        </form>

    </div>

</body>
</html>
