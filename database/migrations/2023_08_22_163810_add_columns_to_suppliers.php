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
    Schema::table('suppliers', function (Blueprint $table) {
      $table->enum('regime', ['TEE', 'RME', 'RSI', 'RNI', 'ETR'])->default('TEE');
      $table->string('regime_path')->nullable();
      $table->enum('reglement', ['prepaye', 'postpaye'])->default('postpaye');
      $table->enum('domiciliation', ['Locale', 'Etrangre'])->default('Locale');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('suppliers', function (Blueprint $table) {
      $table->dropColumn('regime');
      $table->dropColumn('reglement');
      $table->dropColumn('regime_path');
      $table->dropColumn('domiciliation');
    });
  }
};
