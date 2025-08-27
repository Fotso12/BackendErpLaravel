# Documentation des Endpoints de l'API Backenderp

## Authentification

- **POST** `/login` : Authentifie un utilisateur.
- **POST** `/logout` : Déconnecte un utilisateur (middleware `auth:sanctum`).
- **GET** `/me` : Récupère les informations de l'utilisateur connecté (middleware `auth:sanctum`).

## Utilisateurs

- **GET** `/utilisateurs` : Récupère tous les utilisateurs.
- **POST** `/utilisateurs` : Crée un nouvel utilisateur.
- **GET** `/utilisateurs/{id}` : Récupère un utilisateur par ID.
- **PUT** `/utilisateurs/{id}` : Met à jour un utilisateur par ID.
- **DELETE** `/utilisateurs/{id}` : Supprime un utilisateur par ID.
- **PATCH** `/utilisateurs/{id}/activer-desactiver` : Active ou désactive un utilisateur.
- **POST** `/utilisateurs/change-password` : Change le mot de passe de l'utilisateur connecté (middleware `auth:sanctum`).
- **POST** `/utilisateurs/{id}/reset-password` : Réinitialise le mot de passe d'un utilisateur.

## Entreprises

- **GET** `/entreprises` : Récupère toutes les entreprises.
- **POST** `/entreprises` : Crée une nouvelle entreprise.
- **GET** `/entreprises/{id}` : Récupère une entreprise par ID.
- **PUT** `/entreprises/{id}` : Met à jour une entreprise par ID.
- **DELETE** `/entreprises/{id}` : Supprime une entreprise par ID.
- **PATCH** `/entreprises/{id}/activer-desactiver` : Active ou désactive une entreprise.

## Filiales

- **GET** `/filiales` : Récupère toutes les filiales.
- **POST** `/filiales` : Crée une nouvelle filiale.
- **GET** `/filiales/{id}` : Récupère une filiale par ID.
- **PUT** `/filiales/{id}` : Met à jour une filiale par ID.
- **DELETE** `/filiales/{id}` : Supprime une filiale par ID.
- **PATCH** `/filiales/{id}/activer-desactiver` : Active ou désactive une filiale.

## Clients

- **GET** `/clients` : Récupère tous les clients.
- **POST** `/clients` : Crée un nouveau client.
- **GET** `/clients/{id}` : Récupère un client par ID.
- **PUT** `/clients/{id}` : Met à jour un client par ID.
- **DELETE** `/clients/{id}` : Supprime un client par ID.
- **PATCH** `/clients/{id}/activer-desactiver` : Active ou désactive un client.

## Contacts

- **GET** `/contacts` : Récupère tous les contacts.
- **POST** `/contacts` : Crée un nouveau contact.
- **GET** `/contacts/{id}` : Récupère un contact par ID.
- **PUT** `/contacts/{id}` : Met à jour un contact par ID.
- **DELETE** `/contacts/{id}` : Supprime un contact par ID.
- **PATCH** `/contacts/{id}/activer-desactiver` : Active ou désactive un contact.

## Dépôts

- **GET** `/depots` : Récupère tous les dépôts.
- **POST** `/depots` : Crée un nouveau dépôt.
- **GET** `/depots/{id}` : Récupère un dépôt par ID.
- **PUT** `/depots/{id}` : Met à jour un dépôt par ID.
- **DELETE** `/depots/{id}` : Supprime un dépôt par ID.
- **PATCH** `/depots/{id}/activer-desactiver` : Active ou désactive un dépôt.

## Équipements

- **GET** `/equipements` : Récupère tous les équipements.
- **POST** `/equipements` : Crée un nouvel équipement.
- **GET** `/equipements/{id}` : Récupère un équipement par ID.
- **PUT** `/equipements/{id}` : Met à jour un équipement par ID.
- **DELETE** `/equipements/{id}` : Supprime un équipement par ID.
- **PATCH** `/equipements/{id}/activer-desactiver` : Active ou désactive un équipement.

## Fournisseurs

- **GET** `/fournisseurs` : Récupère tous les fournisseurs.
- **POST** `/fournisseurs` : Crée un nouveau fournisseur.
- **GET** `/fournisseurs/{id}` : Récupère un fournisseur par ID.
- **PUT** `/fournisseurs/{id}` : Met à jour un fournisseur par ID.
- **DELETE** `/fournisseurs/{id}` : Supprime un fournisseur par ID.
- **PATCH** `/fournisseurs/{id}/activer-desactiver` : Active ou désactive un fournisseur.

## Entrées de stock

- **GET** `/entrees-stock` : Récupère toutes les entrées de stock.
- **POST** `/entrees-stock` : Crée une nouvelle entrée de stock.
- **GET** `/entrees-stock/{id}` : Récupère une entrée de stock par ID.
- **PUT** `/entrees-stock/{id}` : Met à jour une entrée de stock par ID.
- **DELETE** `/entrees-stock/{id}` : Supprime une entrée de stock par ID.

## Mouvements de stock

- **GET** `/mouvements-stock` : Récupère tous les mouvements de stock.
- **POST** `/mouvements-stock` : Crée un nouveau mouvement de stock.
- **GET** `/mouvements-stock/{id}` : Récupère un mouvement de stock par ID.
- **PUT** `/mouvements-stock/{id}` : Met à jour un mouvement de stock par ID.
- **DELETE** `/mouvements-stock/{id}` : Supprime un mouvement de stock par ID.

## Inventaires

- **GET** `/inventaires` : Récupère tous les inventaires.
- **POST** `/inventaires` : Crée un nouvel inventaire.
- **GET** `/inventaires/{id}` : Récupère un inventaire par ID.
- **PUT** `/inventaires/{id}` : Met à jour un inventaire par ID.
- **DELETE** `/inventaires/{id}` : Supprime un inventaire par ID.

## Missions

- **GET** `/missions` : Récupère toutes les missions.
- **POST** `/missions` : Crée une nouvelle mission.
- **GET** `/missions/{id}` : Récupère une mission par ID.
- **PUT** `/missions/{id}` : Met à jour une mission par ID.
- **DELETE** `/missions/{id}` : Supprime une mission par ID.
- **PATCH** `/missions/{id}/activer-desactiver` : Active ou désactive une mission.
- **GET** `/missions/user/me` : Récupère les missions de l'utilisateur connecté (middleware `auth:sanctum`).

## Factures

- **GET** `/factures` : Récupère toutes les factures.
- **POST** `/factures` : Crée une nouvelle facture.
- **GET** `/factures/{id}` : Récupère une facture par ID.
- **PUT** `/factures/{id}` : Met à jour une facture par ID.
- **DELETE** `/factures/{id}` : Supprime une facture par ID.

## Familles d'équipement

- **GET** `/familles-equipement` : Récupère toutes les familles d'équipement.
- **POST** `/familles-equipement` : Crée une nouvelle famille d'équipement.
- **GET** `/familles-equipement/{id}` : Récupère une famille d'équipement par ID.
- **PUT** `/familles-equipement/{id}` : Met à jour une famille d'équipement par ID.
- **DELETE** `/familles-equipement/{id}` : Supprime une famille d'équipement par ID.
- **PATCH** `/familles-equipement/{id}/activer-desactiver` : Active ou désactive une famille d'équipement.

## Rôles

- **GET** `/roles` : Récupère tous les rôles.
- **POST** `/roles` : Crée un nouveau rôle.
- **GET** `/roles/{id}` : Récupère un rôle par ID.
- **PUT** `/roles/{id}` : Met à jour un rôle par ID.
- **DELETE** `/roles/{id}` : Supprime un rôle par ID.
- **POST** `/roles/{id}/permissions` : Synchronise les permissions d'un rôle.

## Permissions

- **GET** `/permissions` : Récupère toutes les permissions.
- **POST** `/permissions` : Crée une nouvelle permission.
- **GET** `/permissions/{id}` : Récupère une permission par ID.
- **PUT** `/permissions/{id}` : Met à jour une permission par ID.
- **DELETE** `/permissions/{id}` : Supprime une permission par ID.

## Statistiques du tableau de bord

- **GET** `/dashboard/stats` : Récupère les statistiques du tableau de bord (middleware `auth:sanctum`).
- **GET** `/dashboard/user/stats` : Récupère les statistiques de l'utilisateur connecté (middleware `auth:sanctum`).

## Rapports

- **POST** `/rapports/missions` : Crée un rapport de missions (middleware `auth:sanctum`).
- **POST** `/rapports/activite` : Crée un rapport d'activité (middleware `auth:sanctum`).
- **GET** `/rapports/mes-rapports` : Récupère les rapports de l'utilisateur connecté (middleware `auth:sanctum`).
- **GET** `/rapports/telecharger/{id}` : Télécharge un rapport par ID (middleware `auth:sanctum`).
