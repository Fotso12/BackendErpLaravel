<?php

namespace App\Http\Controllers;

use App\Models\Filiale;
use Illuminate\Http\Request;

class FilialeController extends Controller
{
    /**
     * Affiche la liste de toutes les filiales.
     */
    public function index()
    {
        return \App\Models\Filiale::all();
    }

    /**
     * Crée une nouvelle filiale.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'adresse' => 'required|string',
            'secteur_activite' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|email',
            'entreprise_id' => 'required|integer|exists:entreprises,id',
            'actif' => 'boolean',
        ]);
        $filiale = \App\Models\Filiale::create($validated + ['actif' => $validated['actif'] ?? true]);
        return response()->json($filiale, 201);
    }

    /**
     * Affiche les détails d'une filiale spécifique.
     */
    public function show(\App\Models\Filiale $filiale)
    {
        return $filiale;
    }

    /**
     * Met à jour les informations d'une filiale.
     */
    public function update(Request $request, \App\Models\Filiale $filiale)
    {
        $validated = $request->validate([
            'nom' => 'sometimes|required|string',
            'adresse' => 'sometimes|required|string',
            'secteur_activite' => 'sometimes|required|string',
            'telephone' => 'sometimes|required|string',
            'email' => 'sometimes|required|email',
            'entreprise_id' => 'sometimes|required|integer|exists:entreprises,id',
            'actif' => 'boolean',
        ]);
        $filiale->update($validated);
        return response()->json($filiale);
    }

    /**
     * Supprime une filiale.
     */
    public function destroy(\App\Models\Filiale $filiale)
    {
        $filiale->delete();
        return response()->json(['message' => 'Filiale supprimée avec succès.']);
    }
}
