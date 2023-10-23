<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // les produits samsung
        $produit = new \App\Models\Produit();
        $produit->designation = "TEST PRODUIT";
        $produit->prix_revient = 1;
        $produit->marge = 1;
        $produit->prix_vente = 1;
        // $produit->entrepot_id = 1;
        $produit->marque_id = 1;
        $produit->sub_category_id = 1;
        $produit->description = "
       TEST PRODUIT
       ";
        $produit->save();

    }

}