<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = new \App\Models\Client();
        $client->nom = "TEST";
        $client->email = "test@gmail.com";
        $client->pays = "Côte d'ivoire";
        $client->ville = "Abidjan";
        $client->commune = "Cocoody";
        $client->contact = "1111111111";
        $client->type = "Normal";
        $client->status = "entreprise";
        $client->solde = 0;
        $client->uuid = Str::uuid();

        $client->save();

    }
}