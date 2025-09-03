<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Role;
use App\Mail\UserCredentialsMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class UtilisateurController extends Controller
{
    /**
     * Affiche la liste de tous les utilisateurs.
     */
    public function index()
    {
        // Récupère tous les utilisateurs avec leur rôle
        $users = Utilisateur::all();
        // return Utilisateur::with('role')->get();
        return response()->json($users, 200);
    }

    /**
     * Crée un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        try {
            Log::info('Tentative de création d\'utilisateur', [
                'request_data' => $request->all(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            // Validation des données reçues avec messages personnalisés
            $validated = $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|email|unique:utilisateurs,email',
                'mot_de_passe' => 'required|string|min:8',
                'role_id' => 'required|exists:roles,id',
                'actif' => 'sometimes|boolean',
            ], [
                'nom.required' => 'Le nom est obligatoire.',
                'prenom.required' => 'Le prénom est obligatoire.',
                'email.required' => 'L\'email est obligatoire.',
                'email.email' => 'L\'email doit être une adresse valide.',
                'email.unique' => 'Cet email est déjà utilisé par un autre utilisateur.',
                'mot_de_passe.required' => 'Le mot de passe est obligatoire.',
                'mot_de_passe.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
                'role_id.required' => 'Le rôle est obligatoire.',
                'role_id.exists' => 'Le rôle sélectionné n\'existe pas.',
            ]);

            // Vérifier si l'email existe déjà
            if (Utilisateur::where('email', $validated['email'])->exists()) {
                Log::warning('Tentative de création avec email existant', [
                    'email' => $validated['email']
                ]);
                return response()->json([
                    'message' => 'Cet email est déjà utilisé',
                    'errors' => ['email' => ['Cet email est déjà utilisé par un autre utilisateur']]
                ], 422);
            }

            // Génération d'un mot de passe temporaire si non fourni
            $mot_de_passe = $validated['mot_de_passe'] ?? Str::random(10);

            // Création de l'utilisateur
            $utilisateur = Utilisateur::create([
                'nom' => $validated['nom'],
                'prenom' => $validated['prenom'],
                'email' => $validated['email'],
                'mot_de_passe' => Hash::make($mot_de_passe),
                'role_id' => $validated['role_id'],
                'actif' => $validated['actif'] ?? true,
            ]);

            Log::info('Utilisateur créé avec succès', [
                'user_id' => $utilisateur->id,
                'email' => $utilisateur->email
            ]);

            // Envoi de l'email avec les identifiants
            try {
                Mail::to($utilisateur->email)->send(new UserCredentialsMail($utilisateur, $mot_de_passe));
                Log::info('Email envoyé avec succès', [
                    'user_id' => $utilisateur->id,
                    'email' => $utilisateur->email
                ]);
            } catch (\Exception $e) {
                // Log l'erreur mais ne pas échouer la création de l'utilisateur
                Log::error('Erreur envoi email: ' . $e->getMessage(), [
                    'user_id' => $utilisateur->id,
                    'email' => $utilisateur->email
                ]);
            }

            return response()->json([
                'utilisateur' => $utilisateur->load('role'),
                'message' => 'Utilisateur créé avec succès. Un email avec les identifiants a été envoyé.'
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation échouée lors de la création d\'utilisateur', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'message' => 'Les données fournies sont invalides',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création d\'utilisateur', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'message' => 'Une erreur est survenue lors de la création de l\'utilisateur',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Affiche les détails d'un utilisateur spécifique.
     */
    public function show(Utilisateur $utilisateur)
    {
        return $utilisateur->load('role');
    }

    /**
     * Met à jour les informations d'un utilisateur.
     */
    public function update(Request $request, Utilisateur $utilisateur)
    {
        // Validation des données reçues avec messages personnalisés
        $validated = $request->validate([
            'nom' => 'sometimes|string|max:255',
            'prenom' => 'sometimes|string|max:255',
            'email' => [
                'sometimes',
                'email',
                Rule::unique('utilisateurs')->ignore($utilisateur->id),
            ],
            'mot_de_passe' => 'sometimes|nullable|string|min:8',
            'role_id' => 'sometimes|exists:roles,id',
            'actif' => 'sometimes|boolean',
        ], [
            'email.email' => 'L\'email doit être une adresse valide.',
            'email.unique' => 'Cet email est déjà utilisé par an autre utilisateur.',
            'mot_de_passe.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'role_id.exists' => 'Le rôle sélectionné n\'existe pas.',
        ]);

        // Préparation des données à mettre à jour
        $updateData = [];

        if ($request->has('nom')) {
            $updateData['nom'] = $validated['nom'];
        }

        if ($request->has('prenom')) {
            $updateData['prenom'] = $validated['prenom'];
        }

        if ($request->has('email')) {
            $updateData['email'] = $validated['email'];
        }

        if ($request->has('mot_de_passe') && !empty($validated['mot_de_passe'])) {
            $updateData['mot_de_passe'] = Hash::make($validated['mot_de_passe']);
        }

        if ($request->has('role_id')) {
            $updateData['role_id'] = $validated['role_id'];
        }

        if ($request->has('actif')) {
            $updateData['actif'] = $validated['actif'];
        }

        // Mise à jour uniquement si des données sont fournies
        if (!empty($updateData)) {
            $utilisateur->update($updateData);
        }

        return response()->json([
            'message' => 'Utilisateur modifié avec succès',
            'utilisateur' => $utilisateur->fresh()->load('role')
        ]);
    }

    /**
     * Supprime un utilisateur.
     */
    public function destroy(Utilisateur $utilisateur)
    {
        $utilisateur->delete();
        return response()->json(['message' => 'Utilisateur supprimé avec succès.']);
    }

    /**
     * Active ou désactive un utilisateur.
     */
    public function activerDesactiver($id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->actif = !$utilisateur->actif;
        $utilisateur->save();
        return response()->json(['message' => 'Statut modifié.', 'actif' => $utilisateur->actif]);
    }

    /**
     * Change le rôle d'un utilisateur.
     */
    public function changerRole(Request $request, $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);
        $utilisateur->role_id = $request->role_id;
        $utilisateur->save();
        return response()->json(['message' => 'Rôle modifié.', 'role' => $utilisateur->role]);
    }

    /**
     * Authentifie un utilisateur et retourne un token.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $utilisateur = Utilisateur::where('email', $credentials['email'])->first();
        if (!$utilisateur || !\Illuminate\Support\Facades\Hash::check($credentials['password'], $utilisateur->mot_de_passe)) {
            return response()->json(['message' => 'Identifiants invalides.'], 401);
        }
        if (!$utilisateur->actif) {
            return response()->json(['message' => 'Compte désactivé.'], 403);
        }
        $token = $utilisateur->createToken('auth_token')->plainTextToken;
        return response()->json([
            'utilisateur' => $utilisateur,
            'token' => $token,
        ]);
    }

    /**
     * Déconnecte l'utilisateur (révoque le token).
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Déconnexion réussie.']);
    }

    /**
     * Retourne l'utilisateur authentifié.
     */
    public function me(Request $request)
    {
        return response()->json($request->user()->load('role'));
    }

    /**
     * Change le mot de passe de l'utilisateur connecté.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_mot_de_passe' => 'required|string',
            'new_mot_de_passe' => 'required|string|min:8|confirmed',
            'new_mot_de_passe_confirmation' => 'required|string|min:8',
        ]);

        $utilisateur = $request->user();

        // Vérifier l'ancien mot de passe
        if (!Hash::check($request->current_mot_de_passe, $utilisateur->mot_de_passe)) {
            return response()->json(['message' => 'Le mot de passe actuel est incorrect.'], 400);
        }

        // Mettre à jour le mot de passe
        $utilisateur->mot_de_passe = Hash::make($request->new_mot_de_passe);
        $utilisateur->save();

        return response()->json(['message' => 'Mot de passe modifié avec succès.']);
    }

    /**
     * Réinitialise le mot de passe d'un utilisateur (admin seulement).
     */
    public function resetPassword(Request $request, $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);

        // Générer un nouveau mot de passe temporaire
        $newMot_de_passe = Str::random(10);

        // Mettre à jour le mot de passe
        $utilisateur->mot_de_passe = Hash::make($newMot_de_passe);
        $utilisateur->save();

        // Envoyer l'email avec le nouveau mot de passe
        try {
            Mail::to($utilisateur->email)->send(new UserCredentialsMail($utilisateur, $newMot_de_passe));
        } catch (\Exception $e) {
            Log::error('Erreur envoi email reset password: ' . $e->getMessage());
        }

        return response()->json([
            'message' => 'Mot de passe réinitialisé avec succès. Un email a été envoyé à l\'utilisateur.'
        ]);
    }
}
