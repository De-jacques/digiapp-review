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
        Schema::table('bons', function(Blueprint $table) {
          $table->renameColumn('ref_bon', 'file_bon');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bons', function(Blueprint $table) {
            $table->renameColumn('ref_bon', 'file_bon');
        });
    }
};
