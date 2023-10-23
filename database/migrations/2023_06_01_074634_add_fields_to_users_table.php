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
            $table->string('signature')->nullable();
            $table->string('poste')->nullable();
            $table->string('departement')->nullable();
            $table->string('matricule')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('contact')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('signature');
            $table->dropColumn('poste');
            $table->dropColumn('departement');
            $table->dropColumn('matricule');
            $table->dropColumn('date_naissance');
            $table->dropColumn('contact');

        });
    }
};