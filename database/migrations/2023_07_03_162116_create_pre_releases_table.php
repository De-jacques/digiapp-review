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
        Schema::create('pre_releases', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('ref_sortie');
            $table->foreignId('customer_id')->nullable()->constrained('clients');
            $table->foreignId('entrepot_id')->nullable()->constrained('entrepots');
            $table->foreignId('proforma_id')->nullable()->constrained('proformas');
            $table->string('num_facture')->nullable();
            $table->foreignId('product_id')->nullable()->constrained('produits');
            $table->date('date')->nullable();
            $table->integer('qte_dmd')->nullable();
            $table->integer('qte_livre')->nullable();
            $table->integer('reste')->nullable();
            $table->string('observation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_releases');
    }
};