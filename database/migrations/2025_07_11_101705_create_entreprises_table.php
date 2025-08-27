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
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            // Nom de l'entreprise
            $table->string('nom')->unique(); // Le nom de l'entreprise (doit être unique)
            // Adresse de l'entreprise
            $table->string('adresse'); // L'adresse physique de l'entreprise
            // Secteur d'activité
            $table->string('secteur_activite'); // Le secteur d'activité de l'entreprise
            // Numéro de téléphone
            $table->string('telephone'); // Le numéro de téléphone de l'entreprise
            // Email de l'entreprise
            $table->string('email'); // L'adresse email de l'entreprise
            // Statut actif/inactif
            $table->boolean('actif')->default(true); // Statut d'activation de l'entreprise
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entreprises');
    }
};
