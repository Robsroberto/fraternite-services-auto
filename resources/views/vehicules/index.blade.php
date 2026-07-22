<x-app-layout>
    <x-slot name="header">Véhicules</x-slot>

    <x-page-header title="Parc automobile" subtitle="{{ $vehicules->total() }} véhicule(s) au total">
        <x-slot name="actions">
            <x-btn :href="route('vehicules.create')" icon="plus">Ajouter un véhicule</x-btn>
        </x-slot>
    </x-page-header>

    <form method="GET" class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center">
        <div class="relative flex-1">
            <x-icon name="search" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-500" />
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher marque, modèle, immatriculation..."
                   class="w-full rounded-md border-gray-700 bg-gray-900 pl-9 text-sm text-gray-200 placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <select name="statut" onchange="this.form.submit()" class="rounded-md border-gray-700 bg-gray-900 text-sm text-gray-200 focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">Tous les statuts</option>
            @foreach (['disponible', 'vendu', 'loue', 'maintenance', 'indisponible'] as $s)
                <option value="{{ $s }}" @selected(request('statut') == $s)>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
            @endforeach
        </select>
        <button type="submit" class="rounded-md bg-gray-800 border border-gray-700 px-3.5 py-2 text-sm text-gray-200 hover:bg-gray-700">Filtrer</button>
    </form>

    <div class="overflow-hidden rounded-xl border border-gray-800 bg-gray-900">
        <table class="min-w-full divide-y divide-gray-800">
            <thead class="bg-gray-900/50">
                <tr class="text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                    <th class="px-5 py-3">Véhicule</th>
                    <th class="px-5 py-3">Immatriculation</th>
                    <th class="px-5 py-3">Offre</th>
                    <th class="px-5 py-3">Prix</th>
                    <th class="px-5 py-3">Statut</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @forelse ($vehicules as $vehicule)
                    <tr class="hover:bg-gray-800/40">
                        <td class="px-5 py-3">
                            <p class="text-sm font-medium text-gray-200">{{ $vehicule->marque }} {{ $vehicule->modele }}</p>
                            <p class="text-xs text-gray-500">{{ $vehicule->annee }} &middot; {{ number_format($vehicule->kilometrage, 0, ',', ' ') }} km</p>
                        </td>
                        <td class="px-5 py-3 text-sm text-gray-400">{{ $vehicule->immatriculation }}</td>
                        <td class="px-5 py-3 text-sm text-gray-400">{{ ucfirst(str_replace('_', ' / ', $vehicule->type_offre)) }}</td>
                        <td class="px-5 py-3 text-sm text-gray-300">
                            @if ($vehicule->prix_vente)
                                <div>{{ number_format($vehicule->prix_vente, 0, ',', ' ') }} FCFA</div>
                            @endif
                            @if ($vehicule->prix_location_jour)
                                <div class="text-xs text-gray-500">{{ number_format($vehicule->prix_location_jour, 0, ',', ' ') }} FCFA/jour</div>
                            @endif
                        </td>
                        <td class="px-5 py-3"><x-badge :statut="$vehicule->statut" /></td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('vehicules.show', $vehicule) }}" class="rounded-md p-1.5 text-gray-500 hover:bg-gray-800 hover:text-gray-200" title="Voir"><x-icon name="eye" class="w-4 h-4" /></a>
                                <a href="{{ route('vehicules.edit', $vehicule) }}" class="rounded-md p-1.5 text-gray-500 hover:bg-gray-800 hover:text-gray-200" title="Modifier"><x-icon name="pencil" class="w-4 h-4" /></a>
                                <form method="POST" action="{{ route('vehicules.destroy', $vehicule) }}" onsubmit="return confirm('Supprimer ce véhicule ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="rounded-md p-1.5 text-gray-500 hover:bg-red-950 hover:text-red-400" title="Supprimer"><x-icon name="trash" class="w-4 h-4" /></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center text-sm text-gray-500">
                            Aucun véhicule enregistré. <a href="{{ route('vehicules.create') }}" class="text-indigo-400 hover:underline">Ajouter le premier véhicule</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $vehicules->links() }}</div>
</x-app-layout>
