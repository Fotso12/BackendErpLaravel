<?php

namespace App\Http\Controllers;

use App\Models\MouvementStock;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MouvementStockController extends Controller
{
    /**
     * Affiche la liste de tous les mouvements de stock.
     */
    public function index()
    {
        return MouvementStock::all();
    }

    /**
     * Crée un nouveau mouvement de stock.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'depot_id' => 'required|exists:depots,id',
            'equipement_id' => 'required|exists:equipements,id',
            'type_mouvement' => 'required|in:entrée,sortie',
            'quantite' => 'required|integer',
            'date_mouvement' => 'required|date',
        ]);
        $mouvementStock = MouvementStock::create($validated);
        return response()->json($mouvementStock, 201);
    }

    /**
     * Affiche les détails d'un mouvement de stock spécifique.
     */
    public function show(MouvementStock $mouvementStock)
    {
        return $mouvementStock;
    }

    /**
     * Met à jour les informations d'un mouvement de stock.
     */
    public function update(Request $request, MouvementStock $mouvementStock)
    {
        $validated = $request->validate([
            'depot_id' => 'sometimes|required|exists:depots,id',
            'equipement_id' => 'sometimes|required|exists:equipements,id',
            'type_mouvement' => 'sometimes|required|in:entrée,sortie',
            'quantite' => 'sometimes|required|integer',
            'date_mouvement' => 'sometimes|required|date',
        ]);
        $mouvementStock->update($validated);
        return response()->json($mouvementStock);
    }

    /**
     * Supprime un mouvement de stock.
     */
    public function destroy(MouvementStock $mouvementStock)
    {
        $mouvementStock->delete();
        return response()->json(['message' => 'Mouvement de stock supprimé avec succès.']);
    }
}
