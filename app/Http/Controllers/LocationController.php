<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Location;
use App\Models\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $locations = Location::with(['vehicule', 'client'])
            ->when($request->statut, fn ($q) => $q->where('statut', $request->statut))
            ->latest('date_debut')
            ->paginate(10)
            ->withQueryString();

        return view('locations.index', compact('locations'));
    }

    public function create(Request $request)
    {
        $vehicules = Vehicule::whereIn('statut', ['disponible'])->orWhere('id', $request->vehicule_id)->orderBy('marque')->get();
        $clients = Client::orderBy('nom')->get();

        return view('locations.form', [
            'location' => new Location(),
            'vehicules' => $vehicules,
            'clients' => $clients,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['user_id'] = $request->user()->id;
        $data['montant_total'] = $this->calculerMontant($data);

        $location = Location::create($data);

        if ($location->statut === 'en_cours') {
            $location->vehicule->update(['statut' => 'loue']);
        }

        return redirect()->route('locations.index')->with('success', 'Location créée avec succès.');
    }

    public function show(Location $location)
    {
        $location->load(['vehicule', 'client', 'user']);

        return view('locations.show', compact('location'));
    }

    public function edit(Location $location)
    {
        $vehicules = Vehicule::where('statut', 'disponible')->orWhere('id', $location->vehicule_id)->orderBy('marque')->get();
        $clients = Client::orderBy('nom')->get();

        return view('locations.form', compact('location', 'vehicules', 'clients'));
    }

    public function update(Request $request, Location $location)
    {
        $data = $this->validated($request);
        $data['montant_total'] = $this->calculerMontant($data);

        $location->update($data);

        if ($location->statut === 'en_cours') {
            $location->vehicule->update(['statut' => 'loue']);
        } elseif (in_array($location->statut, ['terminee', 'annulee']) && $location->vehicule->statut === 'loue') {
            $location->vehicule->update(['statut' => 'disponible']);
        }

        return redirect()->route('locations.index')->with('success', 'Location mise à jour avec succès.');
    }

    public function destroy(Location $location)
    {
        if ($location->vehicule && $location->vehicule->statut === 'loue') {
            $location->vehicule->update(['statut' => 'disponible']);
        }

        $location->delete();

        return redirect()->route('locations.index')->with('success', 'Location supprimée avec succès.');
    }

    private function calculerMontant(array $data): float
    {
        $debut = Carbon::parse($data['date_debut']);
        $fin = Carbon::parse($data['date_fin']);
        $jours = max(1, $debut->diffInDays($fin) + 1);

        return round($jours * (float) $data['prix_jour'], 2);
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'vehicule_id' => ['required', 'exists:vehicules,id'],
            'client_id' => ['required', 'exists:clients,id'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date', 'after_or_equal:date_debut'],
            'prix_jour' => ['required', 'numeric', 'min:0'],
            'caution' => ['nullable', 'numeric', 'min:0'],
            'statut' => ['required', 'in:reservee,en_cours,terminee,annulee'],
            'notes' => ['nullable', 'string'],
        ]);
    }
}
