<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fournisseur = new \App\Models\Supplier();
        $fournisseur->name = "TEST FOURNISSEUR";
        $fournisseur->email = "test@gmail.pro";
        $fournisseur->country = "Côte d'ivoire";
        $fournisseur->city = "Abidjan";
        $fournisseur->municipality = "Cocoody";
        $fournisseur->contact = "0000000000";
        $fournisseur->status = "entreprise";
        $fournisseur->balance = 0;
        $fournisseur->save();


    }
}