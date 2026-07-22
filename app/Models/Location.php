<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory;

    protected $fillable = [
        'vehicule_id', 'client_id', 'user_id', 'date_debut', 'date_fin',
        'prix_jour', 'caution', 'montant_total', 'statut', 'notes',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'prix_jour' => 'decimal:2',
        'caution' => 'decimal:2',
        'montant_total' => 'decimal:2',
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

    public function getDureeJoursAttribute(): int
    {
        return $this->date_debut->diffInDays($this->date_fin) + 1;
    }
}
