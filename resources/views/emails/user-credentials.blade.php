<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Identifiants de connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 0 0 5px 5px;
        }
        .credentials {
            background-color: white;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
        }
        .field {
            margin: 10px 0;
        }
        .label {
            font-weight: bold;
            color: #495057;
        }
        .value {
            background-color: #e9ecef;
            padding: 5px 10px;
            border-radius: 3px;
            font-family: monospace;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 10px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Système ERP</h1>
        <p>Vos identifiants de connexion</p>
    </div>
    
    <div class="content">
        <p>Bonjour {{ $user->prenom }} {{ $user->nom }},</p>
        
        <p>Votre compte a été créé avec succès dans le système ERP. Voici vos identifiants de connexion :</p>
        
        <div class="credentials">
            <div class="field">
                <span class="label">Email :</span>
                <div class="value">{{ $user->email }}</div>
            </div>
            <div class="field">
                <span class="label">Mot de passe temporaire :</span>
                <div class="value">{{ $password }}</div>
            </div>
        </div>
        
        <div class="warning">
            <strong>Important :</strong> Pour des raisons de sécurité, nous vous recommandons fortement de changer votre mot de passe lors de votre première connexion.
        </div>
        
        <p>Vous pouvez maintenant vous connecter au système en utilisant ces identifiants.</p>
        
        <p>Cordialement,<br>
        L'équipe du système ERP</p>
    </div>
    
    <div class="footer">
        <p>Cet email a été envoyé automatiquement. Veuillez ne pas y répondre.</p>
    </div>
</body>
</html> 