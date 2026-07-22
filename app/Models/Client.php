<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;

    protected $fillable = [
        'nom', 'prenom', 'telephone', 'email', 'adresse', 'numero_piece', 'notes',
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
        return "{$this->prenom} {$this->nom}";
    }
}
