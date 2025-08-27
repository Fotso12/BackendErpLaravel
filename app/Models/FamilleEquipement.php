<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FamilleEquipement extends Model
{
    use HasFactory;
    // Les champs pouvant être remplis en masse
    protected $fillable = [
        'nom',
        'description',
        'actif'
    ];

    /**
     * Une famille d'équipement peut regrouper plusieurs équipements (relation N:N).
     */
    public function equipements(): BelongsToMany
    {
        return $this->belongsToMany(Equipement::class, 'equipement_famille_equipement', 'famille_equipement_id', 'equipement_id');
    }
}
