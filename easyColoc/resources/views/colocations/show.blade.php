{{-- resources/views/colocations/show.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $colocation->nom }} | EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f9f9fb; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 10px; }
    </style>
</head>
<body class="flex min-h-screen text-slate-700 text-sm">

    {{-- SIDEBAR --}}
    <aside class="w-60 bg-white border-r border-gray-100 shadow-sm fixed h-full p-5 flex flex-col">
        <h1 class="text-xl font-extrabold text-indigo-600 flex items-center gap-2 mb-8">
            <i class="fa-solid fa-house mr-1"></i> EasyColoc
        </h1>
        <nav class="flex-1 space-y-2">
            <a href="{{ route('colocations.index') }}"
               class="flex items-center gap-2 p-3 rounded-lg bg-indigo-50 text-indigo-600 font-semibold">
               <i class="fa-solid fa-users"></i> Colocations
            </a>
            <a href="{{ route('colocations.profile',$colocation) }}" class="flex items-center gap-2 p-3 rounded-lg text-gray-400 hover:bg-gray-50">
               <i class="fa-solid fa-user"></i> Profile
            </a>
        </nav>

        {{-- Reputation card --}}
        <div class="mt-4 bg-indigo-100 p-3 rounded-xl text-indigo-700 text-center shadow-sm">
            <p class="text-xs font-bold uppercase opacity-70">Réputation</p>
            <p class="text-lg font-extrabold">+0 points</p>
            <div class="w-full h-1 bg-white/30 rounded-full mt-2">
                <div class="bg-green-400 h-full w-1/4 rounded-full"></div>
            </div>
        </div>

        <button onclick="document.getElementById('logout-form').submit()"
                class="mt-auto w-full flex items-center justify-center gap-2 py-2 text-red-500 hover:bg-red-50 rounded-lg font-bold">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Déconnexion
        </button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
    </aside>

    {{-- MAIN --}}
    <main class="flex-1 ml-60 p-6">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-6">
            {{-- Left side: title --}}
            <div>
                <h2 class="text-2xl font-bold">{{ $colocation->nom }}</h2>
                <p class="text-xs text-gray-400">Colocations / {{ $colocation->nom }}</p>
            </div>

            {{-- Right side: buttons + user info --}}
            <div class="flex items-center gap-3">
                <button onclick="document.getElementById('modal-depense').classList.remove('hidden')"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-xs font-bold flex items-center gap-2 hover:bg-indigo-700">
                    <i class="fa-solid fa-plus"></i> Ajouter Dépense
                </button>
                <button onclick="document.getElementById('modal-invite').classList.remove('hidden')"
                        class="px-4 py-2 bg-green-500 text-white rounded-lg text-xs font-bold flex items-center gap-2 hover:bg-green-600">
                    <i class="fa-solid fa-user-plus"></i> Inviter Membre
                </button>

                {{-- Top-right user info --}}
                <div class="flex items-center space-x-2 border-l border-gray-200 pl-4">
                    <div class="text-right">
                        <p class="text-xs font-bold text-slate-900 leading-none uppercase">
                            {{ auth()->user()->name ?? 'USER' }}
                        </p>
                        <p class="text-[10px] text-green-500 font-bold uppercase">En ligne</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center font-bold text-indigo-600 text-sm">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </div>
                </div>
            </div>
        </div>

        {{-- CARDS --}}
        <div class="grid grid-cols-3 gap-5 mb-6">
            <div class="bg-white p-4 rounded-xl shadow-sm flex items-center gap-3">
                <div class="w-10 h-10 bg-indigo-50 text-indigo-600 flex items-center justify-center rounded-lg text-lg">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-400">Membres</p>
                    <p class="font-bold text-xl">{{ $colocation->memberships->count() }}</p>
                </div>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm flex items-center gap-3">
                <div class="w-10 h-10 bg-green-50 text-green-600 flex items-center justify-center rounded-lg text-lg">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-400">Dépenses</p>
                    <p class="font-bold text-xl">0,00 €</p>
                </div>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm flex items-center gap-3">
                <div class="w-10 h-10 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-lg text-lg">
                    <i class="fa-solid fa-circle-info"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-400">Statut</p>
                    <p class="font-bold text-green-600 text-sm uppercase">Active</p>
                </div>
            </div>
        </div>

        {{-- DEPENSES TABLE --}}
        <div class="bg-white p-5 rounded-xl shadow-sm mb-6">
            <h3 class="font-bold mb-3 flex items-center gap-2"><i class="fa-solid fa-receipt text-indigo-600"></i> Dépenses récentes</h3>
            <table class="w-full text-xs">
                <thead>
                    <tr class="text-gray-400 border-b">
                        <th class="py-2 text-left font-bold">Titre</th>
                        <th class="py-2 text-left font-bold">Payeur</th>
                        <th class="py-2 text-left font-bold">Montant</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($colocation->depenses ?? [] as $depense)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 font-semibold">{{ $depense->titre }}</td>
                            <td class="py-2">{{ $depense->user->nom ?? '-' }}</td>
                            <td class="py-2 font-bold text-indigo-600">{{ number_format($depense->montant,2) }} €</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="py-6 text-center text-gray-400 italic">Aucune dépense.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- MEMBRES --}}
        <div class="bg-white p-5 rounded-xl shadow-sm">
            <h3 class="font-bold mb-3 flex items-center gap-2"><i class="fa-solid fa-users text-indigo-600"></i> Membres</h3>
            <div class="space-y-2">
                @forelse ($colocation->memberships as $m)
                    <div class="flex justify-between items-center p-2 border rounded-lg hover:bg-gray-50 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center font-bold text-indigo-600">
                                {{ substr($m->user->name ?? '?', 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold">{{ $m->user->name ?? 'Inconnu' }}</p>
                                <p class="text-xs text-gray-400">{{ $m->user->email ?? '' }}</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold {{ $m->role==='owner' ? 'text-yellow-500' : 'text-gray-400' }}">
                            {{ $m->role==='owner' ? 'Owner' : 'Membre' }}
                        </span>
                    </div>
                @empty
                    <p class="text-center text-gray-400 italic py-4">Aucun membre actif.</p>
                @endforelse
            </div>
        </div>

    </main>

    {{-- MODAL Ajouter Dépense --}}
    <div id="modal-depense" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
            <button onclick="document.getElementById('modal-depense').classList.add('hidden')"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark"></i></button>
            <h3 class="font-bold mb-3">Nouvelle dépense</h3>
            <form action="{{ route('depenses.store', $colocation) }}" method="POST" class="space-y-3">@csrf
                <input type="text" name="titre" placeholder="Titre" required class="w-full p-2 border rounded-lg text-sm">
                <input type="number" name="montant" step="0.01" placeholder="Montant (€)" required class="w-full p-2 border rounded-lg text-sm">
                <input type="date" name="date" value="{{ date('Y-m-d') }}" required class="w-full p-2 border rounded-lg text-sm">
                <div class="flex gap-2 justify-end">
                    <button type="button" onclick="document.getElementById('modal-depense').classList.add('hidden')"
                        class="px-3 py-2 text-gray-500 border rounded-lg text-sm">Annuler</button>
                    <button type="submit" class="px-3 py-2 bg-indigo-600 text-white rounded-lg text-sm font-bold">Ajouter</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL Inviter Membre --}}
    <div id="modal-invite" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
            <button onclick="document.getElementById('modal-invite').classList.add('hidden')"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark"></i></button>
            <h3 class="font-bold mb-3">Inviter un membre</h3>
            <form action="#" method="POST" class="space-y-3">@csrf
                <input type="email" name="email" placeholder="Email" required class="w-full p-2 border rounded-lg text-sm">
                <div class="flex gap-2 justify-end">
                    <button type="button" onclick="document.getElementById('modal-invite').classList.add('hidden')"
                        class="px-3 py-2 text-gray-500 border rounded-lg text-sm">Annuler</button>
                    <button type="submit" class="px-3 py-2 bg-green-500 text-white rounded-lg text-sm font-bold">Inviter</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
