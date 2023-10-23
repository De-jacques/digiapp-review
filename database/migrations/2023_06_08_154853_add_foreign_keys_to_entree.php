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
        Schema::table('entrees', function (Blueprint $table) {
            
            $table->unsignedBigInteger('entrepot_id')->nullable();
            $table->foreign('entrepot_id')->references('id')->on('entrepots');

            $table->unsignedBigInteger('provider_id')->nullable();
            $table->foreign('provider_id')->references('id')->on('providers');
     
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entrees', function (Blueprint $table) {
            //
            $table->dropForeign(['entrepot_id']);
            $table->dropColumn('entrepot_id');

            $table->dropForeign(['provider_id']);
            $table->dropColumn('provider_id');
        });
    }
};
