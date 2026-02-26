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
        Schema::create('colis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('client_id')->constrained('user_id')->onDelete('cascade');
            $table->foreignId('agence_transfert_id')->constrained('agences_transfert')->onDelete('cascade');
            $table->decimal('poid', 10, 2);
            $table->string('type')->nullable();
            $table->enum('statut', ['en_attente', 'en_cours', 'arrivé', 'livré']);
            $table->enum('paiement', ['payé', 'non_payé', 'partiel']);
            $table->decimal('montant_avance', 10, 2)->default(0);
            $table->decimal('montant', 10, 2);
            $table->string('destinateur_nom');
            $table->string('destinateur_prenom');
            $table->string('destinateur_email')->nullable();
            $table->string('destinateur_telephone');
            $table->string('photo')->nullable();
            $table->string('code_colis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colis');
    }
};
