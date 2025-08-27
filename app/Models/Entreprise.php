<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entreprise extends Model
{
    use HasFactory;

    // Les champs pouvant être remplis en masse
    protected $fillable = [
        'nom',
        'adresse',
        'secteur_activite',
        'telephone',
        'email',
        'actif'
    ];

    /**
     * Une entreprise peut avoir plusieurs filiales.
     */
    public function filiales(): HasMany
    {
        return $this->hasMany(Filiale::class);
    }

    /**
     * Une entreprise peut avoir plusieurs clients.
     */
    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    /**
     * Une entreprise peut avoir plusieurs dépôts.
     */
    public function depots(): HasMany
    {
        return $this->hasMany(Depot::class);
    }
}
