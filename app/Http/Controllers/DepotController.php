<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use Illuminate\Http\Request;

class DepotController extends Controller
{
    /**
     * Affiche la liste de tous les dépôts.
     */
    public function index()
    {
        return \App\Models\Depot::all();
    }

    /**
     * Crée un nouveau dépôt.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'adresse' => 'required|string',
            'entreprise_id' => 'required|integer|exists:entreprises,id',
            'actif' => 'boolean',
        ]);
        $depot = \App\Models\Depot::create($validated + ['actif' => $validated['actif'] ?? true]);
        return response()->json($depot, 201);
    }

    /**
     * Affiche les détails d'un dépôt spécifique.
     */
    public function show(\App\Models\Depot $depot)
    {
        return $depot;
    }

    /**
     * Met à jour les informations d'un dépôt.
     */
    public function update(Request $request, \App\Models\Depot $depot)
    {
        $validated = $request->validate([
            'nom' => 'sometimes|required|string',
            'adresse' => 'sometimes|required|string',
            'actif' => 'boolean',
        ]);
        $depot->update($validated);
        return response()->json($depot);
    }

    /**
     * Supprime un dépôt.
     */
    public function destroy(\App\Models\Depot $depot)
    {
        $depot->delete();
        return response()->json(['message' => 'Dépôt supprimé avec succès.']);
    }
}
