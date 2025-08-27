<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Filiale extends Model
{
    use HasFactory;
    // Les champs pouvant être remplis en masse
    protected $fillable = [
        'nom',
        'adresse',
        'secteur_activite',
        'telephone',
        'email',
        'entreprise_id',
        'actif'
    ];

    /**
     * Une filiale appartient à une entreprise mère.
     */
    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Entreprise::class);
    }
}
