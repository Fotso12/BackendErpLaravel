# Corrections pour la gestion des utilisateurs - Statut actif/inactif

## Problèmes identifiés et résolutions

### 1. Création d'utilisateur avec statut inactif

**Problème** : Le champ `actif` n'était pas accessible lors de la création via l'API.

**Solution** : Le champ `actif` est déjà géré dans la méthode `store()` avec une valeur par défaut à `true`. Pour créer un utilisateur inactif, envoyez explicitement `"actif": false` dans votre requête POST.

### 2. Modification du statut actif/inactif

**Problème** : La méthode `update()` ne permettait pas de modifier le champ `actif`.

**Solution** : Ajout du champ `actif` dans la validation de la méthode `update()`.

## Exemples d'utilisation

### Créer un utilisateur inactif

```bash
curl -X POST http://localhost:8000/api/utilisateurs \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -d '{
    "nom": "Dupont",
    "prenom": "Jean",
    "email": "jean.dupont@example.com",
    "mot_de_passe": "password123",
    "role_id": 2,
    "actif": false
  }'
```

### Modifier le statut d'un utilisateur

```bash
curl -X PUT http://localhost:8000/api/utilisateurs/1 \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -d '{
    "actif": false
  }'
```

### Utiliser l'endpoint dédié pour activer/désactiver

```bash
curl -X POST http://localhost:8000/api/utilisateurs/1/activer-desactiver \
  -H "Authorization: Bearer YOUR_TOKEN"
```

## Changements effectués

- ✅ Ajout de la validation du champ `actif` dans la méthode `update()` du `UtilisateurController`
- ✅ Le champ accepte les valeurs booléennes (true/false)
- ✅ Aucune modification nécessaire pour la création (fonctionne déjà)

## Notes importantes

- Le champ `actif` est de type boolean
- Les valeurs acceptées sont : `true`, `false`, `1`, `0`
- L'endpoint `/activer-desactiver/{id}` reste disponible pour un basculement rapide
