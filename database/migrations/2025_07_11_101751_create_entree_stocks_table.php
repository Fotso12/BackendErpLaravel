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
        Schema::create('entree_stocks', function (Blueprint $table) {
            $table->id();
            // Référence au dépôt
            $table->unsignedBigInteger('depot_id'); // Clé étrangère vers le dépôt
            // Référence à l'équipement
            $table->unsignedBigInteger('equipement_id'); // Clé étrangère vers l'équipement
            // Quantité entrée
            $table->integer('quantite'); // Quantité d'équipement entrée en stock
            // Date d'entrée
            $table->date('date_entree'); // Date de l'entrée en stock
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
        Schema::dropIfExists('entree_stocks');
    }
};
