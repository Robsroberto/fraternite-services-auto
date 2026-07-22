@php $editing = $vente->exists; @endphp
<x-app-layout>
    <x-slot name="header">{{ $editing ? 'Modifier une vente' : 'Nouvelle vente' }}</x-slot>

    <x-page-header :title="$editing ? 'Modifier la vente' : 'Enregistrer une vente'">
        <x-slot name="actions">
            <x-btn :href="route('ventes.index')" variant="secondary">Annuler</x-btn>
        </x-slot>
    </x-page-header>

    <form method="POST" action="{{ $editing ? route('ventes.update', $vente) : route('ventes.store') }}" class="max-w-2xl rounded-xl border border-gray-800 bg-gray-900 p-6">
        @csrf
        @if ($editing) @method('PUT') @endif

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div>
                <x-input-label for="vehicule_id" value="Véhicule" />
                <select id="vehicule_id" name="vehicule_id" class="w-full rounded-md border-gray-700 bg-gray-900 text-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <option value="">Sélectionner un véhicule</option>
                    @foreach ($vehicules as $v)
                        <option value="{{ $v->id }}" data-prix="{{ $v->prix_vente }}" @selected(old('vehicule_id', $vente->vehicule_id ?? ($selectedVehiculeId ?? null)) == $v->id)>
                            {{ $v->marque }} {{ $v->modele }} ({{ $v->immatriculation }})
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('vehicule_id')" />
            </div>
            <div>
                <x-input-label for="client_id" value="Client" />
                <select id="client_id" name="client_id" class="w-full rounded-md border-gray-700 bg-gray-900 text-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <option value="">Sélectionner un client</option>
                    @foreach ($clients as $c)
                        <option value="{{ $c->id }}" @selected(old('client_id', $vente->client_id) == $c->id)>{{ $c->prenom }} {{ $c->nom }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('client_id')" />
            </div>
            <div>
                <x-input-label for="prix_vente" value="Prix de vente (FCFA)" />
                <x-text-input id="prix_vente" type="number" step="0.01" name="prix_vente" value="{{ old('prix_vente', $vente->prix_vente) }}" required />
                <x-input-error :messages="$errors->get('prix_vente')" />
            </div>
            <div>
                <x-input-label for="date_vente" value="Date de vente" />
                <x-text-input id="date_vente" type="date" name="date_vente" value="{{ old('date_vente', optional($vente->date_vente)->format('Y-m-d') ?? now()->format('Y-m-d')) }}" required />
                <x-input-error :messages="$errors->get('date_vente')" />
            </div>
            <div>
                <x-input-label for="mode_paiement" value="Mode de paiement" />
                <select id="mode_paiement" name="mode_paiement" class="w-full rounded-md border-gray-700 bg-gray-900 text-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @foreach (['especes' => 'Espèces', 'virement' => 'Virement', 'mobile_money' => 'Mobile Money', 'cheque' => 'Chèque'] as $val => $label)
                        <option value="{{ $val }}" @selected(old('mode_paiement', $vente->mode_paiement) == $val)>{{ $label }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('mode_paiement')" />
            </div>
            <div>
                <x-input-label for="statut" value="Statut" />
                <select id="statut" name="statut" class="w-full rounded-md border-gray-700 bg-gray-900 text-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @foreach (['en_attente' => 'En attente', 'payee' => 'Payée', 'annulee' => 'Annulée'] as $val => $label)
                        <option value="{{ $val }}" @selected(old('statut', $vente->statut ?? 'en_attente') == $val)>{{ $label }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('statut')" />
            </div>
            <div class="sm:col-span-2">
                <x-input-label for="notes" value="Notes" />
                <textarea id="notes" name="notes" rows="3" class="w-full rounded-md border-gray-700 bg-gray-900 text-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes', $vente->notes) }}</textarea>
                <x-input-error :messages="$errors->get('notes')" />
            </div>
        </div>

        <p class="mt-4 text-xs text-gray-500">Marquer une vente comme "Payée" met automatiquement le véhicule au statut "Vendu".</p>

        <div class="mt-6 flex justify-end gap-3 border-t border-gray-800 pt-5">
            <x-btn :href="route('ventes.index')" variant="secondary">Annuler</x-btn>
            <x-btn type="submit">{{ $editing ? 'Enregistrer les modifications' : 'Enregistrer la vente' }}</x-btn>
        </div>
    </form>

    <script>
        document.getElementById('vehicule_id').addEventListener('change', function () {
            const opt = this.options[this.selectedIndex];
            const prix = opt.getAttribute('data-prix');
            const prixInput = document.getElementById('prix_vente');
            if (prix && !prixInput.value) prixInput.value = prix;
        });
    </script>
</x-app-layout>
