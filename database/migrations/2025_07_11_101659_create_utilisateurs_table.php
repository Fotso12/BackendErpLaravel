<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            // Nom de l'utilisateur
            $table->string('nom'); // Le nom de famille de l'utilisateur
            // Prénom de l'utilisateur
            $table->string('prenom'); // Le prénom de l'utilisateur
            // Email unique pour l'utilisateur
            $table->string('email')->unique(); // L'adresse email de l'utilisateur (doit être unique)
            // Mot de passe hashé
            $table->string('mot_de_passe'); // Le mot de passe de l'utilisateur (hashé)
            // Rôle de l'utilisateur (clé étrangère vers la table roles)
            $table->unsignedBigInteger('role_id'); // Référence au rôle de l'utilisateur
            // Statut actif/inactif
            $table->boolean('actif')->default(true); // Statut d'activation du compte utilisateur
            $table->rememberToken();
            $table->timestamps();

            // Définition de la clé étrangère pour le rôle
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
