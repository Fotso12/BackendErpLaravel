<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Filiale;

class EntrepriseController extends Controller
{
    /**
     * Affiche la liste de toutes les entreprises.
     */
    public function index()
    {
        // Récupère toutes les entreprises avec leurs filiales
        return Entreprise::with('filiales')->get();
    }

    /**
     * Crée une nouvelle entreprise.
     */
    public function store(Request $request)
    {
        // Validation des données reçues
        $validated = $request->validate([
            'nom' => 'required|string|unique:entreprises,nom',
            'adresse' => 'required|string',
            'secteur_activite' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|email',
        ]);
        // Création de l'entreprise
        $entreprise = Entreprise::create($validated + ['actif' => true]);
        return response()->json($entreprise, 201);
    }

    /**
     * Affiche les détails d'une entreprise spécifique.
     */
    public function show(Entreprise $entreprise)
    {
        return $entreprise->load('filiales');
    }

    /**
     * Met à jour les informations d'une entreprise.
     */
    public function update(Request $request, Entreprise $entreprise)
    {
        // Validation des données reçues
        $validated = $request->validate([
            'nom' => [
                'sometimes', 'required', 'string',
                Rule::unique('entreprises')->ignore($entreprise->id),
            ],
            'adresse' => 'sometimes|required|string',
            'secteur_activite' => 'sometimes|required|string',
            'telephone' => 'sometimes|required|string',
            'email' => 'sometimes|required|email',
        ]);
        $entreprise->update($validated);
        return response()->json($entreprise);
    }

    /**
     * Supprime une entreprise.
     */
    public function destroy(Entreprise $entreprise)
    {
        $entreprise->delete();
        return response()->json(['message' => 'Entreprise supprimée avec succès.']);
    }

    /**
     * Active ou désactive une entreprise.
     */
    public function activerDesactiver($id)
    {
        $entreprise = Entreprise::findOrFail($id);
        $entreprise->actif = !$entreprise->actif;
        $entreprise->save();
        return response()->json(['message' => 'Statut modifié.', 'actif' => $entreprise->actif]);
    }

    /**
     * Crée une filiale pour une entreprise.
     */
    public function ajouterFiliale(Request $request, $id)
    {
        $entreprise = Entreprise::findOrFail($id);
        $validated = $request->validate([
            'nom' => 'required|string',
            'adresse' => 'required|string',
            'secteur_activite' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|email',
        ]);
        $filiale = $entreprise->filiales()->create($validated + ['actif' => true]);
        return response()->json($filiale, 201);
    }
}
