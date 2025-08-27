<?php

namespace App\Http\Controllers;

use App\Models\FamilleEquipement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FamilleEquipementController extends Controller
{
    /**
     * Affiche la liste de toutes les familles d'équipement.
     */
    public function index()
    {
        return FamilleEquipement::all();
    }

    /**
     * Crée une nouvelle famille d'équipement.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'description' => 'nullable|string',
            'actif' => 'boolean',
        ]);
        $famille = FamilleEquipement::create($validated);
        return response()->json($famille, 201);
    }

    /**
     * Affiche les détails d'une famille d'équipement spécifique.
     */
    public function show(FamilleEquipement $familleEquipement)
    {
        return $familleEquipement;
    }

    /**
     * Met à jour les informations d'une famille d'équipement.
     */
    public function update(Request $request, FamilleEquipement $familleEquipement)
    {
        $validated = $request->validate([
            'nom' => 'sometimes|required|string',
            'description' => 'nullable|string',
            'actif' => 'boolean',
        ]);
        $familleEquipement->update($validated);
        return response()->json($familleEquipement);
    }

    /**
     * Supprime une famille d'équipement.
     */
    public function destroy(FamilleEquipement $familleEquipement)
    {
        $familleEquipement->delete();
        return response()->json(['message' => 'Famille d\'équipement supprimée avec succès.']);
    }

    /**
     * Active ou désactive une famille d'équipement.
     */
    public function activerDesactiver($id)
    {
        $famille = FamilleEquipement::findOrFail($id);
        $famille->actif = !$famille->actif;
        $famille->save();
        return response()->json(['message' => 'Statut modifié.', 'actif' => $famille->actif]);
    }
}
