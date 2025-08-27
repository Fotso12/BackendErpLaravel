<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Contact;

class ClientController extends Controller
{
    /**
     * Affiche la liste de tous les clients.
     */
    public function index()
    {
        // Récupère tous les clients avec leurs contacts
        return Client::with('contacts')->get();
    }

    /**
     * Crée un nouveau client.
     */
    public function store(Request $request)
    {
        // Validation des données reçues
        $validated = $request->validate([
            'nom' => 'required|string',
            'adresse' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|email|unique:clients,email',
            'entreprise_id' => 'required|exists:entreprises,id',
        ]);
        // Création du client
        $client = Client::create($validated + ['actif' => true]);
        return response()->json($client, 201);
    }

    /**
     * Affiche les détails d'un client spécifique.
     */
    public function show(Client $client)
    {
        return $client->load('contacts');
    }

    /**
     * Met à jour les informations d'un client.
     */
    public function update(Request $request, Client $client)
    {
        // Validation des données reçues
        $validated = $request->validate([
            'nom' => 'sometimes|required|string',
            'adresse' => 'sometimes|required|string',
            'telephone' => 'sometimes|required|string',
            'email' => [
                'sometimes', 'required', 'email',
                Rule::unique('clients')->ignore($client->id),
            ],
            'entreprise_id' => 'sometimes|required|exists:entreprises,id',
        ]);
        $client->update($validated);
        return response()->json($client);
    }

    /**
     * Supprime un client.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(['message' => 'Client supprimé avec succès.']);
    }

    /**
     * Active ou désactive un client.
     */
    public function activerDesactiver($id)
    {
        $client = Client::findOrFail($id);
        $client->actif = !$client->actif;
        $client->save();
        return response()->json(['message' => 'Statut modifié.', 'actif' => $client->actif]);
    }

    /**
     * Ajoute un contact à un client.
     */
    public function ajouterContact(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $validated = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email',
            'telephone' => 'required|string',
        ]);
        $contact = $client->contacts()->create($validated + ['actif' => true]);
        return response()->json($contact, 201);
    }
}
