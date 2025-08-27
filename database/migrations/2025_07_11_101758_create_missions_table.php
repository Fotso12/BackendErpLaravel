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
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            // Nom de la mission
            $table->string('nom'); // Le nom de la mission
            // Description de la mission
            $table->text('description')->nullable(); // Description détaillée de la mission (optionnelle)
            // Date de début
            $table->date('date_debut'); // Date de début de la mission
            // Date de fin
            $table->date('date_fin'); // Date de fin de la mission
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
