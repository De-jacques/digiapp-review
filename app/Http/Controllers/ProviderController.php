<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['providers'] = Provider::all();

        return view('pages.back.admin.prestataires.lister', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['providers'] = Provider::all();
        return view('pages.back.admin.prestataires.creer', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'pays' => 'required|string',
            'ville' => 'required|string',
            'commune' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|string',
        ]);


        $provider = new Provider();
        $provider->country = $request->pays;
        $provider->regime = $request->regime;
        $provider->city = $request->ville;
        $provider->municipality = $request->commune;
        $provider->contact = $request->telephone;
        $provider->balance = $request->solde;
        $provider->email = $request->email;
        $provider->taxe_tva = $request->tva_status;
        $provider->name = $request->enterprise_name;
        $provider->rcc_number = $request->rcc_number;
        $provider->rcm_number = $request->rcm_number;
        $provider->localisation = $request->localisation;
        $provider->code_postal = $request->code_postale;
        $provider->save();

        $contact = new Contact();
        $contact->provider_id = $provider->id;
        $contact->nom_du_contact = $request->contact_name;
        $contact->adresse_email = $request->contact_email;
        $contact->numero_telephone = $request->contact_telephone;
        $contact->poste = $request->contact_poste;
        $contact->relation = "Prestataire";
        $contact->save();



        $Cust_name = strtoupper($provider->name);

        if ($request->file) {
            $file = $request->file;
            $fileName = 'EXONERATION-' . $Cust_name . '.' . $file->getClientOriginalExtension();

            // Déplacez le fichier téléchargé dans le répertoire de stockage
            Storage::putFileAs($Cust_name . '/exoneration', $file, $fileName);



            // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
            $proExo = Provider::find($provider->id);
            $proExo->exo_path = $Cust_name . '/exoneration' . '/' . $fileName;
            $proExo->save();
        }

        if ($request->rcm_file) {
            $rcm = $request->rcm_file;

            $fileName = 'RCM-' . $Cust_name . '.' . $rcm->getClientOriginalExtension();

            // Déplacez le fichier téléchargé dans le répertoire de stockage et renommez-le
            Storage::putFileAs($Cust_name . '/administratifs', $rcm, $fileName);


            // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
            $proRCM = Provider::find($provider->id);
            $proRCM->rcm_path = $Cust_name . '/administratifs' . '/' . $fileName;
            $proRCM->save();
        }

        if ($request->rcc_file) {
            $rcc = $request->rcc_file;


            $fileName = 'RCC-' . $Cust_name . '.' . $rcc->getClientOriginalExtension();

            // Déplacez le fichier téléchargé dans le répertoire de stockage et renommez-le
            Storage::putFileAs($Cust_name . '/administratifs', $rcc, $fileName);


            // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations

            // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
            $proRCC = Provider::find($provider->id);
            $proRCC->rcc_path = $Cust_name . '/administratifs' . '/' . $fileName;
            $proRCC->save();
        }

        return redirect()->route('providers.index')->with('message', 'Prestataire ajouté avec succès');
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
    public function edit(string $id)
    {

        $provider = Provider::findOrFail($id);
        $exo = $provider->exo_path;
        $rcc = $provider->rcc_path;
        $rcm = $provider->rcm_path;

        $contact = Contact::where('provider_id', $id)->first();

        return view('pages.back.admin.prestataires.edit', compact(['provider', 'contact', 'exo', 'rcc', 'rcm']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'status' => 'required|string',
            'pays' => 'required|string',
            'ville' => 'required|string',
            'commune' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|string',
        ]);


        $provider = Provider::findOrFail($id);
        $contact = Contact::where('provider_id', $id)->first();

        $provider->status = $request->status;
        $provider->country = $request->pays;
        $provider->city = $request->ville;
        $provider->municipality = $request->commune;
        $provider->contact = $request->telephone;
        $provider->balance = $request->solde;
        $provider->email = $request->email;
        $provider->taxe_tva = $request->tva_status;
        $provider->localisation = $request->localisation;
        $provider->code_postal = $request->code_postale;

        if ($request->status == "entreprise") {
            $provider->name = $request->enterprise_name;
            $provider->rcc_number = $request->rcc_number;
            $provider->rcm_number = $request->rcm_number;
            $provider->save();

            $contact->provider_id = $provider->id;
            $contact->nom_du_contact = $request->contact_name;
            $contact->adresse_email = $request->contact_email;
            $contact->numero_telephone = $request->contact_telephone;
            $contact->poste = $request->contact_poste;
            $contact->relation = "Prestataire";
            $contact->save();
        } else {
            $provider->name = $request->particular_name;
            $provider->save();
        }


        $provider->save();


        $Cust_name = strtoupper($provider->name);

        if ($request->file) {
            $file = $request->file;
            $fileName = 'EXONERATION-' . $Cust_name . '.' . $file->getClientOriginalExtension();

            // Déplacez le fichier téléchargé dans le répertoire de stockage
            Storage::putFileAs($Cust_name . '/exoneration', $file, $fileName);

            // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
            $proExo = Provider::find($provider->id);
            $proExo->exo_path = $Cust_name . '/exoneration' . '/' . $fileName;
            $proExo->save();
        }

        if ($request->rcm_file) {
            $rcm = $request->rcm_file;

            $fileName = 'RCM-' . $Cust_name . '.' . $rcm->getClientOriginalExtension();

            // Déplacez le fichier téléchargé dans le répertoire de stockage et renommez-le
            Storage::putFileAs($Cust_name . '/administratifs', $rcm, $fileName);


            // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
            $proRCM = Provider::find($provider->id);
            $proRCM->rcm_path = $Cust_name . '/administratifs' . '/' . $fileName;
            $proRCM->save();
        }

        if ($request->rcc_file) {
            $rcc = $request->rcc_file;


            $fileName = 'RCC-' . $Cust_name . '.' . $rcc->getClientOriginalExtension();

            // Déplacez le fichier téléchargé dans le répertoire de stockage et renommez-le
            Storage::putFileAs($Cust_name . '/administratifs', $rcc, $fileName);


            // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
            $proRCC = Provider::find($provider->id);
            $proRCC->rcc_path = $Cust_name . '/administratifs' . '/' . $fileName;
            $proRCC->save();
        }

        return redirect()->route('providers.index')->with('message', 'les informations du prestataire ont été mises à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $prestataire = Provider::where('id', '=', $id)->first();

            if ($prestataire) {
                $contact = Contact::where('provider_id', $id);
                $contact->delete();
                $prestataire->delete();
                return redirect()->route('providers.index')->with('message', 'Prestataire rétiré avec succès');
            } else {
                return redirect()->back()->with('error', "Le prestataire est introuvable dans la base de donnée veuillez raffraichir la page !");
            }
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'Une erreur est survenue lors de la suppression du prestataire. Veuillez vérifier que le fournisseur n\'est pas lié à une reception !');
        }
    }
}
