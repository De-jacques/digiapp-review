<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['fournisseurs'] = Supplier::all();
        return view('pages.back.admin.fournisseurs.lister', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['fournisseurs'] = Supplier::All();

        return view('pages.back.admin.fournisseurs.creer', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'status' => 'required|string',
            'pays' => 'required|string',
            'ville' => 'required|string',
            'commune' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|string',
        ]);

        $supplier = new Supplier();
        $supplier->status = $request->status;
        $supplier->country = $request->pays;
        $supplier->city = $request->ville;
        $supplier->municipality = $request->commune;
        $supplier->contact = $request->telephone;
        $supplier->balance = $request->solde;
        $supplier->taxe_tva = $request->tva_status;
        $supplier->email = $request->email;
        $supplier->reglement = $request->reglement;
        $supplier->regime = $request->regime;
        $supplier->name = $request->enterprise_name;
        $supplier->rcc_number = $request->rcc_number;
        $supplier->rcm_number = $request->rcm_number;
        $supplier->localisation = $request->localisation;
        $supplier->code_postal = $request->code_postale;
        $supplier->save();

        $contact = new Contact();
        $contact->supplier_id = $supplier->id;
        $contact->nom_du_contact = $request->contact_name;
        $contact->adresse_email = $request->contact_email;
        $contact->numero_telephone = $request->contact_telephone;
        $contact->poste = $request->contact_poste;
        $contact->relation = "Fournisseur";
        $contact->save();


        $Cust_name = strtoupper($supplier->name);

        if ($request->file) {
            $file = $request->file;
            $fileName = 'EXONERATION-' . $Cust_name . '.' . $file->getClientOriginalExtension();

            // Déplacez le fichier téléchargé dans le répertoire de stockage
            Storage::putFileAs('fournisseurs/' . $Cust_name . '/exoneration', $file, $fileName);



            // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations

            $supExo = Supplier::find($supplier->id);
            // $supExo->exo_path = 'app/' . 'fournisseurs/'.$Cust_name . '/exoneration' . '/' . $fileName;
            $supExo->exo_path = 'fournisseurs/' . $Cust_name . '/exoneration' . '/' . $fileName;
            $supExo->save();
        }

        if ($request->rcm_file) {
            $rcm = $request->rcm_file;

            $fileName = 'RCM-' . $Cust_name . '.' . $rcm->getClientOriginalExtension();

            // Déplacez le fichier téléchargé dans le répertoire de stockage et renommez-le
            Storage::putFileAs('fournisseurs/' . $Cust_name . '/administratifs', $rcm, $fileName);


            // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
            $supRCM = Supplier::find($supplier->id);
            // $supRCM->rcm_path = 'app/' . 'fournisseurs/'.$Cust_name . '/administratifs' . '/' . $fileName;
            $supRCM->rcm_path = 'fournisseurs/' . $Cust_name . '/administratifs' . '/' . $fileName;
            $supRCM->save();
        }

        if ($request->rcc_file) {
            $rcc = $request->rcc_file;


            $fileName = 'RCC-' . $Cust_name . '.' . $rcc->getClientOriginalExtension();

            // Déplacez le fichier téléchargé dans le répertoire de stockage et renommez-le
            Storage::putFileAs('fournisseurs/' . $Cust_name . '/administratifs', $rcc, $fileName);


            // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
            $supRCC = Supplier::find($supplier->id);
            // $supRCC->rcc_path = 'app/' . 'fournisseurs/'.$Cust_name . '/administratifs' . '/' . $fileName;
            $supRCC->rcc_path = 'fournisseurs/' . $Cust_name . '/administratifs' . '/' . $fileName;
            $supRCC->save();
        }
        if ($request->retenu_file) {
            $regime = $request->retenu_file;


            $fileName = 'AIRSI-' . $Cust_name . '.' . $regime->getClientOriginalExtension();

            // Déplacez le fichier téléchargé dans le répertoire de stockage et renommez-le
            Storage::putFileAs('fournisseurs/' . $Cust_name . '/administratifs', $regime, $fileName);


            // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
            $supRegime = Supplier::find($supplier->id);
            // $supRegime->regime_path = 'app/' . 'fournisseurs/'.$Cust_name . '/administratifs' . '/' . $fileName;
            $supRegime->regime_path = 'fournisseurs/' . $Cust_name . '/administratifs' . '/' . $fileName;
            $supRegime->save();
        }


        return redirect()->route('suppliers.index')->with('message', 'Fournisseur ajouté avec succès');
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
        $supplier = Supplier::findOrFail($id);
        // dd($supplier->status);
        // dd('ici');
        $exo = $supplier->exo_path;
        $rcc = $supplier->rcc_path;

        $rcm = $supplier->rcm_path;

        $contact = Contact::where('supplier_id', $id)->first();

        if ($supplier->status == "entreprise") {
            if ($contact != null) {
                // return view('pages.back.admin.clients.edit', compact(['client', 'contact']));
                return view('pages.back.admin.fournisseurs.edit', compact(['supplier', 'contact', 'exo', 'rcc', 'rcm']));
            } else {
                return back()->with('error', 'Le client dont vous essayer de modifier les informations manques de personne à contacter ! Veuillez en ajouter  un dans COMPTE->Contact->Ajouter un contact !');
            }
        } else {
            // return view('pages.back.admin.clients.edit', compact(['client', 'contact']));
            return view('pages.back.admin.fournisseurs.edit', compact(['supplier', 'contact', 'exo', 'rcc', 'rcm']));
        }

        // return view('pages.back.admin.fournisseurs.edit', compact(['supplier', 'contact', 'exo', 'rcc', 'rcm']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd('MISE À JOUR DU FOURNISSEUR');
        $this->validate($request, [
            // 'status' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'municipality' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|string',
        ]);



        $supplier = Supplier::findOrFail($id);
        $contact = Contact::where('supplier_id', $id)->first();

        // $supplier->status = $request->status;
        $supplier->country = $request->country;
        $supplier->city = $request->city;
        $supplier->municipality = $request->municipality;
        $supplier->contact = $request->telephone;
        $supplier->balance = $request->solde;
        $supplier->reglement = $request->reglement;
        $supplier->regime = $request->regime;
        $supplier->taxe_tva = $request->tva_status;
        $supplier->email = $request->email;
        $supplier->localisation = $request->localisation;
        $supplier->code_postal = $request->code_postal;

        $supplier->name = $request->enterprise_name;
        $supplier->rcc_number = $request->rcc_number;
        $supplier->rcm_number = $request->rcm_number;
        $supplier->save();

        // dd('MISE À JOUR DU FOURNISSEUR');
        // dd($request);
        if (isset($contact)) {
            $contact->supplier_id = $supplier->id;
            $contact->nom_du_contact = $request->contact_name;
            $contact->adresse_email = $request->contact_email;
            $contact->numero_telephone = $request->contact_telephone;
            $contact->poste = $request->contact_poste;
            $contact->relation = "Fournisseur";
            $contact->save();
        } else {
            $contactNew = new Contact();
            $contactNew->supplier_id = $supplier->id;
            $contactNew->nom_du_contact = $request->contact_name;
            $contactNew->adresse_email = $request->contact_email;
            $contactNew->numero_telephone = $request->contact_telephone;
            $contactNew->poste = $request->contact_poste;
            $contactNew->relation = "Fournisseur";
            $contactNew->save();
        }



        $Cust_name = strtoupper($supplier->name);

        if ($request->file) {
            $file = $request->file;
            $fileName = 'EXONERATION-' . $Cust_name . '.' . $file->getClientOriginalExtension();

            // Déplacez le fichier téléchargé dans le répertoire de stockage
            Storage::putFileAs($Cust_name . '/exoneration', $file, $fileName);



            // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
            $supExo = Supplier::find($supplier->id);
            $supExo->exo_path = $Cust_name . '/exoneration' . '/' . $fileName;
            $supExo->save();
        }

        if ($request->rcm_file) {
            $rcm = $request->rcm_file;

            $fileName = 'RCM-' . $Cust_name . '.' . $rcm->getClientOriginalExtension();

            // Déplacez le fichier téléchargé dans le répertoire de stockage et renommez-le
            Storage::putFileAs($Cust_name . '/administratifs', $rcm, $fileName);

            // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
            $supRCM = Supplier::find($supplier->id);
            $supRCM->rcm_path = $Cust_name . '/administratifs' . '/' . $fileName;
            $supRCM->save();
        }

        if ($request->rcc_file) {
            $rcc = $request->rcc_file;


            $fileName = 'RCC-' . $Cust_name . '.' . $rcc->getClientOriginalExtension();

            // Déplacez le fichier téléchargé dans le répertoire de stockage et renommez-le
            Storage::putFileAs($Cust_name . '/administratifs', $rcc, $fileName);


            // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
            $supRCC = Supplier::find($supplier->id);
            $supRCC->rcc_path = $Cust_name . '/administratifs' . '/' . $fileName;
            $supRCC->save();
        }

        if ($request->retenu_file) {
            $regime = $request->retenu_file;


            $fileName = 'AIRSI-' . $Cust_name . '.' . $regime->getClientOriginalExtension();

            // Déplacez le fichier téléchargé dans le répertoire de stockage et renommez-le
            Storage::putFileAs($Cust_name . '/administratifs', $regime, $fileName);


            // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
            $regimeFile = Supplier::find($supplier->id);
            $regimeFile->regime_path = $Cust_name . '/administratifs' . '/' . $fileName;
            $regimeFile->save();
        }



        return redirect()->route('suppliers.index')->with('message', 'les informations du fournisseur ont été mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $fournisseur = Supplier::where('id', '=', $id)->first();

            if ($fournisseur) {
                $contact = Contact::where('supplier_id', $id);
                $contact->delete();
                $fournisseur->delete();
                return redirect()->route('suppliers.index')->with('message', 'Fournisseur rétiré avec succès');;
            } else {
                return redirect()->route('suppliers.index')->with('message', 'Fournisseur introuvable');
            }
        } catch (\Exception $th) {
            // En cas d'erreur, afficher un message d'erreur et rediriger vers la page précédente
            return back()->with('error', 'Une erreur est survenue lors de la suppression du fournisseur. Veuillez vérifier que le fournisseur n\'est pas lié à une reception !');
        }
    }
}
