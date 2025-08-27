<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
{
    /**
     * Vérifie si l'utilisateur authentifié possède la permission requise.
     * Usage : route middleware('permission:voir_utilisateurs')
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {
        // Vérifie si l'utilisateur est authentifié
        if (!Auth::check()) {
            return response()->json(['message' => 'Non authentifié.'], 401);
        }
        $user = $request->user();
        // Vérifie si l'utilisateur possède la permission (directe ou via un rôle)
        $hasPermission = $user->permissions->contains('nom', $permission) ||
            $user->role && $user->role->permissions->contains('nom', $permission);
        if (!$hasPermission) {
            return response()->json(['message' => 'Permission refusée : ' . $permission], 403);
        }
        return $next($request);
    }
}