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
        Schema::create('depots', function (Blueprint $table) {
            $table->id();
            // Nom du dépôt
            $table->string('nom'); // Le nom du dépôt
            // Adresse du dépôt
            $table->string('adresse'); // L'adresse du dépôt
            // Référence à l'entreprise associée
            $table->unsignedBigInteger('entreprise_id'); // Clé étrangère vers l'entreprise associée
            // Statut actif/inactif
            $table->boolean('actif')->default(true); // Statut d'activation du dépôt
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
        Schema::dropIfExists('depots');
    }
};
