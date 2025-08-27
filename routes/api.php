<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\FilialeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\EntreeStockController;
use App\Http\Controllers\MouvementStockController;
use App\Http\Controllers\InventaireController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\FamilleEquipementController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RapportController;

// Authentification Sanctum
Route::post('login', [UtilisateurController::class, 'login']);
Route::post('logout', [UtilisateurController::class, 'logout'])->middleware('auth:sanctum');
Route::get('me', [UtilisateurController::class, 'me'])->middleware('auth:sanctum');

// Utilisateurs
Route::apiResource('utilisateurs', UtilisateurController::class);
Route::patch('utilisateurs/{id}/activer-desactiver', [UtilisateurController::class, 'activerDesactiver']);
Route::post('utilisateurs/change-password', [UtilisateurController::class, 'changePassword'])->middleware('auth:sanctum');
Route::post('utilisateurs/{id}/reset-password', [UtilisateurController::class, 'resetPassword']);

// Entreprises
Route::apiResource('entreprises', EntrepriseController::class);
Route::patch('entreprises/{id}/activer-desactiver', [EntrepriseController::class, 'activerDesactiver']);

// Filiales
Route::apiResource('filiales', FilialeController::class);
Route::patch('filiales/{id}/activer-desactiver', [FilialeController::class, 'activerDesactiver']);

// Clients
Route::apiResource('clients', ClientController::class);
Route::patch('clients/{id}/activer-desactiver', [ClientController::class, 'activerDesactiver']);

// Contacts
Route::apiResource('contacts', ContactController::class);
Route::patch('contacts/{id}/activer-desactiver', [ContactController::class, 'activerDesactiver']);

// Dépôts
Route::apiResource('depots', DepotController::class);
Route::patch('depots/{id}/activer-desactiver', [DepotController::class, 'activerDesactiver']);

// Équipements
Route::apiResource('equipements', EquipementController::class);
Route::patch('equipements/{id}/activer-desactiver', [EquipementController::class, 'activerDesactiver']);

// Fournisseurs
Route::apiResource('fournisseurs', FournisseurController::class);
Route::patch('fournisseurs/{id}/activer-desactiver', [FournisseurController::class, 'activerDesactiver']);

// Entrées de stock
Route::apiResource('entrees-stock', EntreeStockController::class);

// Mouvements de stock
Route::apiResource('mouvements-stock', MouvementStockController::class);

// Inventaires
Route::apiResource('inventaires', InventaireController::class);

// Missions
Route::apiResource('missions', MissionController::class);
Route::patch('missions/{id}/activer-desactiver', [MissionController::class, 'activerDesactiver']);
Route::get('missions/user/me', [MissionController::class, 'userMissions'])->middleware('auth:sanctum');

// Factures
Route::apiResource('factures', FactureController::class);

// Familles d'équipement
Route::apiResource('familles-equipement', FamilleEquipementController::class);
Route::patch('familles-equipement/{id}/activer-desactiver', [FamilleEquipementController::class, 'activerDesactiver']);

// Rôles
Route::apiResource('roles', RoleController::class);
Route::post('roles/{id}/permissions', [RoleController::class, 'syncPermissions']);

// Permissions
Route::apiResource('permissions', PermissionController::class);

// Dashboard Statistics
Route::get('dashboard/stats', [DashboardController::class, 'getStats'])->middleware('auth:sanctum');
Route::get('dashboard/user/stats', [DashboardController::class, 'getUserStats'])->middleware('auth:sanctum');

// Rapports
Route::post('rapports/missions', [RapportController::class, 'rapportMissions'])->middleware('auth:sanctum');
Route::post('rapports/activite', [RapportController::class, 'rapportActivite'])->middleware('auth:sanctum');
Route::get('rapports/mes-rapports', [RapportController::class, 'mesRapports'])->middleware('auth:sanctum');
Route::get('rapports/telecharger/{id}', [RapportController::class, 'telechargerRapport'])->middleware('auth:sanctum');
