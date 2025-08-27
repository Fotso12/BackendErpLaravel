<?php

namespace App\Http\Controllers;

use App\Models\Inventaire;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InventaireController extends Controller
{
    /**
     * Affiche la liste de tous les inventaires.
     */
    public function index()
    {
        return Inventaire::all();
    }

    /**
     * Crée un nouvel inventaire.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'depot_id' => 'required|exists:depots,id',
            'equipement_id' => 'required|exists:equipements,id',
            'quantite' => 'required|integer',
            'date_inventaire' => 'required|date',
        ]);
        $inventaire = Inventaire::create($validated);
        return response()->json($inventaire, 201);
    }

    /**
     * Affiche les détails d'un inventaire spécifique.
     */
    public function show(Inventaire $inventaire)
    {
        return $inventaire;
    }

    /**
     * Met à jour les informations d'un inventaire.
     */
    public function update(Request $request, Inventaire $inventaire)
    {
        $validated = $request->validate([
            'depot_id' => 'sometimes|required|exists:depots,id',
            'equipement_id' => 'sometimes|required|exists:equipements,id',
            'quantite' => 'sometimes|required|integer',
            'date_inventaire' => 'sometimes|required|date',
        ]);
        $inventaire->update($validated);
        return response()->json($inventaire);
    }

    /**
     * Supprime un inventaire.
     */
    public function destroy(Inventaire $inventaire)
    {
        $inventaire->delete();
        return response()->json(['message' => 'Inventaire supprimé avec succès.']);
    }
}
