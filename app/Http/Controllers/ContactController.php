<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    /**
     * Affiche la liste de tous les contacts.
     */
    public function index()
    {
        return Contact::all();
    }

    /**
     * Crée un nouveau contact.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email',
            'telephone' => 'required|string',
            'client_id' => 'required|exists:clients,id',
        ]);
        $contact = Contact::create($validated + ['actif' => true]);
        return response()->json($contact, 201);
    }

    /**
     * Affiche les détails d'un contact spécifique.
     */
    public function show(Contact $contact)
    {
        return $contact;
    }

    /**
     * Met à jour les informations d'un contact.
     */
    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'nom' => 'sometimes|required|string',
            'prenom' => 'sometimes|required|string',
            'email' => 'sometimes|required|email',
            'telephone' => 'sometimes|required|string',
            'client_id' => 'sometimes|required|exists:clients,id',
        ]);
        $contact->update($validated);
        return response()->json($contact);
    }

    /**
     * Supprime un contact.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return response()->json(['message' => 'Contact supprimé avec succès.']);
    }

    /**
     * Active ou désactive un contact.
     */
    public function activerDesactiver($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->actif = !$contact->actif;
        $contact->save();
        return response()->json(['message' => 'Statut modifié.', 'actif' => $contact->actif]);
    }
}
