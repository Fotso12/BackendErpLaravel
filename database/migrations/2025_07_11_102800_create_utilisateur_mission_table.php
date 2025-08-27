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
        Schema::create('utilisateur_mission', function (Blueprint $table) {
            $table->id();
            // Clé étrangère vers l'utilisateur
            $table->unsignedBigInteger('utilisateur_id'); // Référence à l'utilisateur
            // Clé étrangère vers la mission
            $table->unsignedBigInteger('mission_id'); // Référence à la mission
            $table->timestamps();

            // Définition des clés étrangères
            $table->foreign('utilisateur_id')->references('id')->on('utilisateurs')->onDelete('cascade');
            $table->foreign('mission_id')->references('id')->on('missions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateur_mission');
    }
};
