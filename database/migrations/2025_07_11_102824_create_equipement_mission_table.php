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
        Schema::create('equipement_mission', function (Blueprint $table) {
            $table->id();
            // Clé étrangère vers l'équipement
            $table->unsignedBigInteger('equipement_id'); // Référence à l'équipement
            // Clé étrangère vers la mission
            $table->unsignedBigInteger('mission_id'); // Référence à la mission
            $table->timestamps();

            // Définition des clés étrangères
            $table->foreign('equipement_id')->references('id')->on('equipements')->onDelete('cascade');
            $table->foreign('mission_id')->references('id')->on('missions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipement_mission');
    }
};
