<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Utilisateur extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;
    // Les champs pouvant être remplis en masse
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'role_id',
        'actif'
    ];

    /**
     * Un utilisateur appartient à un rôle.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Un utilisateur peut avoir plusieurs missions (relation N:N).
     */
    public function missions(): BelongsToMany
    {
        return $this->belongsToMany(Mission::class, 'utilisateur_mission');
    }

    /**
     * Un utilisateur peut avoir plusieurs permissions directes (optionnel).
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_utilisateur');
    }

    /**
     * Un utilisateur peut avoir plusieurs rôles (optionnel, si multi-rôles).
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_utilisateur');
    }
}
