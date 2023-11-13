<?php

namespace App\Http\Controllers;

use App\Models\Fractionnement;
use Illuminate\Http\Request;
use App\Models\Proforma;
use App\Models\ProformaItem;
use App\Models\Client as Customer;
use App\Models\Client;
use App\Models\Entree;
use App\Models\EntreeIterm;
use App\Models\Entrepot;
use App\Models\Produit;
use App\Models\Provider;
use App\Models\SerialNumber;
use App\Models\Sortie;
use App\Models\SortieIterm;
use App\Models\Supplier;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use NumberToWords\NumberToWords;


class PrinterController extends Controller
{
  public function test()
  {
    $orderRef = url()->current();
    $extractLink = Str::after($orderRef, 'impression/');
    $deleteOrderOnLink = Str::before($extractLink, '/edit');
    $refProforma = $deleteOrderOnLink;

    $proforma = Proforma::where('ref_proforma', '=', $refProforma)->first();

    $data['proforma'] = $proforma;

    $data['proformaItems'] = ProformaItem::where('ref_proforma', '=', $refProforma)->get();

    $customer_id = $proforma->customer_id;
    $customer = Customer::find($customer_id);
    $data['customer'] = $customer->nom;
    $data['customer_localisation'] = $customer->localisation;
    $data['customer_addresse'] = $customer->code_postale;
    $data['customer_number'] = $customer->contact;

    $checker = $customer->taxe_tva;

    if ($checker == "Oui") {
      $data['taxe_tva'] = 18;
    } else {
      $data['taxe_tva'] = 0;
    }

    $author = $proforma->author;
    $data['author'] = User::find($author);

    $issue_date = $proforma->issue_date;

    $carbonDate = Carbon::createFromFormat('Y-m-d', $issue_date);

    $carbonDate->locale('fr');
    $data['issue_date'] = $carbonDate->translatedFormat('l j F Y');

    $data['livraison'] = 12;

    $numberToWords = new NumberToWords();
    $numberTransformer = $numberToWords->getNumberTransformer('fr');
    $data['numberToWords'] = $numberTransformer->toWords($proforma->total);

    $data['filename'] = $proforma->ref_proforma;

    $fractions = Fractionnement::where('ref_proforma', '=', $refProforma)->get();
    $data['fractions'] = $fractions->toArray();
    $data['type'] = $data['fractions'][0]["type"];

    return view('pages.back.admin.proformas.printer', $data);
  }
  public function imprimer()
  {
    $orderRef = url()->current();
    $extractLink = Str::after($orderRef, 'impression/');
    $deleteOrderOnLink = Str::before($extractLink, '/edit');
    $refProforma = $deleteOrderOnLink;
    $proforma = Proforma::where('ref_proforma', '=', $refProforma)->first();
    $data['proforma'] = $proforma;
    $data['proformaItems'] = ProformaItem::where('ref_proforma', '=', $refProforma)->get();
    $customer_id = $proforma->customer_id;
    $customer = Customer::find($customer_id);
    $data['customer'] = $customer->nom;
    $data['customer_localisation'] = $customer->localisation;
    $data['customer_addresse'] = $customer->code_postale;
    $data['customer_number'] = $customer->contact;
    $checker = $customer->taxe_tva;

    if ($checker == "Oui") {
      $data['taxe_tva'] = 18;
    } else {
      $data['taxe_tva'] = 0;
    }
    if ((int)$proforma->retenu != 0) {
      $data["retenu"] = (int)$proforma->retenu;
    }
    $author = $proforma->author;
    $data['author'] = User::find($author);
    $issue_date = $proforma->issue_date;
    $carbonDate = Carbon::createFromFormat('Y-m-d', $issue_date);
    $carbonDate->locale('fr');
    $data['issue_date'] = $carbonDate->translatedFormat('l j F Y');
    $data['livraison'] = 12;
    $numberToWords = new NumberToWords();
    $numberTransformer = $numberToWords->getNumberTransformer('fr');
    $data['numberToWords'] = $numberTransformer->toWords($proforma->total);
    $data['filename'] = $proforma->ref_proforma;
    $fractions = Fractionnement::where('ref_proforma', '=', $refProforma)->get();
    $data['fractions'] = $fractions->toArray();
    $data['type'] = $data['fractions'][0]["type"];
    $pdf = PDF::loadView('pages.back.admin.proformas.printer', $data);
    // $pdf = PDF::loadView('pages.back.admin.factures.create_facture', $data);
    $pdf->setPaper('a4', 'portrait');
    $fileName = $customer->nom . '/' . 'proformas' . '/' . $data['filename'] . '.pdf';
    // dd($fileName);
    $pdfContent = $pdf->output();
    // dd($pdfContent);
    Storage::put($fileName, $pdfContent);
    $proforma->file = $fileName;
    $proforma->save();
    return $pdf->stream();
  }

  public function facture()
  {
    $orderRef = url()->current();
    $extractLink = Str::after($orderRef, 'impression/');
    $deleteOrderOnLink = Str::before($extractLink, '/edit');
    $refProforma = $deleteOrderOnLink;
    $proforma = Proforma::where('ref_proforma', '=', $refProforma)->first();
    $data['proforma'] = $proforma;
    $data['proformaItems'] = ProformaItem::where('ref_proforma', '=', $refProforma)->get();
    $customer_id = $proforma->customer_id;
    $customer = Customer::find($customer_id);
    $data['customer'] = $customer->nom;
    $data['customer_localisation'] = $customer->localisation;
    $data['customer_addresse'] = $customer->code_postale;
    $data['customer_number'] = $customer->contact;
    $checker = $customer->taxe_tva;
    if ($checker == "Oui") {
      $data['taxe_tva'] = 18;
    } else {
      $data['taxe_tva'] = 0;
    }
    if ((int)$proforma->retenu != 0) {
      $data["retenu"] = (int)$proforma->retenu;
    }
    $author = $proforma->author;
    $data['author'] = User::find($author);
    $issue_date = $proforma->issue_date;
    $carbonDate = Carbon::createFromFormat('Y-m-d', $issue_date);
    $carbonDate->locale('fr');
    $data['issue_date'] = $carbonDate->translatedFormat('l j F Y');
    $data['livraison'] = 12;
    $numberToWords = new NumberToWords();
    $numberTransformer = $numberToWords->getNumberTransformer('fr');
    $data['numberToWords'] = $numberTransformer->toWords($proforma->total);
    $data['filename'] = $proforma->ref_proforma;
    $fractions = Fractionnement::where('ref_proforma', '=', $refProforma)->get();
    $data['fractions'] = $fractions->toArray();
    $data['type'] = $data['fractions'][0]["type"];
    $pdf = PDF::loadView('pages.back.admin.factures.create_facture', $data);
    $pdf->setPaper('a4', 'portrait');
    $fileName = $customer->nom . '/' . 'proformas' . '/' . $data['filename'] . '.pdf';
    $pdfContent = $pdf->output();
    Storage::put($fileName, $pdfContent);
    $proforma->file = $fileName;
    $proforma->save();
    return $pdf->stream();
  }

  public function regenererProforma($refProforma)
  {
    // $proforma = Proforma::where('ref_proforma', '=', $refProforma)->first();
    // $data['proforma'] = $proforma;
    // $data['proformaItems'] = ProformaItem::where('ref_proforma', '=', $refProforma)->get();
    // $customer_id = $proforma->customer_id;
    // $customer = Customer::find($customer_id);
    // $data['customer'] = $customer->nom;
    // $data['customer_localisation'] = $customer->localisation;
    // $data['customer_addresse'] = $customer->code_postale;
    // $data['customer_number'] = $customer->contact;
    // $checker = $customer->taxe_tva;
    // if ($checker == "Oui") {
    //   $data['taxe_tva'] = 18;
    // } else {
    //   $data['taxe_tva'] = 0;
    // }
    // if ((int)$proforma->retenu != 0) {
    //   $data["retenu"] = (int)$proforma->retenu;
    // }
    // $author = $proforma->author;
    // $data['author'] = User::find($author);
    // $issue_date = $proforma->issue_date;
    // $carbonDate = Carbon::createFromFormat('Y-m-d', $issue_date);
    // $carbonDate->locale('fr');
    // $data['issue_date'] = $carbonDate->translatedFormat('l j F Y');
    // $data['livraison'] = 12;
    // $numberToWords = new NumberToWords();
    // $numberTransformer = $numberToWords->getNumberTransformer('fr');
    // $data['numberToWords'] = $numberTransformer->toWords($proforma->total);
    // $data['filename'] = $proforma->ref_proforma;
    // $fractions = Fractionnement::where('ref_proforma', '=', $refProforma)->get();
    // $data['fractions'] = $fractions->toArray();
    // $data['type'] = $data['fractions'][0]["type"];
    // $pdf = PDF::loadView('pages.back.admin.proformas.printer', $data);
    // $pdf->setPaper('a4', 'portrait');
    // $fileName = $customer->nom . '/' . 'proformas' . '/' . $data['filename'] . '.pdf';
    // $pdfContent = $pdf->output();
    // Storage::put($fileName, $pdfContent);
    // $proforma->file = $fileName;
    // $proforma->save();
    // $pdf->download($fileName);
  }


  public function printerEntree(Request $request)
  {
    $orderRef = url()->current();
    $extractLink = Str::after($orderRef, 'impression/');
    $ref_entree = $extractLink;

    $entree = Entree::where('ref_entree', '=', $ref_entree)->first();

    if ($entree && $entree->document_path) {
      $filePath = $entree->document_path;
      $pdfContent = Storage::get($filePath);

      return response($pdfContent, 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="bon_de_entree_' . $entree->date . '.pdf"'
      ]);
    }
    $data['entree'] = $entree;


    $data['entreeIterms'] = EntreeIterm::where('ref_entree', '=', $ref_entree)->get();

    $serialNumbers = [];
    foreach ($data['entreeIterms'] as $entreeIterm) {
      $product = Produit::find($entreeIterm->produit_id);
      $sn = SerialNumber::where('product_id', $product->id)->where('entree_id', $entree->id)->get();

      $serialNumbers[] = [
        'designation' => $product->designation,
        'serialNumbers' => $sn
      ];
    }
    $data['serialNumbers'] = $serialNumbers;


    $entrepot_id = $entree->entrepot_id;
    $entrepot = Entrepot::findOrFail($entrepot_id);
    $data['entrepot'] = $entrepot;

    if (!empty($entree->supplier_id)) {
      $fournisseur_id = $entree->supplier_id;
      $fournisseur = Supplier::findOrFail($fournisseur_id);
      $data['fournisseur'] = $fournisseur;
    } else {
      $fournisseur_id = $entree->provider_id;
      $fournisseur = Provider::findOrFail($fournisseur_id);
      $data['fournisseur'] = $fournisseur;
    }

    $date = $entree->date;
    $carbonDate = Carbon::createFromFormat('Y-m-d', $date);
    $carbonDate->locale('fr');
    $data['date'] = $carbonDate->translatedFormat('l j F Y'); 
    $author = User::findOrFail($entree->author);
    $data['name'] = $author->name;
    $data['poste'] = $author->poste;
    $data['prenom'] = $author->first_name;
    $data['sign'] = $author->signature;

    $pdf = \PDF::loadView('pages.back.admin.stocks.entree.printer', $data);

    $pdf->render();


    $totalPages = $pdf->getDomPDF()->get_canvas()->get_page_count();
    $data['totalPages'] = $totalPages;

    $pdf->setPaper('a4', 'portrait');

    $fileName = 'entrees/' . $entrepot->name . '/' . $ref_entree . '.pdf';

    $pdfContent = $pdf->output();

    // Sauvegarder le PDF dans le stockage
    Storage::put($fileName, $pdfContent);

    // Mettre à jour le chemin du document dans la table "entrees"
    $entree->document_path = $fileName;
    $entree->save();

    // Afficher le PDF dans le navigateur
    return $pdf->stream("facture.pdf");
  }



  public function printerSortie(Request $request)
  {
    $orderRef = url()->current();
    $extractLink = Str::after($orderRef, 'impression/sortie/');
    $ref_sortie = $extractLink;
    // Find entree
    $sortie = Sortie::Where('ref_sortie', '=', $ref_sortie)->first();

    if ($sortie && $sortie->document_path) {
      // Si un fichier existe dans la base de données, affichez-le en streaming
      $filePath = $sortie->document_path;
      $pdfContent = Storage::get($filePath);

      return response($pdfContent, 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="bon_de_sortie_' . $sortie->date . '.pdf"'
      ]);
    }

    $data['sortie'] = $sortie;



    // Find the sortieItems
    $sortieItems = SortieIterm::where('ref_sortie', '=', $ref_sortie)->get();
    $data['sortieIterms'] = $sortieItems;

    // Get the serial numbers
    $serialNumbers = [];
    foreach ($sortieItems as $sortieItem) {
      $product = Produit::find($sortieItem->produit_id);
      $sn = SerialNumber::where('product_id', $product->id)->where('sortie_id', $sortie->id)->get();

      $serialNumbers[] = [
        'designation' => $product->designation,
        'serialNumbers' => $sn
      ];
    }
    $data['serialNumbers'] = $serialNumbers;


    // dd($serialNumbers);
    // Entrepot
    $entrepot_id = $sortie['entrepot_id'];
    $entrepot = Entrepot::findOrFail($entrepot_id);
    $data['entrepot'] = $entrepot;

    $fournisseur_id = $sortie['customer_id']; //fournisseur est customer
    $fournisseur = Client::findOrFail($fournisseur_id);
    $data['fournisseur'] = $fournisseur;
    // dd($fournisseur_id);
    // Date format

    $date = $sortie['date'];

    $carbonDate = Carbon::createFromFormat('Y-m-d', $date);

    // définir la langue en français
    $carbonDate->locale('fr');
    $data['date'] = $carbonDate->translatedFormat('l j F Y'); // formater la date en utilisant le format "Vendredi 14 Avril 2023"

    // Author
    $author = Auth::user();
    $data['name'] = $author->name;
    $data['poste'] = $author->poste;
    $data['prenom'] = $author->first_name;
    $data['sign'] = $author->signature;


    // dd($date);

    $pdf = \PDF::loadView('pages.back.admin.stocks.sortie.printer', $data);

    // Rendre le contenu HTML en PDF
    $pdf->render();

    // Obtenir le nombre total de pages
    $totalPages = $pdf->getDomPDF()->get_canvas()->get_page_count();
    $data['totalPages'] = $totalPages;

    $pdf->setPaper('a4', 'portrait');

    $fileName = 'sorties' . '/' . $entrepot->name . '/' . $ref_sortie . '.pdf';

    $pdfContent = $pdf->output();

    // Sauvegarder le PDF dans le stockage
    Storage::put($fileName, $pdfContent);

    // Mettre à jour le chemin du document dans la table "sorties"
    $sortie->document_path = $fileName;
    $sortie->save();
    // Afficher le PDF dans le navigateur
    return $pdf->stream("BL-" . $sortie->date . ".pdf");
  }
}
