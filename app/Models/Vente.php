<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    /** @use HasFactory<\Database\Factories\VenteFactory> */
    use HasFactory;

    protected $fillable = [
        'vehicule_id', 'client_id', 'user_id', 'prix_vente', 'date_vente',
        'mode_paiement', 'statut', 'notes',
    ];

    protected $casts = [
        'date_vente' => 'date',
        'prix_vente' => 'decimal:2',
    ];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
