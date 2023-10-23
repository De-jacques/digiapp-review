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
        Schema::table('fractionnements', function (Blueprint $table) {
            $table->unsignedBigInteger('proforma_id')->nullable();
            $table->foreign('proforma_id')->references('id')->on('proformas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fractionnements', function (Blueprint $table) {
            $table->dropForeign(['proforma_id']);
            $table->dropColumn('proforma_id');
        });
    }
};