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
        Schema::table('sortie_iterms', function (Blueprint $table) {
            $table->unsignedBigInteger('produit_id')->nullable();
            $table->foreign('produit_id')->references('id')->on('produits');
            $table->unsignedBigInteger('sortie_id')->nullable();
            $table->foreign('sortie_id')->references('id')->on('sorties');

            $table->string('ref_sortie')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sortie_iterms', function (Blueprint $table) {
            $table->dropForeign(['produit_id']);
            $table->dropColumn('produit_id');

            $table->dropForeign(['sortie_id']);
            $table->dropColumn('sortie_id');
            $table->dropColumn('ref_sortie');
        });
    }
};