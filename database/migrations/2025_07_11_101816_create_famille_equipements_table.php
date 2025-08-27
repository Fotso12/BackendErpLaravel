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
        Schema::create('famille_equipements', function (Blueprint $table) {
            $table->id();
            // Nom de la famille d'équipement
            $table->string('nom'); // Le nom de la famille d'équipement
            // Description de la famille d'équipement
            $table->text('description')->nullable(); // Description ou détails de la famille (optionnel)
            // Statut actif/inactif
            $table->boolean('actif')->default(true); // Statut d'activation de la famille d'équipement
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('famille_equipements');
    }
};
