<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact;
use App\Models\Provider;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['contacts'] = Contact::all();

        return view('pages.back.admin.contacts.lister', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['customers'] = Client::where('status', '=', "Entreprise")->get();
        $data['providers'] = Provider::where('status', '=', "Entreprise")->get();
        $data['suppliers'] = Supplier::where('status', '=', "Entreprise")->get();

        return view('pages.back.admin.contacts.creer', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'name' => 'required',
            'poste' => 'required',
            'telephone' => 'required',
        ]);
        // dd($request);

        $contact = new Contact();
        $contact->nom_du_contact = $request->name;
        $contact->adresse_email = $request->email;
        $contact->poste = $request->poste;
        $contact->numero_telephone = $request->telephone;

        if ($request->status == "Supplier") {
            $contact->supplier_id = $request->supplier_id;
            $contact->relation = "Fournisseur";
        }

        if ($request->status == "Customer") {
            $contact->customer_id = $request->customer_id;
            $contact->relation = "Client";

        }

        if ($request->status == "Provider") {
            $contact->provider_id = $request->provider_id;
            $contact->relation = "Prestataire";

        }


        $contact->save();

        return redirect()->route('contacts.index')->with('message', 'Le contact a été ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $data['customers'] = Client::where('status', '=', "Entreprise")->get();
        $data['providers'] = Provider::where('status', '=', "Entreprise")->get();
        $data['suppliers'] = Supplier::where('status', '=', "Entreprise")->get();
        $data['contact'] = Contact::where('id', '=', $id)->first();


        return view('pages.back.admin.contacts.editer', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {


        $request->validate([
            'status' => 'required',
            'name' => 'required',
            'poste' => 'required',
            'telephone' => 'required',
        ]);
        $contact = Contact::where('id', '=', $id)->first();

        $contact->nom_du_contact = $request->name;
        $contact->adresse_email = $request->email;
        $contact->poste = $request->poste;
        $contact->numero_telephone = $request->telephone;

        if (isset($request->provider_id)) {
            $contact->provider_id = $request->provider_id;
        }

        if (isset($request->supplier_id)) {
            $contact->supplier_id = $request->supplier_id;
        }

        if (isset($request->customer_id)) {
            $contact->customer_id = $request->customer_id;
        }

        $contact->save();

        return redirect()->route('contacts.index')->with('message', 'Les informations du contact ont été mises à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $contact = Contact::where('id', '=', $id)->first();
        if ($contact) {
            $contact->delete();
            return redirect()->route('contacts.index')->with('message', 'Contact a été retiré avec succès');
        }
    }
}