<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer Category | EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="max-w-md mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6 text-indigo-600">Créer une nouvelle catégorie</h1>

        <form action="{{ route('categories.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-4">
            @csrf
            <input type="text" name="titre" placeholder="Nom de la catégorie" required
                   class="w-full border p-2 rounded text-sm">

            <div class="flex justify-end gap-2">
                <a href="{{ route('categories.index') }}"
                   class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 text-sm font-bold">Annuler</a>
                <button type="submit"
                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 text-sm font-bold">
                    Créer
                </button>
            </div>
        </form>
    </div>

</body>
</html>
