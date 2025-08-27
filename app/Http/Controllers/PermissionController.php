<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    /**
     * Affiche la liste de toutes les permissions.
     */
    public function index()
    {
        return Permission::all();
    }

    /**
     * Crée une nouvelle permission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|unique:permissions,nom',
            'description' => 'nullable|string',
        ]);
        $permission = Permission::create($validated);
        return response()->json($permission, 201);
    }

    /**
     * Affiche les détails d'une permission spécifique.
     */
    public function show(Permission $permission)
    {
        return $permission;
    }

    /**
     * Met à jour les informations d'une permission.
     */
    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'nom' => [
                'sometimes', 'required', 'string',
                Rule::unique('permissions')->ignore($permission->id),
            ],
            'description' => 'nullable|string',
        ]);
        $permission->update($validated);
        return response()->json($permission);
    }

    /**
     * Supprime une permission.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return response()->json(['message' => 'Permission supprimée avec succès.']);
    }
}
