<?php
// Script de test pour vérifier la modification d'un utilisateur
// Utiliser : php test-modification-utilisateur.php

// Configuration de base
$baseUrl = 'http://localhost:8000';
$token = 'YOUR_TOKEN_HERE'; // Remplacez par votre token réel
$userId = 1; // ID de l'utilisateur à tester

// Test 1: Modifier uniquement le statut actif
echo "=== Test 1: Modification du statut actif ===\n";
$data = ['actif' => false];
$response = makeRequest('PUT', "/api/utilisateurs/{$userId}", $data, $token);
echo "Réponse: " . $response . "\n\n";

// Test 2: Modifier plusieurs champs incluant actif
echo "=== Test 2: Modification multiple ===\n";
$data = [
    'nom' => 'TestNom',
    'prenom' => 'TestPrenom',
    'actif' => true
];
$response = makeRequest('PUT', "/api/utilisateurs/{$userId}", $data, $token);
echo "Réponse: " . $response . "\n\n";

// Test 3: Utiliser l'endpoint dédié activer/désactiver
echo "=== Test 3: Endpoint activer/désactiver ===\n";
$response = makeRequest('PATCH', "/api/utilisateurs/{$userId}/activer-desactiver", [], $token);
echo "Réponse: " . $response . "\n\n";

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
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        ]);
    }

    if ($token) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ]);
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return "HTTP Code: {$httpCode}\nResponse: {$response}";
}
