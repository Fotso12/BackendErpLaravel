<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MissionController extends Controller
{
    /**
     * Affiche la liste de toutes les missions.
     */
    public function index()
    {
        return Mission::with(['utilisateurs.role', 'equipements'])->get();
    }

    /**
     * Affiche les missions d'un utilisateur spécifique.
     */
    public function userMissions(Request $request)
    {
        $userId = $request->user()->id;
        
        $missions = Mission::whereHas('utilisateurs', function($query) use ($userId) {
            $query->where('utilisateur_id', $userId);
        })->with(['utilisateurs.role', 'equipements'])->get();
        
        return response()->json($missions);
    }

    /**
     * Crée une nouvelle mission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'utilisateurs' => 'array',
            'utilisateurs.*' => 'exists:utilisateurs,id',
            'equipements' => 'array',
            'equipements.*' => 'exists:equipements,id',
        ]);
        $mission = Mission::create($validated);
        // Association des utilisateurs et équipements si fournis
        if (!empty($validated['utilisateurs'])) {
            $mission->utilisateurs()->sync($validated['utilisateurs']);
        }
        if (!empty($validated['equipements'])) {
            $mission->equipements()->sync($validated['equipements']);
        }
        return response()->json($mission->load(['utilisateurs.role', 'equipements']), 201);
    }

    /**
     * Affiche les détails d'une mission spécifique.
     */
    public function show(Mission $mission)
    {
        return $mission->load(['utilisateurs.role', 'equipements']);
    }

    /**
     * Met à jour les informations d'une mission.
     */
    public function update(Request $request, Mission $mission)
    {
        $validated = $request->validate([
            'nom' => 'sometimes|required|string',
            'description' => 'nullable|string',
            'date_debut' => 'sometimes|required|date',
            'date_fin' => 'sometimes|required|date',
            'utilisateurs' => 'array',
            'utilisateurs.*' => 'exists:utilisateurs,id',
            'equipements' => 'array',
            'equipements.*' => 'exists:equipements,id',
        ]);
        $mission->update($validated);
        // Mise à jour des associations si fournies
        if (isset($validated['utilisateurs'])) {
            $mission->utilisateurs()->sync($validated['utilisateurs']);
        }
        if (isset($validated['equipements'])) {
            $mission->equipements()->sync($validated['equipements']);
        }
        return response()->json($mission->load(['utilisateurs.role', 'equipements']));
    }

    /**
     * Supprime une mission.
     */
    public function destroy(Mission $mission)
    {
        $mission->delete();
        return response()->json(['message' => 'Mission supprimée avec succès.']);
    }
}
