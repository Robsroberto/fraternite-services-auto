<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    /** @use HasFactory<\Database\Factories\VehiculeFactory> */
    use HasFactory;

    protected $fillable = [
        'marque', 'modele', 'annee', 'immatriculation', 'couleur', 'carburant',
        'transmission', 'kilometrage', 'type_offre', 'prix_vente', 'prix_location_jour',
        'statut', 'description', 'image_path',
    ];

    protected $casts = [
        'prix_vente' => 'decimal:2',
        'prix_location_jour' => 'decimal:2',
    ];

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function getNomCompletAttribute(): string
    {
        return "{$this->marque} {$this->modele} ({$this->annee})";
    }

    public function scopeDisponibles($query)
    {
        return $query->where('statut', 'disponible');
    }
}
