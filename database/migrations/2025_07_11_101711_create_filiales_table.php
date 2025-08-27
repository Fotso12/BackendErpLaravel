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
        Schema::create('filiales', function (Blueprint $table) {
            $table->id();
            // Nom de la filiale
            $table->string('nom'); // Le nom de la filiale
            // Adresse de la filiale
            $table->string('adresse'); // L'adresse physique de la filiale
            // Secteur d'activité
            $table->string('secteur_activite'); // Le secteur d'activité de la filiale
            // Numéro de téléphone
            $table->string('telephone'); // Le numéro de téléphone de la filiale
            // Email de la filiale
            $table->string('email'); // L'adresse email de la filiale
            // Référence à l'entreprise mère
            $table->unsignedBigInteger('entreprise_id'); // Clé étrangère vers l'entreprise mère
            // Statut actif/inactif
            $table->boolean('actif')->default(true); // Statut d'activation de la filiale
            $table->timestamps();

            // Définition de la clé étrangère pour l'entreprise mère
            $table->foreign('entreprise_id')->references('id')->on('entreprises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filiales');
    }
};
