{{-- resources/views/profile/edit.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil | EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f9f9fb; }
    </style>
</head>
<body class="min-h-screen p-6 flex justify-center">

    <div class="w-full max-w-md bg-white p-6 rounded-lg border border-gray-200">

        {{-- Header --}}
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-1">Mon Profil</h2>
            <p class="text-sm text-gray-500">Gérez vos informations personnelles</p>
        </div>

        {{-- User Info Form --}}
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')

            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                @error('name')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                @error('email')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Nouveau mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Laisser vide pour ne pas changer"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                @error('password')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password Confirmation --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmez le mot de passe"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
            </div>

            {{-- Buttons --}}
            <div class="flex justify-between gap-3 pt-4">
                <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer votre compte ?');" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full py-2 px-4 bg-red-50 text-red-700 rounded-lg font-semibold hover:bg-red-600 hover:text-white transition text-sm">
                        Supprimer le compte
                    </button>
                </form>
                <button type="submit"
                        class="flex-1 py-2 px-4 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition text-sm">
                    Enregistrer
                </button>
            </div>

        </form>

    </div>

</body>
</html>
