<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;
    // Les champs pouvant être remplis en masse
    protected $fillable = [
        'nom',
        'adresse',
        'telephone',
        'email',
        'entreprise_id',
        'actif'
    ];

    /**
     * Un client appartient à une entreprise.
     */
    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Entreprise::class);
    }

    /**
     * Un client peut avoir plusieurs contacts.
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }
}
