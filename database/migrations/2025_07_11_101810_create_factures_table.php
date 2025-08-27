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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            // Référence au client
            $table->unsignedBigInteger('client_id'); // Clé étrangère vers le client
            // Montant de la facture
            $table->decimal('montant', 10, 2); // Montant total de la facture
            // Date d'échéance
            $table->date('date_echeance'); // Date d'échéance de la facture
            // Description de la facture
            $table->text('description')->nullable(); // Description ou détails de la facture (optionnel)
            $table->timestamps();

            // Définition de la clé étrangère pour le client
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
