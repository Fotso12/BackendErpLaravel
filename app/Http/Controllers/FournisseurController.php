<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FournisseurController extends Controller
{
    /**
     * Affiche la liste de tous les fournisseurs.
     */
    public function index()
    {
        return Fournisseur::all();
    }

    /**
     * Crée un nouveau fournisseur.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'adresse' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|email',
        ]);
        $fournisseur = Fournisseur::create($validated);
        return response()->json($fournisseur, 201);
    }

    /**
     * Affiche les détails d'un fournisseur spécifique.
     */
    public function show(Fournisseur $fournisseur)
    {
        return $fournisseur;
    }

    /**
     * Met à jour les informations d'un fournisseur.
     */
    public function update(Request $request, Fournisseur $fournisseur)
    {
        $validated = $request->validate([
            'nom' => 'sometimes|required|string',
            'adresse' => 'sometimes|required|string',
            'telephone' => 'sometimes|required|string',
            'email' => 'sometimes|required|email',
        ]);
        $fournisseur->update($validated);
        return response()->json($fournisseur);
    }

    /**
     * Supprime un fournisseur.
     */
    public function destroy(Fournisseur $fournisseur)
    {
        $fournisseur->delete();
        return response()->json(['message' => 'Fournisseur supprimé avec succès.']);
    }
}
