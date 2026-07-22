@php $editing = $vehicule->exists; @endphp
<x-app-layout>
    <x-slot name="header">{{ $editing ? 'Modifier un véhicule' : 'Ajouter un véhicule' }}</x-slot>

    <x-page-header :title="$editing ? $vehicule->marque.' '.$vehicule->modele : 'Nouveau véhicule'" subtitle="Renseignez les informations du véhicule">
        <x-slot name="actions">
            <x-btn :href="route('vehicules.index')" variant="secondary">Annuler</x-btn>
        </x-slot>
    </x-page-header>

    <form method="POST" action="{{ $editing ? route('vehicules.update', $vehicule) : route('vehicules.store') }}" class="max-w-3xl rounded-xl border border-gray-800 bg-gray-900 p-6">
        @csrf
        @if ($editing) @method('PUT') @endif

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div>
                <x-input-label for="marque" value="Marque" />
                <x-text-input id="marque" name="marque" value="{{ old('marque', $vehicule->marque) }}" required autofocus />
                <x-input-error :messages="$errors->get('marque')" />
            </div>
            <div>
                <x-input-label for="modele" value="Modèle" />
                <x-text-input id="modele" name="modele" value="{{ old('modele', $vehicule->modele) }}" required />
                <x-input-error :messages="$errors->get('modele')" />
            </div>
            <div>
                <x-input-label for="annee" value="Année" />
                <x-text-input id="annee" type="number" name="annee" value="{{ old('annee', $vehicule->annee) }}" required />
                <x-input-error :messages="$errors->get('annee')" />
            </div>
            <div>
                <x-input-label for="immatriculation" value="Immatriculation" />
                <x-text-input id="immatriculation" name="immatriculation" value="{{ old('immatriculation', $vehicule->immatriculation) }}" required />
                <x-input-error :messages="$errors->get('immatriculation')" />
            </div>
            <div>
                <x-input-label for="couleur" value="Couleur" />
                <x-text-input id="couleur" name="couleur" value="{{ old('couleur', $vehicule->couleur) }}" />
                <x-input-error :messages="$errors->get('couleur')" />
            </div>
            <div>
                <x-input-label for="kilometrage" value="Kilométrage" />
                <x-text-input id="kilometrage" type="number" name="kilometrage" value="{{ old('kilometrage', $vehicule->kilometrage) }}" required />
                <x-input-error :messages="$errors->get('kilometrage')" />
            </div>
            <div>
                <x-input-label for="carburant" value="Carburant" />
                <select id="carburant" name="carburant" class="w-full rounded-md border-gray-700 bg-gray-900 text-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @foreach (['essence', 'diesel', 'hybride', 'electrique'] as $val)
                        <option value="{{ $val }}" @selected(old('carburant', $vehicule->carburant) == $val)>{{ ucfirst($val) }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('carburant')" />
            </div>
            <div>
                <x-input-label for="transmission" value="Transmission" />
                <select id="transmission" name="transmission" class="w-full rounded-md border-gray-700 bg-gray-900 text-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @foreach (['manuelle', 'automatique'] as $val)
                        <option value="{{ $val }}" @selected(old('transmission', $vehicule->transmission) == $val)>{{ ucfirst($val) }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('transmission')" />
            </div>

            <div>
                <x-input-label for="type_offre" value="Type d'offre" />
                <select id="type_offre" name="type_offre" x-data x-on:change="$el.value" class="w-full rounded-md border-gray-700 bg-gray-900 text-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="vente" @selected(old('type_offre', $vehicule->type_offre) == 'vente')>Vente uniquement</option>
                    <option value="location" @selected(old('type_offre', $vehicule->type_offre) == 'location')>Location uniquement</option>
                    <option value="vente_location" @selected(old('type_offre', $vehicule->type_offre) == 'vente_location')>Vente et location</option>
                </select>
                <x-input-error :messages="$errors->get('type_offre')" />
            </div>
            <div>
                <x-input-label for="statut" value="Statut" />
                <select id="statut" name="statut" class="w-full rounded-md border-gray-700 bg-gray-900 text-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @foreach (['disponible', 'vendu', 'loue', 'maintenance', 'indisponible'] as $val)
                        <option value="{{ $val }}" @selected(old('statut', $vehicule->statut) == $val)>{{ ucfirst(str_replace('_', ' ', $val)) }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('statut')" />
            </div>

            <div>
                <x-input-label for="prix_vente" value="Prix de vente (FCFA)" />
                <x-text-input id="prix_vente" type="number" step="0.01" name="prix_vente" value="{{ old('prix_vente', $vehicule->prix_vente) }}" />
                <x-input-error :messages="$errors->get('prix_vente')" />
            </div>
            <div>
                <x-input-label for="prix_location_jour" value="Prix location / jour (FCFA)" />
                <x-text-input id="prix_location_jour" type="number" step="0.01" name="prix_location_jour" value="{{ old('prix_location_jour', $vehicule->prix_location_jour) }}" />
                <x-input-error :messages="$errors->get('prix_location_jour')" />
            </div>

            <div class="sm:col-span-2">
                <x-input-label for="description" value="Description" />
                <textarea id="description" name="description" rows="3" class="w-full rounded-md border-gray-700 bg-gray-900 text-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $vehicule->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" />
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-3 border-t border-gray-800 pt-5">
            <x-btn :href="route('vehicules.index')" variant="secondary">Annuler</x-btn>
            <x-btn type="submit">{{ $editing ? 'Enregistrer les modifications' : 'Ajouter le véhicule' }}</x-btn>
        </div>
    </form>
</x-app-layout>
