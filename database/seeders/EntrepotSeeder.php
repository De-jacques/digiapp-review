<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntrepotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $entrepot = new \App\Models\Entrepot();
        $entrepot->name = "TEST ENTREPOT";
        $entrepot->localisation = "TEST ENTREPOT";
        $entrepot->contact = "0111111111";
        $entrepot->gerant = "Gerant TEST";
        $entrepot->save();

    }
}