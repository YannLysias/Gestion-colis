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
        Schema::create('groupages', function (Blueprint $table) {
            $table->id();
            $table->string('code_groupage')->unique();
            $table->string('douanier')->nullable();
            $table->string('vol')->nullable();
            $table->json('colis_ids');
            $table->decimal('poids_total', 10, 2)->default(0);
            $table->foreignId('agence_id')->constrained('agences_transfert');
            $table->foreignId('id_user')->constrained('users');
            $table->enum('statut', ['en_attente', 'en_cours', 'arrivé']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groupages');
    }
};
