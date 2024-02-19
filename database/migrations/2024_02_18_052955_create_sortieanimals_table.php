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
        Schema::create('sortieanimals', function (Blueprint $table) {
            $table->id();
            $table->string('site', 11)->nullable();
            $table->string('blocid', 11)->nullable();
            $table->string('animalid', 11)->nullable();
            $table->string('boxid', 11)->nullable();
            $table->string('numero', 50)->nullable();
            $table->string('quantite', 11)->nullable();
            $table->string('prixunite', 11)->nullable();
            $table->string('statut', 25)->nullable();
            $table->string('client', 50)->nullable();
            $table->string('sexe', 25)->nullable();
            $table->string('date', 15)->nullable();
            $table->string('note', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sortieanimals');
    }
};
