@php $editing = $location->exists; @endphp
<x-app-layout>
    <x-slot name="header">{{ $editing ? 'Modifier une location' : 'Nouvelle location' }}</x-slot>

    <x-page-header :title="$editing ? 'Modifier la location' : 'Créer une location'">
        <x-slot name="actions">
            <x-btn :href="route('locations.index')" variant="secondary">Annuler</x-btn>
        </x-slot>
    </x-page-header>

    <form method="POST" action="{{ $editing ? route('locations.update', $location) : route('locations.store') }}" class="max-w-2xl rounded-xl border border-gray-800 bg-gray-900 p-6">
        @csrf
        @if ($editing) @method('PUT') @endif

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div>
                <x-input-label for="vehicule_id" value="Véhicule" />
                <select id="vehicule_id" name="vehicule_id" class="w-full rounded-md border-gray-700 bg-gray-900 text-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <option value="">Sélectionner un véhicule</option>
                    @foreach ($vehicules as $v)
                        <option value="{{ $v->id }}" data-prix="{{ $v->prix_location_jour }}" @selected(old('vehicule_id', $location->vehicule_id) == $v->id)>
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
                        <option value="{{ $c->id }}" @selected(old('client_id', $location->client_id) == $c->id)>{{ $c->prenom }} {{ $c->nom }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('client_id')" />
            </div>
            <div>
                <x-input-label for="date_debut" value="Date de début" />
                <x-text-input id="date_debut" type="date" name="date_debut" value="{{ old('date_debut', optional($location->date_debut)->format('Y-m-d')) }}" required />
                <x-input-error :messages="$errors->get('date_debut')" />
            </div>
            <div>
                <x-input-label for="date_fin" value="Date de fin" />
                <x-text-input id="date_fin" type="date" name="date_fin" value="{{ old('date_fin', optional($location->date_fin)->format('Y-m-d')) }}" required />
                <x-input-error :messages="$errors->get('date_fin')" />
            </div>
            <div>
                <x-input-label for="prix_jour" value="Prix par jour (FCFA)" />
                <x-text-input id="prix_jour" type="number" step="0.01" name="prix_jour" value="{{ old('prix_jour', $location->prix_jour) }}" required />
                <x-input-error :messages="$errors->get('prix_jour')" />
            </div>
            <div>
                <x-input-label for="caution" value="Caution (FCFA)" />
                <x-text-input id="caution" type="number" step="0.01" name="caution" value="{{ old('caution', $location->caution) }}" />
                <x-input-error :messages="$errors->get('caution')" />
            </div>
            <div class="sm:col-span-2">
                <x-input-label for="statut" value="Statut" />
                <select id="statut" name="statut" class="w-full rounded-md border-gray-700 bg-gray-900 text-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @foreach (['reservee' => 'Réservée', 'en_cours' => 'En cours', 'terminee' => 'Terminée', 'annulee' => 'Annulée'] as $val => $label)
                        <option value="{{ $val }}" @selected(old('statut', $location->statut ?? 'reservee') == $val)>{{ $label }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('statut')" />
            </div>
            <div class="sm:col-span-2">
                <x-input-label for="notes" value="Notes" />
                <textarea id="notes" name="notes" rows="3" class="w-full rounded-md border-gray-700 bg-gray-900 text-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes', $location->notes) }}</textarea>
                <x-input-error :messages="$errors->get('notes')" />
            </div>
        </div>

        <p class="mt-4 text-xs text-gray-500">Le montant total est calculé automatiquement (nombre de jours &times; prix/jour). Le statut "En cours" met le véhicule en "Loué".</p>

        <div class="mt-6 flex justify-end gap-3 border-t border-gray-800 pt-5">
            <x-btn :href="route('locations.index')" variant="secondary">Annuler</x-btn>
            <x-btn type="submit">{{ $editing ? 'Enregistrer les modifications' : 'Créer la location' }}</x-btn>
        </div>
    </form>

    <script>
        document.getElementById('vehicule_id').addEventListener('change', function () {
            const opt = this.options[this.selectedIndex];
            const prix = opt.getAttribute('data-prix');
            const prixInput = document.getElementById('prix_jour');
            if (prix && !prixInput.value) prixInput.value = prix;
        });
    </script>
</x-app-layout>
