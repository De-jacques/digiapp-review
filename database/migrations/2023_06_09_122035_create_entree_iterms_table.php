<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('entree_iterms', function (Blueprint $table) {
            $table->id();
            //Quantité commandée
            $table->integer('qte_cmd')->nullable();
            // Quantité livrée
            $table->integer('qte_livre')->nullable();
            //Reste  à livréer
            $table->integer('reste')->nullable();

            $table->uuid('uuid')->nullable();
            
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entree_iterms');
    }
};