<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mission extends Model
{
    use HasFactory;
    // Les champs pouvant être remplis en masse
    protected $fillable = [
        'nom',
        'description',
        'date_debut',
        'date_fin'
    ];

    /**
     * Une mission peut avoir plusieurs utilisateurs (relation N:N).
     */
    public function utilisateurs(): BelongsToMany
    {
        return $this->belongsToMany(Utilisateur::class, 'utilisateur_mission');
    }

    /**
     * Une mission peut avoir plusieurs équipements (relation N:N).
     */
    public function equipements(): BelongsToMany
    {
        return $this->belongsToMany(Equipement::class, 'equipement_mission');
    }
}
