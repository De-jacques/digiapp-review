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
        Schema::table('sorties', function (Blueprint $table) {
            $table->unsignedBigInteger('entrepot_id')->nullable();
            $table->foreign('entrepot_id')->references('id')->on('entrepots');

            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('clients');
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sorties', function (Blueprint $table) {
            $table->dropForeign(['entrepot_id']);
            $table->dropColumn('entrepot_id');

            $table->dropForeign(['customer_id']);
            $table->dropColumn('customer_id');

        });
    }
};