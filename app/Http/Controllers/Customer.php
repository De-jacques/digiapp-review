<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Customer extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['clients'] = Client::all();

        return view('pages.back.admin.clients.lister', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['clients'] = Client::all();

        return view('pages.back.admin.clients.creer', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'status' => 'required|string',
            'pays' => 'required|string',
            'ville' => 'required|string',
            'commune' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|string',

        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($request->status == "Entreprise") {
            $client = new Client();
            $client->status = $request->status;
            $client->type = $request->type;
            $client->pays = $request->pays;
            $client->ville = $request->ville;
            $client->commune = $request->commune;
            $client->contact = $request->telephone;
            $client->solde = $request->solde;
            $client->email = $request->email;
            $client->code_postale = $request->code_postale;
            $client->localisation = $request->localisation;
            $client->domiciliation = $request->domiciliation;
            if ($request->domiciliation == "Etrangere") {
                $client->taxe_tva = "Non";
                $client->regime = "ETR";
            } elseif ($request->type == "Goov") {
                $client->taxe_tva = "Non";
                $client->regime = "GOOV";
            } elseif ($request->regime == "RSI") {
                $client->taxe_tva = "Non";
                $client->regime = $request->regime;
            } elseif ($request->regime == "RNI") {
                $client->taxe_tva = "Non";
                $client->regime = $request->regime;
            } else {
                $client->regime = $request->regime;
                $client->taxe_tva = $request->tva_status;
            }
            $client->uuid = Str::uuid();

            $client->nom = $request->enterprise_name;
            $client->rcc_number = $request->rcc_number;
            $client->rcm_number = $request->rcm_number;
            $client->save();

            $contact = new Contact();
            $contact->customer_id = $client->id;
            $contact->nom_du_contact = $request->contact_name;
            $contact->adresse_email = $request->contact_email;
            $contact->numero_telephone = $request->contact_telephone;
            $contact->poste = $request->contact_poste;
            $contact->relation = "Client";
            $contact->save();


            $Cust_name = strtoupper($client->nom);

            if ($request->file) {
                $file = $request->file;
                $fileName = 'EXONERATION-' . $Cust_name . '.' . $file->getClientOriginalExtension();

                // Déplacez le fichier téléchargé dans le répertoire de stockage
                Storage::putFileAs($Cust_name . '/exoneration', $file, $fileName);



                // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
                $custExo = Client::find($client->id);
                $custExo->exo_path = 'app/' . $Cust_name . '/exoneration' . '/' . $fileName;
                $custExo->save();
            }

            if ($request->rcm_file) {
                $rcm = $request->rcm_file;

                $fileName = 'RCM-' . $Cust_name . '.' . $rcm->getClientOriginalExtension();

                // Déplacez le fichier téléchargé dans le répertoire de stockage et renommez-le
                Storage::putFileAs($Cust_name . '/administratifs', $rcm, $fileName);

                // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
                $custRCM = Client::find($client->id);
                $custRCM->rcm_path = 'app/' . $Cust_name . '/administratifs' . '/' . $fileName;

                $custRCM->save();
            }

            if ($request->rcc_file) {
                $rcc = $request->rcc_file;


                $fileName = 'RCC-' . $Cust_name . '.' . $rcc->getClientOriginalExtension();

                // Déplacez le fichier téléchargé dans le répertoire de stockage et renommez-le
                Storage::putFileAs($Cust_name . '/administratifs', $rcc, $fileName);


                // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
                $custRCC = Client::find($client->id);
                $custRCC->rcc_path = 'app/' . $Cust_name . '/administratifs' . '/' . $fileName;
                $custRCC->save();
            }
            if ($request->retenu_file) {
                $regime = $request->retenu_file;


                $fileName = 'REGIME-' . $Cust_name . '.' . $regime->getClientOriginalExtension();

                // Déplacez le fichier téléchargé dans le répertoire de stockage et renommez-le
                Storage::putFileAs($Cust_name . '/administratifs', $regime, $fileName);


                // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
                $custRegime = Client::find($client->id);
                $custRegime->regime_path = 'app/' . $Cust_name . '/administratifs' . '/' . $fileName;
                $custRegime->save();
            }
        } else if ($request->status == 'Particulier') {

            $client = new Client();
            $client->nom = $request->particular_name;
            $client->status = $request->status;
            $client->type = $request->type;
            $client->pays = $request->pays;
            $client->ville = $request->ville;
            $client->commune = $request->commune;
            $client->contact = $request->telephone;
            $client->solde = $request->solde;
            $client->email = $request->email;
            $client->code_postale = $request->code_postale;
            $client->localisation = $request->localisation;
            $client->domiciliation = $request->domiciliation;
            if ($request->domiciliation == "Etrangere") {
                $client->taxe_tva = "Non";
                $client->regime = "ETR";
            } elseif ($request->domiciliation == "Locale") {
                $client->taxe_tva = "Oui";
                $client->regime = "P.L";
            } else {
                $client->regime = $request->regime;
                $client->taxe_tva = $request->tva_status;
            }
            $client->uuid = Str::uuid();

            $client->rcc_number = $request->rcc_number;
            $client->rcm_number = $request->rcm_number;
            $client->save();
        }


        return redirect()->route('customers.index')->with('message', 'Client ajouté avec succès');
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

        $client = Client::findOrFail($id);
        $contact = Contact::where('customer_id', $id)->first();
        if ($client->status == "entreprise") {
            if ($contact != null) {
                return view('pages.back.admin.clients.edit', compact(['client', 'contact']));
            } else {
                return back()->with('error', 'Le client dont vous essayer de modifier les informations manques de personne à contacter ! Veuillez en ajouter  un dans COMPTE->Contact->Ajouter un contact !');
            }
        } else {
            return view('pages.back.admin.clients.edit_single', compact(['client', 'contact']));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->validate($request, [
            'type' => 'required|string',
            'pays' => 'required|string',
            'ville' => 'required|string',
            'commune' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|string',
        ]);

        $client = Client::findOrFail($id);
        $contact = Contact::where('customer_id', $id)->first();

        $client->type = $request->type;
        $client->pays = $request->pays;
        $client->ville = $request->ville;
        $client->commune = $request->commune;
        $client->regime = $request->regime;
        $client->contact = $request->telephone;
        $client->solde = $request->solde;
        $client->domiciliation = $request->domiciliation;
        $client->email = $request->email;
        $client->uuid = Str::uuid();

        $client->nom = $request->enterprise_name;
        $client->rcc_number = $request->rcc_number;
        $client->rcm_number = $request->rcm_number;
        $client->save();

        $contact->customer_id = $client->id;
        $contact->nom_du_contact = $request->contact_name;
        $contact->adresse_email = $request->contact_email;
        $contact->numero_telephone = $request->contact_telephone;
        $contact->poste = $request->contact_poste;
        $contact->relation = "Client";
        $contact->save();

        $Cust_name = strtoupper($client->nom);

        if ($request->file) {
            $file = $request->file;
            $fileName = 'EXONERATION-' . $Cust_name . '.' . $file->getClientOriginalExtension();

            // Déplacez le fichier téléchargé dans le répertoire de stockage
            Storage::putFileAs($Cust_name . '/exoneration', $file, $fileName);



            // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
            $custExo = Client::find($client->id);
            $custExo->exo_path = 'app/' . $Cust_name . '/exoneration' . '/' . $fileName;
            $custExo->save();
        }

        if ($request->rcm_file) {
            $rcm = $request->rcm_file;

            $fileName = 'RCM-' . $Cust_name . '.' . $rcm->getClientOriginalExtension();

            // Déplacez le fichier téléchargé dans le répertoire de stockage et renommez-le
            Storage::putFileAs($Cust_name . '/administratifs', $rcm, $fileName);


            // Déplacez le fichier téléchargé dans le répertoire de stockage
            // Storage::put($fileName, $rcm);

            // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
            $custRCM = Client::find($client->id);
            $custRCM->rcm_path = 'app/' . $Cust_name . '/administratifs' . '/' . $fileName;
            $custRCM->save();
        }

        if ($request->rcc_file) {
            $rcc = $request->rcc_file;


            $fileName = 'RCC-' . $Cust_name . '.' . $rcc->getClientOriginalExtension();

            // Déplacez le fichier téléchargé dans le répertoire de stockage et renommez-le
            Storage::putFileAs($Cust_name . '/administratifs', $rcc, $fileName);


            // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
            $custRCC = Client::find($client->id);
            $custRCC->rcc_path = 'app/' . $Cust_name . '/administratifs' . '/' . $fileName;
            $custRCC->save();
        }
        if ($request->retenu_file) {
            $regime = $request->retenu_file;


            $fileName = 'REGIME-' . $Cust_name . '.' . $regime->getClientOriginalExtension();

            // Déplacez le fichier téléchargé dans le répertoire de stockage et renommez-le
            Storage::putFileAs($Cust_name . '/administratifs', $regime, $fileName);


            // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
            $custRegime = Client::find($client->id);
            $custRegime->regime_path =  'app/' . $Cust_name . '/administratifs' . '/' . $fileName;
            $custRegime->save();
        }

        return redirect()->route('customers.index')->with('message', 'Les informations du client ont été mises à jour avec succès');
    }
    public function getCustomer(string $id)
    {
        $customer = Client::findOrFail($id);
        return $customer;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $client = Client::where('id', '=', $id)->first();
            if ($client) {
                $contact = Contact::where('customer_id', $id);
                $contact->delete();
                $client->delete();
                return redirect()->route('customers.index')->with('message', 'Client a été retiré avec succès');
            } else {
                return redirect()->route('customers.index')->with('error', 'Le client est introuvable dans la base de donnée ! veuillez raffraichir la page !');
            }
        } catch (\Throwable $th) {
            return back()->with('error', 'Une erreur est survenue lors de la suppression du client. Veuillez vérifier que le client n\'est pas lié à une livraison ou une proforma !');
        }
    }
}
