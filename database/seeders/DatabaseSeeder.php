<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Location;
use App\Models\User;
use App\Models\Vehicule;
use App\Models\Vente;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Cheikh Ahmadou Bamba Diallo',
            'email' => 'admin@fraternite-services.sn',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $gestionnaire = User::create([
            'name' => 'Fatou Ndiaye',
            'email' => 'gestion@fraternite-services.sn',
            'password' => 'password',
            'role' => 'gestionnaire',
        ]);

        $vehicules = [
            ['marque' => 'Toyota', 'modele' => 'Corolla', 'annee' => 2021, 'immatriculation' => 'DK-2451-AB', 'couleur' => 'Gris', 'carburant' => 'essence', 'transmission' => 'automatique', 'kilometrage' => 32000, 'type_offre' => 'vente_location', 'prix_vente' => 9500000, 'prix_location_jour' => 25000, 'statut' => 'disponible'],
            ['marque' => 'Hyundai', 'modele' => 'Tucson', 'annee' => 2022, 'immatriculation' => 'DK-3187-AC', 'couleur' => 'Blanc', 'carburant' => 'diesel', 'transmission' => 'automatique', 'kilometrage' => 18000, 'type_offre' => 'location', 'prix_vente' => null, 'prix_location_jour' => 35000, 'statut' => 'loue'],
            ['marque' => 'Peugeot', 'modele' => '208', 'annee' => 2020, 'immatriculation' => 'DK-1980-AD', 'couleur' => 'Rouge', 'carburant' => 'essence', 'transmission' => 'manuelle', 'kilometrage' => 45000, 'type_offre' => 'vente', 'prix_vente' => 6200000, 'prix_location_jour' => null, 'statut' => 'vendu'],
            ['marque' => 'Kia', 'modele' => 'Sportage', 'annee' => 2023, 'immatriculation' => 'DK-4502-AE', 'couleur' => 'Noir', 'carburant' => 'diesel', 'transmission' => 'automatique', 'kilometrage' => 5000, 'type_offre' => 'vente_location', 'prix_vente' => 13500000, 'prix_location_jour' => 40000, 'statut' => 'disponible'],
            ['marque' => 'Renault', 'modele' => 'Duster', 'annee' => 2021, 'immatriculation' => 'DK-2734-AF', 'couleur' => 'Bleu', 'carburant' => 'diesel', 'transmission' => 'manuelle', 'kilometrage' => 28000, 'type_offre' => 'location', 'prix_vente' => null, 'prix_location_jour' => 30000, 'statut' => 'disponible'],
            ['marque' => 'Toyota', 'modele' => 'Hilux', 'annee' => 2022, 'immatriculation' => 'DK-3956-AG', 'couleur' => 'Gris', 'carburant' => 'diesel', 'transmission' => 'manuelle', 'kilometrage' => 21000, 'type_offre' => 'vente_location', 'prix_vente' => 16800000, 'prix_location_jour' => 45000, 'statut' => 'disponible'],
            ['marque' => 'Suzuki', 'modele' => 'Swift', 'annee' => 2019, 'immatriculation' => 'DK-0871-AH', 'couleur' => 'Blanc', 'carburant' => 'essence', 'transmission' => 'manuelle', 'kilometrage' => 62000, 'type_offre' => 'vente', 'prix_vente' => 4800000, 'prix_location_jour' => null, 'statut' => 'disponible'],
            ['marque' => 'Hyundai', 'modele' => 'Accent', 'annee' => 2020, 'immatriculation' => 'DK-1345-AI', 'couleur' => 'Argent', 'carburant' => 'essence', 'transmission' => 'automatique', 'kilometrage' => 39000, 'type_offre' => 'location', 'prix_vente' => null, 'prix_location_jour' => 22000, 'statut' => 'maintenance'],
            ['marque' => 'Kia', 'modele' => 'Picanto', 'annee' => 2021, 'immatriculation' => 'DK-2298-AJ', 'couleur' => 'Jaune', 'carburant' => 'essence', 'transmission' => 'manuelle', 'kilometrage' => 30500, 'type_offre' => 'vente', 'prix_vente' => 5400000, 'prix_location_jour' => null, 'statut' => 'disponible'],
            ['marque' => 'Toyota', 'modele' => 'Land Cruiser', 'annee' => 2023, 'immatriculation' => 'DK-4890-AK', 'couleur' => 'Noir', 'carburant' => 'diesel', 'transmission' => 'automatique', 'kilometrage' => 9000, 'type_offre' => 'vente_location', 'prix_vente' => 32000000, 'prix_location_jour' => 65000, 'statut' => 'disponible'],
        ];

        $vehiculeModels = collect($vehicules)->map(fn ($v) => Vehicule::create($v));

        $clients = [
            ['nom' => 'Sow', 'prenom' => 'Moussa', 'telephone' => '+221 77 123 45 67', 'email' => 'moussa.sow@example.com', 'adresse' => 'Sacré-Cœur, Dakar', 'numero_piece' => 'SN0012345'],
            ['nom' => 'Ba', 'prenom' => 'Aissatou', 'telephone' => '+221 76 234 56 78', 'email' => 'aissatou.ba@example.com', 'adresse' => 'Parcelles Assainies, Dakar', 'numero_piece' => 'SN0023456'],
            ['nom' => 'Diop', 'prenom' => 'Ibrahima', 'telephone' => '+221 78 345 67 89', 'email' => null, 'adresse' => 'Grand Yoff, Dakar', 'numero_piece' => 'SN0034567'],
            ['nom' => 'Faye', 'prenom' => 'Mariama', 'telephone' => '+221 70 456 78 90', 'email' => 'mariama.faye@example.com', 'adresse' => 'Liberté 6, Dakar', 'numero_piece' => null],
            ['nom' => 'Gueye', 'prenom' => 'Abdoulaye', 'telephone' => '+221 77 567 89 01', 'email' => 'abdoulaye.gueye@example.com', 'adresse' => 'Yoff, Dakar', 'numero_piece' => 'SN0056789'],
            ['nom' => 'Ndiaye', 'prenom' => 'Khady', 'telephone' => '+221 76 678 90 12', 'email' => null, 'adresse' => 'Mermoz, Dakar', 'numero_piece' => 'SN0067890'],
            ['nom' => 'Fall', 'prenom' => 'Ousmane', 'telephone' => '+221 78 789 01 23', 'email' => 'ousmane.fall@example.com', 'adresse' => 'Ouakam, Dakar', 'numero_piece' => 'SN0078901'],
            ['nom' => 'Sarr', 'prenom' => 'Bineta', 'telephone' => '+221 70 890 12 34', 'email' => 'bineta.sarr@example.com', 'adresse' => 'Point E, Dakar', 'numero_piece' => 'SN0089012'],
        ];

        $clientModels = collect($clients)->map(fn ($c) => Client::create($c));

        // Vente : Peugeot 208 (index 2) vendue à Ibrahima Diop
        Vente::create([
            'vehicule_id' => $vehiculeModels[2]->id,
            'client_id' => $clientModels[2]->id,
            'user_id' => $admin->id,
            'prix_vente' => 6100000,
            'date_vente' => now()->subDays(18),
            'mode_paiement' => 'virement',
            'statut' => 'payee',
            'notes' => 'Négociation sur le prix initial, remise de 100 000 FCFA.',
        ]);

        // Vente en attente : Kia Picanto
        Vente::create([
            'vehicule_id' => $vehiculeModels[8]->id,
            'client_id' => $clientModels[4]->id,
            'user_id' => $gestionnaire->id,
            'prix_vente' => 5400000,
            'date_vente' => now()->subDays(2),
            'mode_paiement' => 'mobile_money',
            'statut' => 'en_attente',
        ]);

        // Location en cours : Hyundai Tucson (index 1)
        Location::create([
            'vehicule_id' => $vehiculeModels[1]->id,
            'client_id' => $clientModels[0]->id,
            'user_id' => $admin->id,
            'date_debut' => now()->subDays(3),
            'date_fin' => now()->addDays(4),
            'prix_jour' => 35000,
            'caution' => 100000,
            'montant_total' => 35000 * 8,
            'statut' => 'en_cours',
        ]);

        // Location terminée : Renault Duster
        Location::create([
            'vehicule_id' => $vehiculeModels[4]->id,
            'client_id' => $clientModels[5]->id,
            'user_id' => $gestionnaire->id,
            'date_debut' => now()->subDays(20),
            'date_fin' => now()->subDays(15),
            'prix_jour' => 30000,
            'caution' => 80000,
            'montant_total' => 30000 * 6,
            'statut' => 'terminee',
        ]);

        // Location réservée : Toyota Land Cruiser
        Location::create([
            'vehicule_id' => $vehiculeModels[9]->id,
            'client_id' => $clientModels[7]->id,
            'user_id' => $admin->id,
            'date_debut' => now()->addDays(5),
            'date_fin' => now()->addDays(10),
            'prix_jour' => 65000,
            'caution' => 300000,
            'montant_total' => 65000 * 6,
            'statut' => 'reservee',
        ]);
    }
}
