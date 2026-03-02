<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex justify-center items-center bg-gray-100">

    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow">

        {{-- Title --}}
        <h2 class="text-2xl font-bold text-center mb-6">
            Mon Profil
        </h2>

        {{-- Success message --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- User Info --}}
        <div class="space-y-4">

            <div>
                <p class="text-sm text-gray-500">Nom</p>
                <p class="font-semibold text-lg">
                    {{ auth()->user()->name }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-semibold text-lg">
                    {{ auth()->user()->email }}
                </p>
            </div>

        </div>

        {{-- Buttons --}}
        <div class="mt-6 flex gap-3">

            {{-- EDIT BUTTON --}}
            <a href="{{ route('profile.edit') }}"
                class="flex-1 text-center py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Modifier
            </a>
            {{-- Annuler Button --}}
            <a href="{{ url()->previous() }}"
                class="flex-1 text-center py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                Annuler
            </a>

        </div>

    </div>

</body>

</html>
