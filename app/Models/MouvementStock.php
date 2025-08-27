<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MouvementStock extends Model
{
    use HasFactory;
    // Les champs pouvant être remplis en masse
    protected $fillable = [
        'depot_id',
        'equipement_id',
        'type_mouvement',
        'quantite',
        'date_mouvement'
    ];

    /**
     * Un mouvement de stock appartient à un dépôt.
     */
    public function depot(): BelongsTo
    {
        return $this->belongsTo(Depot::class);
    }

    /**
     * Un mouvement de stock concerne un équipement.
     */
    public function equipement(): BelongsTo
    {
        return $this->belongsTo(Equipement::class);
    }
}
