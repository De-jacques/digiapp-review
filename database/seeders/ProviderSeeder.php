<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fournisseur = new \App\Models\Provider();
        $fournisseur->name = "PRESTATAIRE TEST";
        $fournisseur->email = "test@gmail.com";
        $fournisseur->country = "Côte d'ivoire";
        $fournisseur->city = "Abidjan";
        $fournisseur->municipality = "Cocoody";
        $fournisseur->contact = "0000000000";
        $fournisseur->status = "particulier";
        $fournisseur->balance = 0;
        $fournisseur->save();
    }
}