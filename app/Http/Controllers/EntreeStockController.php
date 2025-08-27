<?php

namespace App\Http\Controllers;

use App\Models\EntreeStock;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EntreeStockController extends Controller
{
    /**
     * Affiche la liste de toutes les entrées de stock.
     */
    public function index()
    {
        return EntreeStock::all();
    }

    /**
     * Crée une nouvelle entrée de stock.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'depot_id' => 'required|exists:depots,id',
            'equipement_id' => 'required|exists:equipements,id',
            'quantite' => 'required|integer',
            'date_entree' => 'required|date',
        ]);
        $entreeStock = EntreeStock::create($validated);
        return response()->json($entreeStock, 201);
    }

    /**
     * Affiche les détails d'une entrée de stock spécifique.
     */
    public function show(EntreeStock $entreeStock)
    {
        return $entreeStock;
    }

    /**
     * Met à jour les informations d'une entrée de stock.
     */
    public function update(Request $request, EntreeStock $entreeStock)
    {
        $validated = $request->validate([
            'depot_id' => 'sometimes|required|exists:depots,id',
            'equipement_id' => 'sometimes|required|exists:equipements,id',
            'quantite' => 'sometimes|required|integer',
            'date_entree' => 'sometimes|required|date',
        ]);
        $entreeStock->update($validated);
        return response()->json($entreeStock);
    }

    /**
     * Supprime une entrée de stock.
     */
    public function destroy(EntreeStock $entreeStock)
    {
        $entreeStock->delete();
        return response()->json(['message' => 'Entrée de stock supprimée avec succès.']);
    }
}
