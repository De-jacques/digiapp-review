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
        Schema::table('produits', function (Blueprint $table) {
            $table->unsignedBigInteger('sub_category_id')->nullable();
            // $table->unsignedBigInteger('entrepot_id')->nullable();
            $table->unsignedBigInteger('marque_id')->nullable();

            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
            // $table->foreign('entrepot_id')->references('id')->on('entrepots');
            $table->foreign('marque_id')->references('id')->on('marques');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produits', function (Blueprint $table) {
            $table->dropForeign(['sub_category_id']);
            // $table->dropForeign(['entrepot_id']);
            $table->dropForeign(['marque_id']);

            $table->dropColumn('sub_category_id');
            // $table->dropColumn('entrepot_id');
            $table->dropColumn('marque_id');
        });
    }
};