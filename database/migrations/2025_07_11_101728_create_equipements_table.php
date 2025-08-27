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
        Schema::create('equipements', function (Blueprint $table) {
            $table->id();
            // Nom de l'équipement
            $table->string('nom'); // Le nom de l'équipement
            // Type d'équipement
            $table->string('type'); // Le type ou la catégorie de l'équipement
            // Référence au fournisseur principal
            $table->unsignedBigInteger('fournisseur_id')->nullable(); // Clé étrangère vers le fournisseur principal (optionnel)
            // État de l'équipement (actif/inactif)
            $table->boolean('actif')->default(true); // Statut d'activation de l'équipement
            $table->timestamps();

            // Définition de la clé étrangère pour le fournisseur principal
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipements');
    }
};
