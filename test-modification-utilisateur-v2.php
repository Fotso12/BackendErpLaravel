<?php
// Script de test amélioré pour vérifier la modification d'un utilisateur
// Utiliser : php test-modification-utilisateur-v2.php

// Configuration de base
$baseUrl = 'http://localhost:8000';
$token = 'YOUR_TOKEN_HERE'; // Remplacez par votre token réel
$userId = 1; // ID de l'utilisateur à tester

// Fonction de test améliorée
function testModification($testName, $method, $endpoint, $data = [], $token = null)
{
    global $baseUrl;

    echo "=== {$testName} ===\n";
    echo "Endpoint: {$endpoint}\n";
    echo "Données: " . json_encode($data) . "\n";

    $response = makeRequest($method, $endpoint, $data, $token);
    echo "Réponse: {$response}\n\n";

    return $response;
}

// Fonction de requête HTTP
function makeRequest($method, $endpoint, $data = [], $token = null)
{
    $ch = curl_init();

    $url = 'http://localhost:8000' . $endpoint;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    if (!empty($data)) {
        $payload = json_encode($data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    }

    $headers = ['Content-Type: application/json'];

    if (!empty($data)) {
        $headers[] = 'Content-Length: ' . strlen(json_encode($data));
    }

    if ($token) {
        $headers[] = 'Authorization: Bearer ' . $token;
    }

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    $result = "HTTP Code: {$httpCode}\n";
    if ($error) {
        $result .= "Erreur cURL: {$error}\n";
    }
    $result .= "Response: {$response}";

    return $result;
}

// Tests de modification
testModification(
    "Test 1: Modifier uniquement le statut actif",
    'PUT',
    "/api/utilisateurs/{$userId}",
    ['actif' => false],
    $token
);

testModification(
    "Test 2: Modifier nom et prénom",
    'PUT',
    "/api/utilisateurs/{$userId}",
    ['nom' => 'Dupont', 'prenom' => 'Jean'],
    $token
);

testModification(
    "Test 3: Modifier email",
    'PUT',
    "/api/utilisateurs/{$userId}",
    ['email' => 'jean.dupont@example.com'],
    $token
);

testModification(
    "Test 4: Modifier mot de passe",
    'PUT',
    "/api/utilisateurs/{$userId}",
    ['password' => 'nouveauMotDePasse123'],
    $token
);

testModification(
    "Test 5: Modifier plusieurs champs",
    'PUT',
    "/api/utilisateurs/{$userId}",
    [
        'nom' => 'Martin',
        'prenom' => 'Sophie',
        'actif' => true
    ],
    $token
);

// Test avec l'endpoint dédié
testModification(
    "Test 6: Utiliser l'endpoint activer/désactiver",
    'PATCH',
    "/api/utilisateurs/{$userId}/activer-desactiver",
    [],
    $token
);
