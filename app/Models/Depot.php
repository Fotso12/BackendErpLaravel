<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Depot extends Model
{
    use HasFactory;
    // Les champs pouvant être remplis en masse
    protected $fillable = [
        'nom',
        'adresse',
        'entreprise_id',
        'actif'
    ];

    /**
     * Un dépôt appartient à une entreprise.
     */
    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Entreprise::class);
    }

    /**
     * Un dépôt peut avoir plusieurs entrées de stock.
     */
    public function entreeStocks(): HasMany
    {
        return $this->hasMany(EntreeStock::class);
    }

    /**
     * Un dépôt peut avoir plusieurs mouvements de stock.
     */
    public function mouvementStocks(): HasMany
    {
        return $this->hasMany(MouvementStock::class);
    }

    /**
     * Un dépôt peut avoir plusieurs inventaires.
     */
    public function inventaires(): HasMany
    {
        return $this->hasMany(Inventaire::class);
    }
}
