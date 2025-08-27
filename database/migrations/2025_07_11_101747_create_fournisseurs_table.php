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
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            // Nom du fournisseur
            $table->string('nom'); // Le nom du fournisseur
            // Adresse du fournisseur
            $table->string('adresse'); // L'adresse du fournisseur
            // Téléphone du fournisseur
            $table->string('telephone'); // Le numéro de téléphone du fournisseur
            // Email du fournisseur
            $table->string('email'); // L'adresse email du fournisseur
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurs');
    }
};
