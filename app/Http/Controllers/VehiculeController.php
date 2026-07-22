<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    public function index(Request $request)
    {
        $vehicules = Vehicule::query()
            ->when($request->search, fn ($q) => $q->where(function ($q) use ($request) {
                $q->where('marque', 'like', "%{$request->search}%")
                  ->orWhere('modele', 'like', "%{$request->search}%")
                  ->orWhere('immatriculation', 'like', "%{$request->search}%");
            }))
            ->when($request->statut, fn ($q) => $q->where('statut', $request->statut))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('vehicules.index', compact('vehicules'));
    }

    public function create()
    {
        return view('vehicules.form', ['vehicule' => new Vehicule()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Vehicule::create($data);

        return redirect()->route('vehicules.index')->with('success', 'Véhicule ajouté avec succès.');
    }

    public function show(Vehicule $vehicule)
    {
        $vehicule->load(['ventes.client', 'locations.client']);

        return view('vehicules.show', compact('vehicule'));
    }

    public function edit(Vehicule $vehicule)
    {
        return view('vehicules.form', compact('vehicule'));
    }

    public function update(Request $request, Vehicule $vehicule)
    {
        $data = $this->validated($request, $vehicule->id);
        $vehicule->update($data);

        return redirect()->route('vehicules.index')->with('success', 'Véhicule mis à jour avec succès.');
    }

    public function destroy(Vehicule $vehicule)
    {
        $vehicule->delete();

        return redirect()->route('vehicules.index')->with('success', 'Véhicule supprimé avec succès.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'marque' => ['required', 'string', 'max:255'],
            'modele' => ['required', 'string', 'max:255'],
            'annee' => ['required', 'integer', 'min:1980', 'max:'.(date('Y') + 1)],
            'immatriculation' => ['required', 'string', 'max:50', 'unique:vehicules,immatriculation'.($ignoreId ? ",{$ignoreId}" : '')],
            'couleur' => ['nullable', 'string', 'max:100'],
            'carburant' => ['required', 'in:essence,diesel,hybride,electrique'],
            'transmission' => ['required', 'in:manuelle,automatique'],
            'kilometrage' => ['required', 'integer', 'min:0'],
            'type_offre' => ['required', 'in:vente,location,vente_location'],
            'prix_vente' => ['nullable', 'required_if:type_offre,vente,vente_location', 'numeric', 'min:0'],
            'prix_location_jour' => ['nullable', 'required_if:type_offre,location,vente_location', 'numeric', 'min:0'],
            'statut' => ['required', 'in:disponible,vendu,loue,maintenance,indisponible'],
            'description' => ['nullable', 'string'],
        ]);
    }
}
