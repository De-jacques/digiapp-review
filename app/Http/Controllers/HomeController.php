<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact;
use App\Models\Produit;
use App\Models\Entrepot;
use App\Models\Marque;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $produits = Produit::count();

        $clients = Client::count();
        $contactsClients = Contact::count();
        $contactsFournisseurs = Contact::count();
        $contacts = $contactsClients + $contactsFournisseurs;
        $marques = Marque::count();
        $entrepots = Entrepot::count();
        
        return view('pages.back.admin.index',compact('produits','clients','contacts','marques','entrepots'));
    }
}
