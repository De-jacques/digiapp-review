<?php

namespace App\Http\Controllers;


use App\Http\Controllers\PrinterController;
use Illuminate\Http\Request;
use App\Models\Client as customer;
use App\Models\Fractionnement;
use App\Models\Produit;
use App\Models\Proforma;
use App\Models\ProformaItem;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Str;
use Carbon\Carbon;
use NumberToWords\NumberToWords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProformaController extends Controller
{

    public function index()
    {
        $data['proformas'] = Proforma::orderBy('id', 'desc')->get();
        foreach ($data['proformas'] as $proforma) {
            $proforma->proformaItems = ProformaItem::where('proforma_id', $proforma->id)->get();
        }
        $data['customers'] = Customer::all();
        return view('pages.back.admin.proformas.index', $data);
    }
    public function edit($refProforma)
    {
        $proforma = Proforma::where('ref_proforma', $refProforma)->first();
        $customer = $proforma->getClient($proforma->customer_id);
        $customer_id = $proforma->customer_id;
        $clients = Customer::orderBy('id', 'desc')->get();
        $produits = Produit::orderBy('id', 'desc')->get();
        $proformaItems = ProformaItem::where('ref_proforma', $refProforma)->get();
        $fracts = Fractionnement::where('ref_proforma', $refProforma)->get();
        $fract = $fracts->toArray();
        $moreFracts = array();

        $livraison = $fract[0]['livraison'];
        $type = $fract[0]['type'];
        if ($type == 'unique' || $type == 'comptant') {
            $fract = $fract[0];
            // dd($fract['id']);
        } else if ($type == 'fractionne') {
            $fract = $fract[0];
            foreach ($fracts as $elme) {
                $moreFracts[""][] = $elme;
            }
            // dd('Type est égale à fractionné ',$moreFracts);
        }


        $result = array();
        foreach ($proformaItems as $element) {
            $result[""][] = $element;
        }
        // dd($customer);

        // dd($result);
        return view('pages.back.admin.proformas.proforma-edit', ['clients' => $clients, 'produits' => $produits, 'proforma' => $proforma, 'proformaItems' => $result, 'fract' => $fract, 'more' => $moreFracts, 'fracts' => $fracts, 'livraison' => $livraison]);
    }

    public function store(Request $request)
    {
        // dd($request);
        // return redirect()->back();
        // // dd($request);
        // if (isset($request->sender)) {
        //     dd($request);
        // }
        // if (empty($request->objet) | is_null($request->livraison)) {
        //     $productsList = [$request->productName, $request->ratevValue,  $request->quantity, $request->totalValue];
        //     dd("Liste de tableau de produits(id,pu,qte,total)", $productsList);
        // } else {
        //     # code...
        // }


        $this->validate($request, [
            'client' => 'required',
            'objet' => 'required',
            'productName' => 'required|array',
            'ratevValue' => 'required|array',
            'quantity' => 'required|array',
            'totalValue' => 'required|array',
            'subTotalValue' => 'required',
            'total_amountValue' => 'required',
            'taxe_amountValue' => 'required',
            'issueDate' => 'required',
            'type_reglement' => 'required',
            'livraison' => 'required'

        ], [
            'client.required' => 'Le client est requis',
            'objet.required' => 'L\'objet est requise',
            'productName.required' => 'Le produit est requis',
            'ratevValue.required' => 'Le taux de TVA est requis',
            'quantity.required' => 'La quantité est requise',
            'totalValue.required' => 'Le total est requis',
            'subTotalValue.required' => 'Le total est requis',
            'total_amountValue.required' => 'Le total est requis',
        ]);

        $request->subTotalValue = intval(str_replace(' ', '', $request->subTotalValue));
        $request->discount_amount = intval(str_replace(' ', '', $request->discount_amount));
        $request->total_amountValue = intval(str_replace(' ', '', $request->total_amountValue));

        // CREATE THE PROFORMA
        $proforma = new Proforma();
        $proforma->author = Auth::user()->id;
        $proforma->customer_id = $request->client;
        $proforma->taux_retenu = $request->client;
        if ($request->retenu_amountValue != 0) {
            $proforma->retenu = $request->retenu_amountValue;
            $proforma->taux_retenu = 5;
        } else {
            $proforma->retenu = 0;
            $proforma->taux_retenu = 0;
        }
        // $proforma->retenu = $request->retenu;

        if ($request->taxe_amountValue != 0) {
            $proforma->taxe = 18;
        } else {
            $proforma->taxe = 0;
        }
        $proforma->note = $request->objet;
        $proforma->ref_proforma = 'P' . '-' . date("dmy-His");
        $proforma->commercial_net = $request->total_amountValue; //ici
        $proforma->discount = ($request->discount != null) ? $request->discount : 0;
        $proforma->discount_amount = ($request->discount_amount != null) ? intval(str_replace(' ', '', $request->discount_amount)) : 0;
        $proforma->total_ht = $request->subTotalValue; //ici aussi
        $proforma->total = $request->total_ttc_amountValue;
        $proforma->tva_amount = $request->taxe_amountValue;
        $proforma->issue_date = $request->issueDate;
        // dd($request->discount_amount);   
        $proforma->save();

        $productIds = $request->productName;
        $labels = $request->label;

        $labelIndex = 0;

        for ($x = 0; $x < count($productIds); $x++) {

            $produit = Produit::findOrFail($productIds[$x]);

            $proformaItem = new ProformaItem();
            $proformaItem->product_id = $produit->id;
            $proformaItem->proforma_id = $proforma->id;
            $proformaItem->quantity = $request->quantity[$x];
            $proformaItem->price = $request->ratevValue[$x];
            $proformaItem->total = $request->totalValue[$x];
            $proformaItem->ref_proforma = $proforma->ref_proforma;
            $proformaItem->save();
        }



        if ($request->type_reglement == "comptant") {
            $fractionnement = new Fractionnement();
            $fractionnement->proforma_id = $proforma->id;
            $fractionnement->type = $request->type_reglement;
            $fractionnement->norme = 100;
            $fractionnement->date = 0;
            $fractionnement->ref_proforma = $proforma->ref_proforma;
            $fractionnement->description = $request->comptantDescription;
            $fractionnement->livraison = $request->livraison;
            $fractionnement->save();
        } elseif ($request->type_reglement == "unique") {
            $fractionnement = new Fractionnement();
            $fractionnement->proforma_id = $proforma->id;
            $fractionnement->type = $request->type_reglement;
            $fractionnement->norme = 100;

            if ($request->dateUnique == null) {
                $fractionnement->date = 0;
            } else {

                $fractionnement->date = $request->dateUnique;
            }
            $fractionnement->ref_proforma = $proforma->ref_proforma;
            $fractionnement->description = $request->uniqueDescription;
            $fractionnement->livraison = $request->livraison;
            $fractionnement->save();
        } elseif ($request->type_reglement == "fractionne") {
            for ($i = 0; $i < count($request->norme); $i++) {
                $fractionnement = new Fractionnement();
                $fractionnement->proforma_id = $proforma->id;
                $fractionnement->type = $request->type_reglement;
                $fractionnement->norme = $request->norme[$i];
                if ($request->date[$i] == null) {
                    $fractionnement->date = 0;
                } else {
                    $fractionnement->date = $request->date[$i];
                }
                $fractionnement->description = $request->description[$i];
                $fractionnement->ref_proforma = $proforma->ref_proforma;
                $fractionnement->livraison = $request->livraison;
                $fractionnement->save();
            }
        }

        // Impression de la nouvelle proforma

        return redirect()->route('proformas.index')->with('message', 'La proforma a été ajoutée avec succès');
    }


    public function create(Request $request)
    {
        $data['issueDate'] = $request->input('issueDate');
        $data['customer_id'] = $request->input('customer_id');
        $data['note'] = $request->input('note');
        $data['proformas'] = Proforma::all();
        $data['produits'] = Produit::all();

        // le reste du code pour la création de la proforma...

        $data['idUser'] = $request->old('customer_id');
        $data['customers'] = Customer::all();
        $data['clients'] = Customer::all();

        return view('pages.back.admin.proformas.proforma-create', $data);
    }

    public function show(Request $request)
    {
        $orderRef = url()->current();
        $extractLink = Str::after($orderRef, 'proformas/');
        $deleteOrderOnLink = Str::before($extractLink, '/edit');
        $refProforma = $deleteOrderOnLink;

        // Call the proforma
        $proforma = Proforma::where('ref_proforma', '=', $refProforma)->get();
        $data['proforma'] = $proforma[0];

        // Call the proformaitems
        $data['proformaItems'] = ProformaItem::where('ref_proforma', '=', $refProforma)->get();


        // Customer
        $customer = $proforma[0]['customer_id'];
        $data['customer'] = Customer::find($customer)->nom;
        $data['customer_number'] = Customer::find($customer)->contact;

        // Author
        $author = $proforma[0]['author'];
        $data['author'] = User::find($author)->name;

        // Date format
        $issue_date = Proforma::where('ref_proforma', '=', $refProforma)->get();


        $data['issue_date'] = date('D d M Y', strtotime($issue_date[0]['issue_date']));

        $date = $issue_date[0]['issue_date'];
        $carbonDate = Carbon::createFromFormat('Y-m-d', $date);

        // définir la langue en français
        $carbonDate->locale('fr');
        $data['issue_date'] = $carbonDate->translatedFormat('l j F Y'); // formater la date en utilisant le format "Vendredi 14 Avril 2023"
        // $proformaId = Proforma::find($proforma[0]['id']);


        //Total en lettre

        // create the number to words "manager" class
        $numberToWords = new NumberToWords();

        // build a new number transformer using the RFC 3066 language identifier
        $numberTransformer = $numberToWords->getNumberTransformer('fr');
        $data['numberToWords'] = $numberTransformer->toWords($proforma[0]['total']); // outputs "five thousand one hundred twenty"



        return view('pages.back.admin.proformas.show_proforma', $data);
    }


    public function update(Request $request, $id)
    {
        // dd($request);
        $this->validate($request, [
            'client' => 'required',
            'description' => 'required',
            'productName' => 'required|array',
            'ratevValue' => 'required|array',
            'quantity' => 'required|array',
            'totalValue' => 'required|array',
            'subTotalValue' => 'required',
            'total_amountValue' => 'required',
            'taxe_amountValue' => 'required',
            'issueDate' => 'required'

        ], [
            'client.required' => 'Le client est requis',
            'objet.required' => 'L\'objet est requis',
            'productName.required' => 'Le produit est requis',
            'ratevValue.required' => 'Le taux de TVA est requis',
            'quantity.required' => 'La quantité est requise',
            'totalValue.required' => 'Le total est requis',
            'subTotalValue.required' => 'Le total est requis',
            'total_amountValue.required' => 'Le total est requis',
        ]);

        $request->subTotalValue = intval(str_replace(' ', '', $request->subTotalValue));
        $request->discount_amount = intval(str_replace(' ', '', $request->discount_amount));
        $request->total_amountValue = intval(str_replace(' ', '', $request->total_amountValue));

        $proforma = Proforma::findOrFail($id);
        $proforma->customer_id = $request->client;
        $proforma->note = $request->objet;
        $proforma->commercial_net = $request->total_amountValue;
        $proforma->discount = ($request->discount != null) ? $request->discount : 0;
        $proforma->discount_amount = ($request->discount_amount != null) ? intval(str_replace(' ', '', $request->discount_amount)) : 0;
        $proforma->total_ht = $request->subTotalValue;
        $proforma->total = $request->total_ttc_amountValue;
        $proforma->tva_amount = $request->taxe_amountValue;
        $proforma->issue_date = $request->issueDate;
        $proforma->save();

        $productIds = $request->productName;
        $labels = $request->label;

        $labelIndex = 0;

        // Delete existing proforma items
        ProformaItem::where('proforma_id', $proforma->id)->delete();

        for ($x = 0; $x < count($productIds); $x++) {
            $produit = Produit::findOrFail($productIds[$x]);

            $proformaItem = new ProformaItem();
            $proformaItem->product_id = $produit->id;
            $proformaItem->proforma_id = $proforma->id;
            $proformaItem->quantity = $request->quantity[$x];
            $proformaItem->price = $request->ratevValue[$x];
            $proformaItem->total = $request->totalValue[$x];
            $proformaItem->ref_proforma = $proforma->ref_proforma;
            $proformaItem->save();
        }

        // Delete existing fractionnements
        Fractionnement::where('proforma_id', $proforma->id)->delete();

        if ($request->type_reglement == "comptant") {
            $fractionnement = new Fractionnement();
            $fractionnement->proforma_id = $proforma->id;
            $fractionnement->type = $request->type_reglement;
            $fractionnement->norme = 100;
            $fractionnement->date = 0;
            $fractionnement->ref_proforma = $proforma->ref_proforma;
            $fractionnement->description = $request->comptantDescription;
            $fractionnement->livraison = $request->livraison;
            $fractionnement->save();
        } elseif ($request->type_reglement == "unique") {
            $fractionnement = new Fractionnement();
            $fractionnement->proforma_id = $proforma->id;
            $fractionnement->type = $request->type_reglement;
            $fractionnement->norme = 100;
            $fractionnement->date = ($request->dateUnique == null) ? 0 : $request->dateUnique;
            $fractionnement->ref_proforma = $proforma->ref_proforma;
            $fractionnement->description = $request->uniqueDescription;
            $fractionnement->livraison = $request->livraison;
            $fractionnement->save();
        } elseif ($request->type_reglement == "fractionne") {
            for ($i = 0; $i < count($request->norme); $i++) {
                $fractionnement = new Fractionnement();
                $fractionnement->proforma_id = $proforma->id;
                $fractionnement->type = $request->type_reglement;
                $fractionnement->norme = $request->norme[$i];
                if ($request->date[$i] == null) {
                    $fractionnement->date = 0;
                } else {
                    $fractionnement->date = $request->date[$i];
                }
                $fractionnement->description = $request->description[$i];
                $fractionnement->ref_proforma = $proforma->ref_proforma;
                $fractionnement->livraison = $request->livraison;
                $fractionnement->save();
            }
        }

        // Impression de la proforma mise à jour
        $printerController = app(PrinterController::class);
        $printerController->regenererProforma($proforma->ref_proforma);

        return redirect()->route('proformas.index')->with('message', 'La proforma a été mise à jour avec succès');
    }



    public function destroy(Proforma $proforma)
    {
        try {
            $customer = Customer::findOrFail($proforma->customer_id)->nom;
            $ref = $proforma->ref_proforma;

            // Supprimer tous les fractionnements liés à la proforma
            $proforma->fractionnements()->delete();

            $proforma->delete();

            // Chemin complet du fichier que vous souhaitez supprimer
            $cheminFichier = $customer . '/' . 'proformas' . '/' . $ref . '.pdf';

            // Vérifiez d'abord si le fichier existe
            if (File::exists($cheminFichier)) {
                // Supprimez le fichier
                File::delete($cheminFichier);
                session()->flash('success', 'Le fichier a été supprimé avec succès.');
            } else {
                session()->flash('error', 'Le fichier n\'existe pas.');
            }

            return redirect()->route('proformas.index')->with('message', 'La proforma a été supprimée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la suppression de la proforma : ' . $e->getMessage());
        }
    }
}
