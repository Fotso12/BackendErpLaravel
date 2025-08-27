<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Fournisseur;

class EquipementController extends Controller
{
    /**
     * Affiche la liste de tous les équipements.
     */
    public function index()
    {
        return Equipement::with('fournisseurs')->get();
    }

    /**
     * Crée un nouvel équipement.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'type' => 'required|string',
            'fournisseur_id' => 'nullable|exists:fournisseurs,id',
        ]);
        $equipement = Equipement::create($validated + ['actif' => true]);
        return response()->json($equipement, 201);
    }

    /**
     * Affiche les détails d'un équipement spécifique.
     */
    public function show(Equipement $equipement)
    {
        return $equipement->load('fournisseurs');
    }

    /**
     * Met à jour les informations d'un équipement.
     */
    public function update(Request $request, Equipement $equipement)
    {
        $validated = $request->validate([
            'nom' => 'sometimes|required|string',
            'type' => 'sometimes|required|string',
            'fournisseur_id' => 'nullable|exists:fournisseurs,id',
        ]);
        $equipement->update($validated);
        return response()->json($equipement);
    }

    /**
     * Supprime un équipement.
     */
    public function destroy(Equipement $equipement)
    {
        $equipement->delete();
        return response()->json(['message' => 'Équipement supprimé avec succès.']);
    }

    /**
     * Active ou désactive un équipement.
     */
    public function activerDesactiver($id)
    {
        $equipement = Equipement::findOrFail($id);
        $equipement->actif = !$equipement->actif;
        $equipement->save();
        return response()->json(['message' => 'Statut modifié.', 'actif' => $equipement->actif]);
    }

    /**
     * Ajoute un fournisseur à un équipement.
     */
    public function ajouterFournisseur(Request $request, $id)
    {
        $equipement = Equipement::findOrFail($id);
        $validated = $request->validate([
            'fournisseur_id' => 'required|exists:fournisseurs,id',
        ]);
        $equipement->fournisseurs()->attach($validated['fournisseur_id']);
        return response()->json(['message' => 'Fournisseur ajouté à l\'équipement.']);
    }
}
