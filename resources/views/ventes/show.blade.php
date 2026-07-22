<x-app-layout>
    <x-slot name="header">Détail de la vente</x-slot>

    <x-page-header title="Vente #{{ $vente->id }}" subtitle="{{ $vente->vehicule->nom_complet }}">
        <x-slot name="actions">
            <x-btn :href="route('ventes.edit', $vente)" variant="secondary" icon="pencil">Modifier</x-btn>
            <x-btn :href="route('ventes.index')" variant="secondary">Retour</x-btn>
        </x-slot>
    </x-page-header>

    <div class="max-w-2xl rounded-xl border border-gray-800 bg-gray-900 p-6">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-gray-200">Informations</h2>
            <x-badge :statut="$vente->statut" />
        </div>
        <dl class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm">
            <div><dt class="text-gray-500">Véhicule</dt><dd class="text-gray-200"><a href="{{ route('vehicules.show', $vente->vehicule) }}" class="text-indigo-400 hover:underline">{{ $vente->vehicule->nom_complet }}</a></dd></div>
            <div><dt class="text-gray-500">Client</dt><dd class="text-gray-200"><a href="{{ route('clients.show', $vente->client) }}" class="text-indigo-400 hover:underline">{{ $vente->client->nom_complet }}</a></dd></div>
            <div><dt class="text-gray-500">Prix de vente</dt><dd class="text-gray-200">{{ number_format($vente->prix_vente, 0, ',', ' ') }} FCFA</dd></div>
            <div><dt class="text-gray-500">Date de vente</dt><dd class="text-gray-200">{{ $vente->date_vente->format('d/m/Y') }}</dd></div>
            <div><dt class="text-gray-500">Mode de paiement</dt><dd class="text-gray-200">{{ ucfirst(str_replace('_', ' ', $vente->mode_paiement)) }}</dd></div>
            <div><dt class="text-gray-500">Enregistrée par</dt><dd class="text-gray-200">{{ $vente->user->name }}</dd></div>
        </dl>
        @if ($vente->notes)
            <div class="mt-5 border-t border-gray-800 pt-4">
                <dt class="mb-1 text-sm text-gray-500">Notes</dt>
                <dd class="text-sm text-gray-300">{{ $vente->notes }}</dd>
            </div>
        @endif
    </div>
</x-app-layout>
