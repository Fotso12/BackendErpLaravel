<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;
    // Les champs pouvant être remplis en masse
    protected $fillable = [
        'nom',
        'description'
    ];

    /**
     * Un rôle peut être attribué à plusieurs utilisateurs.
     */
    public function utilisateurs(): HasMany
    {
        return $this->hasMany(Utilisateur::class);
    }

    /**
     * Un rôle peut avoir plusieurs permissions (relation N:N).
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

    /**
     * Un rôle peut être attribué à plusieurs utilisateurs (relation N:N, multi-rôles).
     */
    public function utilisateursMulti(): BelongsToMany
    {
        return $this->belongsToMany(Utilisateur::class, 'role_utilisateur');
    }
}
