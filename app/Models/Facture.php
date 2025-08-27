<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Facture extends Model
{
    use HasFactory;
    // Les champs pouvant être remplis en masse
    protected $fillable = [
        'client_id',
        'montant',
        'date_echeance',
        'description'
    ];

    /**
     * Une facture appartient à un client.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
