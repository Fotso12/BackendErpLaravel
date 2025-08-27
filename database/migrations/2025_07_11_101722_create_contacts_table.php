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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            // Nom du contact
            $table->string('nom'); // Le nom du contact
            // Prénom du contact
            $table->string('prenom'); // Le prénom du contact
            // Email du contact
            $table->string('email'); // L'adresse email du contact
            // Téléphone du contact
            $table->string('telephone'); // Le numéro de téléphone du contact
            // Référence au client associé
            $table->unsignedBigInteger('client_id'); // Clé étrangère vers le client associé
            // Statut actif/inactif
            $table->boolean('actif')->default(true); // Statut d'activation du contact
            $table->timestamps();

            // Définition de la clé étrangère pour le client associé
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
