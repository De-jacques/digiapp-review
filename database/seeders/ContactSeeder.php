<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $client = new \App\Models\Contact();
        $client->nom_du_contact = "TEST CONTACT CLIENT";
        $client->adresse_email = "test@gmail.com";
        $client->numero_telephone = "1111111111";
        $client->poste = "Test";
        $client->customer_id = 1;
        $client->relation = "Client";
        $client->uuid = Str::uuid();
        $client->save();

        $fn = new \App\Models\Contact();
        $fn->nom_du_contact = "TEST CONTACT FOURNISSEUR";
        $fn->adresse_email = "test@gmail.com";
        $fn->numero_telephone = "1111111111";
        $fn->poste = "Test";
        $fn->supplier_id = 1;
        $fn->relation = "Fournisseur";
        $fn->uuid = Str::uuid();
        $fn->save();


        $provider = new \App\Models\Contact();
        $provider->nom_du_contact = "TEST CONTACT PRESTATAIRE";
        $provider->adresse_email = "test@gmail.com";
        $provider->numero_telephone = "1111111111";
        $provider->poste = "Test";
        $provider->provider_id = 1;
        $provider->relation = "Prestataire";
        $provider->uuid = Str::uuid();
        $provider->save();


    }
}