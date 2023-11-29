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
        if(!Schema::hasColumn('proformas', 'status_facture')) ; 
        {
            Schema::table('proformas', function (Blueprint $table)
            {
                $table->dropColumn('status_facture');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('proformas', function (Blueprint $table) {
        //     $table->boolean('status_facture')->default(0);
        // });
    }
};
