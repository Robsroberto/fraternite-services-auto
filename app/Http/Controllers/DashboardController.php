<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Vehicule;
use App\Models\Vente;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'vehicules_total' => Vehicule::count(),
            'vehicules_disponibles' => Vehicule::where('statut', 'disponible')->count(),
            'vehicules_vendus' => Vehicule::where('statut', 'vendu')->count(),
            'vehicules_loues' => Vehicule::where('statut', 'loue')->count(),
            'ca_ventes' => (float) Vente::where('statut', 'payee')->sum('prix_vente'),
            'ca_locations' => (float) Location::whereIn('statut', ['en_cours', 'terminee'])->sum('montant_total'),
            'locations_en_cours' => Location::where('statut', 'en_cours')->count(),
        ];

        $dernieresVentes = Vente::with(['vehicule', 'client'])->latest()->take(5)->get();
        $dernieresLocations = Location::with(['vehicule', 'client'])->latest()->take(5)->get();

        $ventesParMois = Vente::select(DB::raw("DATE_FORMAT(date_vente, '%Y-%m') as mois"), DB::raw('SUM(prix_vente) as total'))
            ->where('date_vente', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('mois')
            ->orderBy('mois')
            ->pluck('total', 'mois');

        return view('dashboard', compact('stats', 'dernieresVentes', 'dernieresLocations', 'ventesParMois'));
    }
}
