<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories | EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans">

    <div class="max-w-5xl mx-auto py-10">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-indigo-600">Categories</h1>
            <a href="{{ route('categories.create') }}"
                class="px-4 py-2 bg-green-500 text-white rounded-lg font-bold hover:bg-green-600">
                <i class="fa-solid fa-plus"></i> Ajouter Category
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                    <tr>
                        <th class="py-3 px-4">Nom</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 px-4">{{ $category->titre }}</td>
                            <td class="py-2 px-4 text-right space-x-2">
                                <a href="{{ route('categories.edit', $category) }}"
                                    class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-xs font-bold">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Vous êtes sûr de vouloir supprimer cette catégorie ?');"
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs font-bold">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center py-4 text-gray-400 italic">Aucune catégorie trouvée.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>
