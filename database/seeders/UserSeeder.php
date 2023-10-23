<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //COMPTE PROGRAMMATION
        $user = new \App\Models\User();
        $user->name = "Super";
        $user->first_name = "Admin";
        $user->email = "superadmin@email.com";
        $user->role = "super_admin";
        $user->responsabilite = "directeur";
        $user->password = bcrypt('superadmin');
        $user->save();

        $user = new \App\Models\User();
        $user->name = "Admin";
        $user->first_name = "Second";
        $user->email = "admin@email.com";
        $user->role = "admin";
        $user->responsabilite = "directeur";
        $user->password = bcrypt('admin');
        $user->save();

        $user = new \App\Models\User();
        $user->name = "Commercial";
        $user->email = "commercial@email.com";
        $user->role = "commercial";
        $user->responsabilite = "directeur";
        $user->password = bcrypt('commercial');
        $user->save();

        $user = new \App\Models\User();
        $user->name = "Stock";
        $user->email = "stock@email.com";
        $user->role = "stock";
        $user->responsabilite = "directeur";
        $user->password = bcrypt('stock');
        $user->save();



        //COMPTE DIGICORP
        $user = new \App\Models\User();
        $user->name = "Koffi";
        $user->first_name = "Kouassi Fabrice-Andrea";
        $user->poste = "Responsable Commercial";
        $user->email = "k.fabrice@digicorp.pro";
        $user->role = "commercial";
        $user->responsabilite = "chef";
        $user->password = bcrypt('Digicorp@0001');
        $user->save();

        $user = new \App\Models\User();
        $user->name = "Kouadio";
        $user->first_name = "Assie Vivienne";
        $user->poste = "Assistante Commerciale";
        $user->email = "a.viviene@digicorp.pro";
        $user->role = "commercial";
        $user->password = bcrypt('Digicorp@0001');
        $user->save();

        $user = new \App\Models\User();
        $user->name = "Nabo";
        $user->first_name = "Rabe Ange Patrick";
        $user->poste = "Gestionnaire de Stock";
        $user->email = "n.patrick@digicorp.pro";
        $user->role = "stock";
        $user->responsabilite = "chef";
        $user->password = bcrypt('Digicorp@0001');
        $user->save();

        $user = new \App\Models\User();
        $user->name = "Lingue";
        $user->first_name = "Dieudonne";
        $user->poste = "Directeur Administratif et Financier";
        $user->email = "lingue@digicorp.pro";
        $user->role = "admin";
        $user->responsabilite = "directeur";
        $user->password = bcrypt('Digicorp@0001');
        $user->save();

        $user = new \App\Models\User();
        $user->name = "Kaboré";
        $user->first_name = "Adama";
        $user->poste = "Gérant";
        $user->email = "gerant@digicorp.pro";
        $user->role = "super_admin";
        $user->responsabilite = "directeur";
        $user->password = bcrypt('Digicorp@0001');
        $user->save();
    }
}
