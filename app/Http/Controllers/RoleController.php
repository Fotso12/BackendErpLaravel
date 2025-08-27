<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Affiche la liste de tous les rôles.
     */
    public function index()
    {
        return Role::with('permissions')->get();
    }

    /**
     * Crée un nouveau rôle.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|unique:roles,nom',
            'description' => 'nullable|string',
        ]);
        $role = Role::create($validated);
        return response()->json($role, 201);
    }

    /**
     * Affiche les détails d'un rôle spécifique.
     */
    public function show(Role $role)
    {
        return $role->load('permissions');
    }

    /**
     * Met à jour les informations d'un rôle.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'nom' => [
                'sometimes', 'required', 'string',
                Rule::unique('roles')->ignore($role->id),
            ],
            'description' => 'nullable|string',
        ]);
        $role->update($validated);
        return response()->json($role);
    }

    /**
     * Supprime un rôle.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['message' => 'Rôle supprimé avec succès.']);
    }

    /**
     * Attribue des permissions à un rôle.
     */
    public function syncPermissions(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $validated = $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);
        $role->permissions()->sync($validated['permissions'] ?? []);
        return response()->json(['message' => 'Permissions synchronisées.', 'permissions' => $role->permissions]);
    }
}
