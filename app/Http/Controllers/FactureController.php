<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FactureController extends Controller
{
    /**
     * Affiche la liste de toutes les factures.
     */
    public function index()
    {
        return Facture::all();
    }

    /**
     * Crée une nouvelle facture.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'montant' => 'required|numeric',
            'date_echeance' => 'required|date',
            'description' => 'nullable|string',
        ]);
        $facture = Facture::create($validated);
        return response()->json($facture, 201);
    }

    /**
     * Affiche les détails d'une facture spécifique.
     */
    public function show(Facture $facture)
    {
        return $facture;
    }

    /**
     * Met à jour les informations d'une facture.
     */
    public function update(Request $request, Facture $facture)
    {
        $validated = $request->validate([
            'client_id' => 'sometimes|required|exists:clients,id',
            'montant' => 'sometimes|required|numeric',
            'date_echeance' => 'sometimes|required|date',
            'description' => 'nullable|string',
        ]);
        $facture->update($validated);
        return response()->json($facture);
    }

    /**
     * Supprime une facture.
     */
    public function destroy(Facture $facture)
    {
        $facture->delete();
        return response()->json(['message' => 'Facture supprimée avec succès.']);
    }
}
