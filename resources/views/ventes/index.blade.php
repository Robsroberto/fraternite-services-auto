<x-app-layout>
    <x-slot name="header">Ventes</x-slot>

    <x-page-header title="Ventes de véhicules" subtitle="{{ $ventes->total() }} vente(s) enregistrée(s)">
        <x-slot name="actions">
            <x-btn :href="route('ventes.create')" icon="plus">Nouvelle vente</x-btn>
        </x-slot>
    </x-page-header>

    <form method="GET" class="mb-5">
        <select name="statut" onchange="this.form.submit()" class="rounded-md border-gray-700 bg-gray-900 text-sm text-gray-200 focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">Tous les statuts</option>
            @foreach (['en_attente', 'payee', 'annulee'] as $s)
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
                    <th class="px-5 py-3">Date</th>
                    <th class="px-5 py-3">Montant</th>
                    <th class="px-5 py-3">Paiement</th>
                    <th class="px-5 py-3">Statut</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @forelse ($ventes as $vente)
                    <tr class="hover:bg-gray-800/40">
                        <td class="px-5 py-3 text-sm font-medium text-gray-200">{{ $vente->vehicule->nom_complet }}</td>
                        <td class="px-5 py-3 text-sm text-gray-400">{{ $vente->client->nom_complet }}</td>
                        <td class="px-5 py-3 text-sm text-gray-400">{{ $vente->date_vente->format('d/m/Y') }}</td>
                        <td class="px-5 py-3 text-sm text-gray-200">{{ number_format($vente->prix_vente, 0, ',', ' ') }} FCFA</td>
                        <td class="px-5 py-3 text-sm text-gray-400">{{ ucfirst(str_replace('_', ' ', $vente->mode_paiement)) }}</td>
                        <td class="px-5 py-3"><x-badge :statut="$vente->statut" /></td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('ventes.show', $vente) }}" class="rounded-md p-1.5 text-gray-500 hover:bg-gray-800 hover:text-gray-200" title="Voir"><x-icon name="eye" class="w-4 h-4" /></a>
                                <a href="{{ route('ventes.edit', $vente) }}" class="rounded-md p-1.5 text-gray-500 hover:bg-gray-800 hover:text-gray-200" title="Modifier"><x-icon name="pencil" class="w-4 h-4" /></a>
                                <form method="POST" action="{{ route('ventes.destroy', $vente) }}" onsubmit="return confirm('Supprimer cette vente ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="rounded-md p-1.5 text-gray-500 hover:bg-red-950 hover:text-red-400" title="Supprimer"><x-icon name="trash" class="w-4 h-4" /></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-5 py-12 text-center text-sm text-gray-500">
                            Aucune vente enregistrée. <a href="{{ route('ventes.create') }}" class="text-indigo-400 hover:underline">Créer la première vente</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $ventes->links() }}</div>
</x-app-layout>
