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
        Schema::create('transfert_argents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('client_id')->constrained('user_id')->onDelete('cascade');
            $table->foreignId('agence_transfert_id')->constrained('agences_transfert')->onDelete('cascade');
            $table->decimal('montant_a_envoyer', 10, 2);
            $table->decimal('montant_a_recevoir', 10, 2);
            $table->decimal('taxe', 10, 2);
            $table->decimal('taux_de_change', 10, 2);
            $table->string('destinateur_nom');
            $table->string('destinateur_prenom');
            $table->string('destinateur_telephone');
            $table->string('destinateur_email');
            $table->string('type_piece_identite');
            $table->string('numero_piece_identite');
            $table->enum('statut', ['En_attente', 'Validé'])->default('En_attente');
            $table->string('motif_du_transfert');
            $table->integer('numero_de_controle');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfert_argents');
    }
};
