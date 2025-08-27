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
        Schema::create('role_utilisateur', function (Blueprint $table) {
            $table->id();
            // Clé étrangère vers le rôle
            $table->unsignedBigInteger('role_id'); // Référence au rôle
            // Clé étrangère vers l'utilisateur
            $table->unsignedBigInteger('utilisateur_id'); // Référence à l'utilisateur
            $table->timestamps();

            // Définition des clés étrangères
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('utilisateur_id')->references('id')->on('utilisateurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_utilisateur');
    }
};
