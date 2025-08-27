<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Fournisseur extends Model
{
    use HasFactory;
    // Les champs pouvant être remplis en masse
    protected $fillable = [
        'nom',
        'adresse',
        'telephone',
        'email'
    ];

    /**
     * Un fournisseur peut être le fournisseur principal de plusieurs équipements.
     */
    public function equipementsPrincipaux(): HasMany
    {
        return $this->hasMany(Equipement::class, 'fournisseur_id');
    }

    /**
     * Un fournisseur peut fournir plusieurs équipements (relation N:N).
     */
    public function equipements(): BelongsToMany
    {
        return $this->belongsToMany(Equipement::class, 'equipement_fournisseur');
    }
}
