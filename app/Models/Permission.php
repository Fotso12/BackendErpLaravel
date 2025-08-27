<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;
    // Les champs pouvant être remplis en masse
    protected $fillable = [
        'nom',
        'description'
    ];

    /**
     * Une permission peut être attribuée à plusieurs rôles (relation N:N).
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }

    /**
     * Une permission peut être attribuée à plusieurs utilisateurs (relation N:N).
     */
    public function utilisateurs(): BelongsToMany
    {
        return $this->belongsToMany(Utilisateur::class, 'permission_utilisateur');
    }
}
