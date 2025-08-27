<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipement extends Model
{
    use HasFactory;
    // Les champs pouvant être remplis en masse
    protected $fillable = [
        'nom',
        'type',
        'fournisseur_id',
        'actif'
    ];

    /**
     * Un équipement peut avoir un fournisseur principal.
     */
    public function fournisseur(): BelongsTo
    {
        return $this->belongsTo(Fournisseur::class);
    }

    /**
     * Un équipement peut avoir plusieurs fournisseurs (relation N:N).
     */
    public function fournisseurs(): BelongsToMany
    {
        return $this->belongsToMany(Fournisseur::class, 'equipement_fournisseur');
    }

    /**
     * Un équipement peut appartenir à plusieurs missions (relation N:N).
     */
    public function missions(): BelongsToMany
    {
        return $this->belongsToMany(Mission::class, 'equipement_mission');
    }

    /**
     * Un équipement peut appartenir à plusieurs familles (relation N:N).
     */
    public function familles(): BelongsToMany
    {
        return $this->belongsToMany(FamilleEquipement::class, 'equipement_famille_equipement', 'equipement_id', 'famille_equipement_id');
    }

    /**
     * Un équipement peut avoir plusieurs entrées de stock.
     */
    public function entreeStocks(): HasMany
    {
        return $this->hasMany(EntreeStock::class);
    }

    /**
     * Un équipement peut avoir plusieurs mouvements de stock.
     */
    public function mouvementStocks(): HasMany
    {
        return $this->hasMany(MouvementStock::class);
    }

    /**
     * Un équipement peut avoir plusieurs inventaires.
     */
    public function inventaires(): HasMany
    {
        return $this->hasMany(Inventaire::class);
    }
}
