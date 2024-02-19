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
        Schema::create('sortiestocks', function (Blueprint $table) {
            $table->id();
            $table->string('site', 100)->nullable();
            $table->string('motifid', 100)->nullable();
            $table->string('statutid', 100)->nullable();
            $table->string('fournisseurid', 100)->nullable();
            $table->string('quantite', 100)->nullable();
            $table->string('prixunite', 100)->nullable();
            $table->string('date', 100)->nullable();
            $table->string('note', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sortiestocks');
    }
};
