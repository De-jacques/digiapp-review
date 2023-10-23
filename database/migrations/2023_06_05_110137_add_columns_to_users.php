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
        Schema::table('users', function (Blueprint $table) {
            $table->string('commune')->nullable();
            $table->string('quartier')->nullable();
            $table->enum('sexe',['masculin','feminin'])->default('masculin');
            $table->string('ville')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('commune');
            $table->dropColumn('quartier');
            $table->dropColumn('sexe');
            $table->dropColumn('ville');
        });
    }
};