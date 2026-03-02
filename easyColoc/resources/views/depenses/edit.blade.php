{{-- resources/views/depenses/edit.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editer Dépense | EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-100">

    <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">Modifier la dépense</h1>

        <form action="{{ route('colocations.depenses.update', [$colocation, $depense]) }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')

            <input type="text" name="titre" placeholder="Titre" required
                value="{{ old('titre', $depense->titre) }}"
                class="w-full p-2 border rounded text-sm">

            <input type="number" name="montant" placeholder="Montant" step="0.01" required
                value="{{ old('montant', $depense->montant) }}"
                class="w-full p-2 border rounded text-sm">

            <input type="date" name="date" required
                value="{{ old('date', $depense->date->format('Y-m-d')) }}"
                class="w-full p-2 border rounded text-sm">

            <select name="categorie_id" required class="w-full p-2 border rounded text-sm">
                <option value="" disabled>Choisir une catégorie</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $depense->categorie_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->titre }}
                    </option>
                @endforeach
            </select>

            <div class="flex justify-between">
                <a href="{{ route('colocations.index', $colocation) }}" class="px-4 py-2 border rounded hover:bg-gray-100">
                    Annuler
                </a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>

</body>
</html>
