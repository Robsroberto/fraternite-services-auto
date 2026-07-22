<x-app-layout>
    <x-slot name="header">Locations</x-slot>

    <x-page-header title="Contrats de location" subtitle="{{ $locations->total() }} location(s) enregistrée(s)">
        <x-slot name="actions">
            <x-btn :href="route('locations.create')" icon="plus">Nouvelle location</x-btn>
        </x-slot>
    </x-page-header>

    <form method="GET" class="mb-5">
        <select name="statut" onchange="this.form.submit()" class="rounded-md border-gray-700 bg-gray-900 text-sm text-gray-200 focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">Tous les statuts</option>
            @foreach (['reservee', 'en_cours', 'terminee', 'annulee'] as $s)
                <option value="{{ $s }}" @selected(request('statut') == $s)>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
            @endforeach
        </select>
    </form>

    <div class="overflow-hidden rounded-xl border border-gray-800 bg-gray-900">
        <table class="min-w-full divide-y divide-gray-800">
            <thead class="bg-gray-900/50">
                <tr class="text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                    <th class="px-5 py-3">Véhicule</th>
                    <th class="px-5 py-3">Client</th>
                    <th class="px-5 py-3">Période</th>
                    <th class="px-5 py-3">Montant</th>
                    <th class="px-5 py-3">Statut</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @forelse ($locations as $location)
                    <tr class="hover:bg-gray-800/40">
                        <td class="px-5 py-3 text-sm font-medium text-gray-200">{{ $location->vehicule->nom_complet }}</td>
                        <td class="px-5 py-3 text-sm text-gray-400">{{ $location->client->nom_complet }}</td>
                        <td class="px-5 py-3 text-sm text-gray-400">{{ $location->date_debut->format('d/m/Y') }} - {{ $location->date_fin->format('d/m/Y') }}</td>
                        <td class="px-5 py-3 text-sm text-gray-200">{{ number_format($location->montant_total, 0, ',', ' ') }} FCFA</td>
                        <td class="px-5 py-3"><x-badge :statut="$location->statut" /></td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('locations.show', $location) }}" class="rounded-md p-1.5 text-gray-500 hover:bg-gray-800 hover:text-gray-200" title="Voir"><x-icon name="eye" class="w-4 h-4" /></a>
                                <a href="{{ route('locations.edit', $location) }}" class="rounded-md p-1.5 text-gray-500 hover:bg-gray-800 hover:text-gray-200" title="Modifier"><x-icon name="pencil" class="w-4 h-4" /></a>
                                <form method="POST" action="{{ route('locations.destroy', $location) }}" onsubmit="return confirm('Supprimer cette location ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="rounded-md p-1.5 text-gray-500 hover:bg-red-950 hover:text-red-400" title="Supprimer"><x-icon name="trash" class="w-4 h-4" /></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center text-sm text-gray-500">
                            Aucune location enregistrée. <a href="{{ route('locations.create') }}" class="text-indigo-400 hover:underline">Créer la première location</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $locations->links() }}</div>
</x-app-layout>
