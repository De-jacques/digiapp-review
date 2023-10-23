<?php

namespace App\Http\Controllers;

use App\Models\Entree;
use App\Models\EntreeIterm;
use App\Models\PreRelease;
use App\Models\Proforma;
use App\Models\SerialNumber;
use App\Models\snIterms;
use App\Models\Sortie;
use App\Models\SortieIterm;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SerialNumberController extends Controller
{


    public function index()
    {
        $data['snIterms'] = SerialNumber::all();
        return view('pages.back.admin.stocks.sn.index', $data);
    }
    public function stock()
    {
        $data['snIterms'] = SerialNumber::where('status', '=', 'stock')->get();
        return view('pages.back.admin.stocks.sn.index', $data);
    }
    public function solde()
    {
        $data['snIterms'] = SerialNumber::where('status', '=', 'solde')->get();
        return view('pages.back.admin.stocks.sn.index', $data);
    }


    public function makeSn($ref_entre)
    {
        $data['ref_entree'] = $ref_entre;
        $data['entree'] = Entree::where('ref_entree', $ref_entre)->first();
        $data['entreeIterms'] = EntreeIterm::where('ref_entree', $ref_entre)->get();

        foreach ($data['entreeIterms'] as $item) {
            $registeredSnCount = SerialNumber::where('ref_entree', $ref_entre)
                ->where('product_id', $item->produit_id)
                ->count();
            $item->qte_livre -= $registeredSnCount;
        }

        $data['snIterms'] = SerialNumber::where('ref_entree', $ref_entre)->get();

        return view('pages.back.admin.stocks.sn.create', $data);
    }


    public function out($ref_sortie)
    {

        $data['ref_sortie'] = $ref_sortie;
        $preRealese = PreRelease::where('ref_sortie', $ref_sortie)->get();
        $data['sortie'] = $preRealese;
        $data['serialNumbers'] = SerialNumber::all();

        return view('pages.back.admin.stocks.sn.out', $data)->with('ref_sortie', $ref_sortie);
    }

    public function store(Request $request)
    {
        $productIds = $request->input('productId');

        $serialNumbers = $request->input('sn');

        $entree = Entree::where('ref_entree', '=', $request->ref_entree)->first();
        $uuid = Str::uuid()->toString();


        for ($i = 0; $i < count($productIds); $i++) {
            $product_id = $productIds[$i];
            $serial_number = $serialNumbers[$i];

            if ($serial_number !== null) {
                $serialNumber = new SerialNumber();
                $serialNumber->uuid = Str::uuid()->toString();
                $serialNumber->supplier_id = $entree->supplier_id ?? null;
                $serialNumber->customer_id = $entree->customer_id ?? null;
                $serialNumber->provider_id = $entree->provider_id ?? null;
                $serialNumber->entree_id = $entree->id ?? null;
                $serialNumber->ref_entree = $request->ref_entree;
                $serialNumber->serial_number = $serial_number;
                $serialNumber->product_id = $product_id;
                $serialNumber->status = 'stock';
                $serialNumber->save();
            }
        }

        return redirect()->route('stocks.entre')->with('message', 'Les sérial numbers ont été enregistrés avec succès.');
    }

    public function outOf(Request $request)
    {

        $productIds = $request->input('productId');
        $serialNumbers = $request->input('sn');

        $release = PreRelease::where('ref_sortie', '=', $request->ref_sortie)->get();
        $release->toArray();
        $baseRelease = $release[0];
        $proforma = Proforma::find($baseRelease->proforma_id)->first();
        $ref_proforma = $proforma->ref_proforma;
        $user = Auth::user();

        $sortie = new Sortie();
        $sortie->uuid = Str::uuid()->toString();
        $sortie->ref_sortie = $request->ref_sortie;
        $sortie->ref_proforma = $ref_proforma;
        $sortie->date = $baseRelease->date;
        $sortie->author = $user->id;
        $sortie->num_facture = $baseRelease->num_facture;
        $sortie->facture_path = $baseRelease->facture_path;
        $sortie->entrepot_id = $baseRelease->entrepot_id;
        $sortie->customer_id = $baseRelease->customer_id;
        $sortie->save();

        $releases = PreRelease::where('ref_sortie', '=', $request->ref_sortie)->get();

        foreach ($releases as $item) {
            $sortieItem = new SortieIterm();
            $sortieItem->sortie_id = $sortie->id;
            $sortieItem->produit_id = $item->product_id;
            $sortieItem->qte_dmd = $item->qte_dmd;
            $sortieItem->qte_livre = $item->qte_livre;
            $sortieItem->reste = $item->reste;
            $sortieItem->observation = $item->observation;
            $sortieItem->uuid = Str::uuid()->toString();
            $sortieItem->ref_sortie = $request->ref_sortie;
            $sortieItem->save();

            // Retrait de la quantité du produit dans le stock
            $stock = Stock::where('produit_id', '=', $item->product_id)
                ->where('entrepot_id', '=', $sortie->entrepot_id)
                ->first();

            if (!$stock) {
                return back()->with('error', 'Le produit n\'est pas disponible dans le stock.');
            }

            $qteStock = $stock->quantite;
            $qteLivre = $item->qte_livre;

            if ($qteStock < $qteLivre) {
                return back()->with('error', 'La quantité demandée est supérieure à la quantité disponible.');
            }

            $stock->quantite -= $qteLivre;
            $stock->save();
        }

        for ($i = 0; $i < count($productIds); $i++) {
            $produit = $productIds[$i];
            $sn_item = $serialNumbers[$i];

            if ($sn_item !== null) {
                $serialNumber = SerialNumber::find($sn_item);
                if ($serialNumber) {
                    if ($serialNumber->product_id == $produit) {
                        $serialNumber->uuid = Str::uuid()->toString();
                        $serialNumber->customer_id = $sortie->customer_id ?? null;
                        $serialNumber->sortie_id = $sortie->id ?? null;
                        $serialNumber->ref_sortie = $request->ref_sortie;
                        $serialNumber->uuid_sortie = $sortie->uuid;
                        $serialNumber->status = "solde";
                        $serialNumber->save();
                    } else {
                        return back()->with('error', 'Les numéros de série sélectionnés ne correspondent pas aux produits associés.');
                    }
                } else {
                    return back()->with('error', 'Une erreur est survenue !');
                }
            }
        }

        $releases->each->delete();

        return redirect()->route('sorties.index')->with('message', 'Les sérial numbers ont été enregistrés avec succès.');
    }

    public function edit($ref_entre)
    {
        $data['ref_entree'] = $ref_entre;
        $data['entree'] = Entree::where('ref_entree', $ref_entre)->first();
        $data['entreeIterms'] = EntreeIterm::where('ref_entree', $ref_entre)->get();

        $compter = 0;

        foreach ($data['entreeIterms'] as $item) {
            $registeredSnCount = SerialNumber::where('ref_entree', $ref_entre)
                ->where('product_id', $item->produit_id)
                ->count();

            $item->qte_livre -= $registeredSnCount;
            $compter += $item->qte_livre;
        }

        $data['snIterms'] = SerialNumber::where('ref_entree', $ref_entre)->get();

        return view('pages.back.admin.stocks.sn.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $productIds = $request->input('productId');
        $serialNumbers = $request->input('sn');
        $entree = Entree::where('ref_entree', '=', $request->ref_entree)->first();

        for ($i = 0; $i < count($serialNumbers); $i++) {
            $product_id = $productIds[$i];
            $serial_number = $serialNumbers[$i];

            if ($serial_number !== null) {
                $serialNumber = new SerialNumber();
                $serialNumber->uuid = Str::uuid()->toString();
                $serialNumber->supplier_id = $entree->supplier_id ?? null;
                $serialNumber->customer_id = $entree->customer_id ?? null;
                $serialNumber->provider_id = $entree->provider_id ?? null;
                $serialNumber->entree_id = $entree->id ?? null;
                $serialNumber->ref_entree = $request->ref_entree;
                $serialNumber->serial_number = $serial_number;
                $serialNumber->product_id = $product_id;
                $serialNumber->status = 'stock';
                $serialNumber->save();
                return redirect()->route('stocks.entre')->with('message', 'Les sérial numbers ont été enregistrés avec succès.');
            } else {

                return redirect()->route('stocks.entre')->with('alerte', 'Pas de nouvel enregistrement !.');
            }
        }
    }


    public function destroy(string $id)
    {
        //
    }

    public function getSerialNumbers(Request $request)
    {
        $productId = $request->input('productId');

        // Récupérer les numéros de série associés à l'ID du produit
        $serialNumbers = SerialNumber::where('product_id', '=', $productId)->where('status', "stock")->get();

        return response()->json($serialNumbers);
    }
}
