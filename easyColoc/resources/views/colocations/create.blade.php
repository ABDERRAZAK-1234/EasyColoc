{{-- resources/views/colocations/create.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Colocation | EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f9f9fb; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-xl bg-white p-8 rounded-lg border border-gray-200">

        {{-- Header --}}
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-1">Nouvelle Colocation</h2>
            <p class="text-sm text-gray-500">Créez votre espace et invitez vos colocataires.</p>
        </div>

        {{-- Form --}}
        <form action="{{ route('colocations.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Nom --}}
            <div>
                <label for="titre" class="block text-sm font-semibold text-gray-700 mb-1">Nom de la colocation <span class="text-red-500">*</span></label>
                <input type="text" name="titre" id="titre" required placeholder="Ex: Villa des Amis, Appart 42..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                @error('titre')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="3" placeholder="Adresse ou infos supplémentaires..."
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm"></textarea>
                @error('description')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex gap-3 pt-4">
                <a href="{{ route('colocations.index') }}"
                   class="flex-1 text-center py-2 text-gray-600 rounded-lg border border-gray-200 hover:bg-gray-100 font-semibold text-sm transition">
                    Annuler
                </a>
                <button type="submit"
                        class="flex-1 bg-indigo-600 text-white py-2 rounded-lg font-semibold hover:bg-indigo-700 transition text-sm">
                    Créer la colocation
                </button>
            </div>

        </form>
    </div>

</body>
</html>
