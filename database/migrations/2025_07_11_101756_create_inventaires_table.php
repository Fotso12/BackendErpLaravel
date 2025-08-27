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
        Schema::create('inventaires', function (Blueprint $table) {
            $table->id();
            // Référence au dépôt
            $table->unsignedBigInteger('depot_id'); // Clé étrangère vers le dépôt
            // Référence à l'équipement
            $table->unsignedBigInteger('equipement_id'); // Clé étrangère vers l'équipement
            // Quantité inventoriée
            $table->integer('quantite'); // Quantité d'équipement inventoriée
            // Date de l'inventaire
            $table->date('date_inventaire'); // Date de l'inventaire
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
        Schema::dropIfExists('inventaires');
    }
};
