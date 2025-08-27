<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rapport extends Model
{
    protected $table = 'rapports';

    protected $fillable = [
        'utilisateur_id',
        'type',
        'titre',
        'format',
        'fichier_path'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Relation avec l'utilisateur qui a créé le rapport
     */
    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class);
    }
} 