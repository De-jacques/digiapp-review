<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;

class PartCustEdit extends Component
{
    public $client, $model, $nom, $type, $email, $solde, $contact, $code_postale, $pays, $ville, $commune, $localisation;


    public function mount($client)
    {
        $this->client = $client;
        $this->nom = $this->client->nom;
        $this->type = $this->client->type;
        $this->email = $this->client->email;
        $this->solde = $this->client->solde;
        $this->contact = $this->client->contact;
        $this->code_postale = $this->client->code_postale;
        $this->pays = $this->client->pays;
        $this->ville = $this->client->ville;
        $this->commune = $this->client->commune;
        $this->localisation = $this->client->localisation;
    }
    public function submit()
    {
        $this->validate([
            'nom' => 'required',
            'type' => 'required',
            'email' => 'required|email',
            'solde' => 'required|numeric',
            'contact' => 'required',
            'code_postale' => 'required',
            'pays' => 'required',
            'ville' => 'required',
            'localisation' => 'required',
        ]);

        // Mettez à jour les données du modèle avec les valeurs des propriétés
        $this->client->update([
            'nom' => $this->nom,
            'type' => $this->type,
            'email' => $this->email,
            'solde' => $this->solde,
            'contact' => $this->contact,
            'code_postale' => $this->code_postale,
            'pays' => $this->pays,
            'ville' => $this->ville,
            'commune' => $this->commune,
            'localisation' => $this->localisation,
        ]);


        return redirect()->route('customers.index')->with('message', 'Client mis à jour avec succès');
    }
    public function render()
    {

        return view('livewire.part-cust-edit');
    }
}
