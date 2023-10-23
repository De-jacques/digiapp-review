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
        Schema::table('entree_iterms', function (Blueprint $table) {
            $table->unsignedBigInteger('produit_id')->nullable();
            $table->foreign('produit_id')->references('id')->on('produits');

            $table->unsignedBigInteger('entree_id')->nullable();
            $table->foreign('entree_id')->references('id')->on('entrees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entree_iterms', function (Blueprint $table) {
            $table->dropForeign(['produit_id']);
            $table->dropColumn('produit_id');

            $table->dropForeign(['entree_id']);
            $table->dropColumn('entree_id');
        });
    }
};