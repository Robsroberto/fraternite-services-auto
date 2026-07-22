<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Vehicule;
use App\Models\Vente;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    public function index(Request $request)
    {
        $ventes = Vente::with(['vehicule', 'client'])
            ->when($request->statut, fn ($q) => $q->where('statut', $request->statut))
            ->latest('date_vente')
            ->paginate(10)
            ->withQueryString();

        return view('ventes.index', compact('ventes'));
    }

    public function create(Request $request)
    {
        $vehicules = Vehicule::whereIn('statut', ['disponible'])->orWhere('id', $request->vehicule_id)->orderBy('marque')->get();
        $clients = Client::orderBy('nom')->get();

        return view('ventes.form', [
            'vente' => new Vente(),
            'vehicules' => $vehicules,
            'clients' => $clients,
            'selectedVehiculeId' => $request->vehicule_id,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['user_id'] = $request->user()->id;

        $vente = Vente::create($data);

        if ($vente->statut === 'payee') {
            $vente->vehicule->update(['statut' => 'vendu']);
        }

        return redirect()->route('ventes.index')->with('success', 'Vente enregistrée avec succès.');
    }

    public function show(Vente $vente)
    {
        $vente->load(['vehicule', 'client', 'user']);

        return view('ventes.show', compact('vente'));
    }

    public function edit(Vente $vente)
    {
        $vehicules = Vehicule::where('statut', 'disponible')->orWhere('id', $vente->vehicule_id)->orderBy('marque')->get();
        $clients = Client::orderBy('nom')->get();

        return view('ventes.form', compact('vente', 'vehicules', 'clients'));
    }

    public function update(Request $request, Vente $vente)
    {
        $data = $this->validated($request);
        $vente->update($data);

        if ($vente->statut === 'payee') {
            $vente->vehicule->update(['statut' => 'vendu']);
        } elseif ($vente->statut === 'annulee' && $vente->vehicule->statut === 'vendu') {
            $vente->vehicule->update(['statut' => 'disponible']);
        }

        return redirect()->route('ventes.index')->with('success', 'Vente mise à jour avec succès.');
    }

    public function destroy(Vente $vente)
    {
        if ($vente->vehicule && $vente->vehicule->statut === 'vendu') {
            $vente->vehicule->update(['statut' => 'disponible']);
        }

        $vente->delete();

        return redirect()->route('ventes.index')->with('success', 'Vente supprimée avec succès.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'vehicule_id' => ['required', 'exists:vehicules,id'],
            'client_id' => ['required', 'exists:clients,id'],
            'prix_vente' => ['required', 'numeric', 'min:0'],
            'date_vente' => ['required', 'date'],
            'mode_paiement' => ['required', 'in:especes,virement,mobile_money,cheque'],
            'statut' => ['required', 'in:en_attente,payee,annulee'],
            'notes' => ['nullable', 'string'],
        ]);
    }
}
