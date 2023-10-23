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
        Schema::create('serial_numbers', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();

            $table->foreign('product_id')->references('id')->on('produits');
            $table->unsignedBigInteger('product_id');

            $table->string('serial_number')->unique();

            $table->enum('status', ['stock', 'solde', 'returne']);

            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers');

            $table->unsignedBigInteger('provider_id')->nullable();
            $table->foreign('provider_id')->references('id')->on('providers');

            $table->unsignedBigInteger('entree_id')->nullable();
            $table->foreign('entree_id')->references('id')->on('entrees');

            $table->string('ref_entree')->nullable();

            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('clients');

            $table->unsignedBigInteger('sortie_id')->nullable();
            $table->foreign('sortie_id')->references('id')->on('sorties');

            $table->uuid('uuid_sortie')->nullable();
            $table->string('ref_sortie')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serial_numbers');
    }
};