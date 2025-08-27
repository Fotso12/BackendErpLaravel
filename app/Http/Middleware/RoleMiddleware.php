<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Vérifie si l'utilisateur authentifié possède le rôle requis.
     * Usage : route middleware('role:admin')
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Vérifie si l'utilisateur est authentifié et possède le rôle requis
        if (!Auth::check() || !$request->user()->role || $request->user()->role->nom !== $role) {
            // Retourne une erreur 403 si l'utilisateur n'a pas le bon rôle
            return response()->json(['message' => 'Accès refusé. Rôle requis : ' . $role], 403);
        }
        return $next($request);
    }
}
