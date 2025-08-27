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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            // Nom du client
            $table->string('nom'); // Le nom du client
            // Adresse du client
            $table->string('adresse'); // L'adresse du client
            // Numéro de téléphone
            $table->string('telephone'); // Le numéro de téléphone du client
            // Email du client
            $table->string('email')->unique(); // L'adresse email du client (doit être unique)
            // Référence à l'entreprise associée
            $table->unsignedBigInteger('entreprise_id'); // Clé étrangère vers l'entreprise associée
            // Statut actif/inactif
            $table->boolean('actif')->default(true); // Statut d'activation du client
            $table->timestamps();

            // Définition de la clé étrangère pour l'entreprise associée
            $table->foreign('entreprise_id')->references('id')->on('entreprises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
