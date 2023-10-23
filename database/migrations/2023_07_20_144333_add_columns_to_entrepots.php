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
        Schema::table('entrepots', function (Blueprint $table) {
            $table->uuid('uuid')->nullable();
            $table->string('gerant')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entrepots', function (Blueprint $table) {
            $table->dropColumn('uuid');
            $table->dropColumn('gerant');
        });
    }
};