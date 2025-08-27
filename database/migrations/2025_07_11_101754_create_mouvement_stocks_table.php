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
        Schema::create('mouvement_stocks', function (Blueprint $table) {
            $table->id();
            // Référence au dépôt
            $table->unsignedBigInteger('depot_id'); // Clé étrangère vers le dépôt
            // Référence à l'équipement
            $table->unsignedBigInteger('equipement_id'); // Clé étrangère vers l'équipement
            // Type de mouvement (entrée/sortie)
            $table->enum('type_mouvement', ['entrée', 'sortie']); // Type de mouvement de stock
            // Quantité concernée
            $table->integer('quantite'); // Quantité d'équipement déplacée
            // Date du mouvement
            $table->date('date_mouvement'); // Date du mouvement de stock
            $table->timestamps();

            // Définition des clés étrangères
            $table->foreign('depot_id')->references('id')->on('depots')->onDelete('cascade');
            $table->foreign('equipement_id')->references('id')->on('equipements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvement_stocks');
    }
};
