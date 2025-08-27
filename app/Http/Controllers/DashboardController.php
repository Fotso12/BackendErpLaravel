<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Entreprise;
use App\Models\Client;
use App\Models\Equipement;
use App\Models\Mission;
use App\Models\Fournisseur;
use App\Models\EntreeStock;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Récupère les statistiques générales du dashboard
     */
    public function getStats(Request $request)
    {
        try {
            $stats = [
                'utilisateurs' => Utilisateur::count(),
                'entreprises' => Entreprise::count(),
                'clients' => Client::count(),
                'equipements' => Equipement::count(),
                'missions' => Mission::count(),
                'fournisseurs' => Fournisseur::count(),
                'stockFaible' => $this->getStockFaible(),
                'missionsEnCours' => $this->getMissionsEnCours(),
                'missionsTerminees' => $this->getMissionsTerminees(),
                'missionsEnAttente' => $this->getMissionsEnAttente(),
            ];

            return response()->json($stats);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors du chargement des statistiques',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Récupère les statistiques pour un utilisateur spécifique
     */
    public function getUserStats(Request $request)
    {
        try {
            $userId = $request->user()->id;
            
            $userStats = [
                'missionsAssignees' => Mission::whereHas('utilisateurs', function($query) use ($userId) {
                    $query->where('utilisateur_id', $userId);
                })->count(),
                'missionsEnCours' => Mission::whereHas('utilisateurs', function($query) use ($userId) {
                    $query->where('utilisateur_id', $userId);
                })->where('date_debut', '<=', now())
                  ->where('date_fin', '>=', now())
                  ->count(),
                'missionsTerminees' => Mission::whereHas('utilisateurs', function($query) use ($userId) {
                    $query->where('utilisateur_id', $userId);
                })->where('date_fin', '<', now())->count(),
            ];

            return response()->json($userStats);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors du chargement des statistiques utilisateur',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Récupère le nombre d'équipements en stock faible
     */
    private function getStockFaible()
    {
        // Pour l'instant, on retourne 0 car la propriété quantite_stock n'existe pas
        // Cette logique peut être implémentée plus tard avec les tables de stock
        return 0;
    }

    /**
     * Récupère le nombre de missions en cours
     */
    private function getMissionsEnCours()
    {
        return Mission::where('date_debut', '<=', now())
                     ->where('date_fin', '>=', now())
                     ->count();
    }

    /**
     * Récupère le nombre de missions terminées
     */
    private function getMissionsTerminees()
    {
        return Mission::where('date_fin', '<', now())->count();
    }

    /**
     * Récupère le nombre de missions en attente
     */
    private function getMissionsEnAttente()
    {
        return Mission::where('date_debut', '>', now())->count();
    }
} 