<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;
    // Les champs pouvant être remplis en masse
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'client_id',
        'actif'
    ];

    /**
     * Un contact appartient à un client.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
