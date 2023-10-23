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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['Normal','Distributeur','Partenaire','Goov'])->default('Normal');
            $table->string('nom');
            $table->string('pays');
            $table->string('ville');
            $table->string('commune');
            $table->string('contact');
            $table->string('email');
            $table->enum('status',['particulier','entreprise'])->default('particulier');
            $table->integer('solde')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
