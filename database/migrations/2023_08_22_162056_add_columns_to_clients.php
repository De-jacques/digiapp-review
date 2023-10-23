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
        Schema::table('clients', function (Blueprint $table) {
            $table->enum('regime', ['TEE', 'RME', 'RSI', 'RNI', 'GOOV', 'ETR', 'P.L'])->default('TEE');
            $table->string('regime_path')->nullable();
            $table->enum('domiciliation', ['Locale', 'Etrangere'])->default('Locale');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('regime');
            $table->dropColumn('regime_path');
            $table->dropColumn('domiciliation');
        });
    }
};
