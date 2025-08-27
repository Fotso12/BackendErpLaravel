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
        Schema::create('permission_utilisateur', function (Blueprint $table) {
            $table->id();
            // Clé étrangère vers la permission
            $table->unsignedBigInteger('permission_id'); // Référence à la permission
            // Clé étrangère vers l'utilisateur
            $table->unsignedBigInteger('utilisateur_id'); // Référence à l'utilisateur
            $table->timestamps();

            // Définition des clés étrangères
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('utilisateur_id')->references('id')->on('utilisateurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_utilisateur');
    }
};
