<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\PreRelease;
use App\Models\SerialNumber;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PreReleaseController extends Controller
{

    public function store(Request $request)
    {

        foreach ($request->productName as $key => $prod) {
            // Rechercher le produit dans la table Stock
            $stock = Stock::where('produit_id', $prod)->where('entrepot_id', $request->entrepot_id)->first();
            if (!$stock) {
                // Si le produit n'existe pas dans la table Stock, vous pouvez décider de créer un nouvel enregistrement ou de le gérer selon votre logique métier.
                return redirect()->back()->with('error', 'Le produit n\'est pas disponible dans le stock.');
            }

            $qteStock = $stock->quantite;
            $qteLivre = $request->qte_livre[$key];
            if ($qteStock < $qteLivre) {

                return redirect()->back()->with('error', 'La quantité demandée est supérieure à la quantité disponible.');
            }

            $sn = SerialNumber::Where('product_id', '=', $prod)->where('status', '=', "stock")->get();

            if ($sn == null) {

                return redirect()->back()->with('error', "l'un des produits saisis n'a pas de S/N suffisant en stock !");

            }

            if ($prod) {
                $preRelease = new PreRelease();
                $preRelease->product_id = $prod;
                $preRelease->customer_id = $request->customer_id;
                $preRelease->entrepot_id = $request->entrepot_id;
                $preRelease->proforma_id = $request->proforma_id;
                $preRelease->num_facture = $request->num_facture;

                if ($request->facture_file) {
                    $Cust_name = Client::findOrFail($preRelease->customer_id)->nom;
                    $file = $request->facture_file;
                    $fileName = 'FACTURE-' . $Cust_name . '.' . $file->getClientOriginalExtension();

                    // Déplacez le fichier téléchargé dans le répertoire de stockage
                    Storage::putFileAs($Cust_name . '/factures', $file, $fileName);

                    // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations

                    $preRelease->facture_path = $Cust_name . '/factures' . '/' . $fileName;
                }

                $preRelease->date = $request->date;
                $preRelease->qte_dmd = $request->quantity[$key];
                $preRelease->qte_livre = $request->qte_livre[$key];
                $preRelease->reste = $request->reste[$key];
                $preRelease->observation = $request->observation[$key];
                $preRelease->uuid = Str::uuid(); // Génère un UUID
                $preRelease->ref_sortie = 'BL' . '-' . date("dmy-His");

                $preRelease->save();
            }
        }

        return redirect()->route('sn.out', ['sortie' => $preRelease->ref_sortie])->with('message', 'Prémière étape réalisée avec succès');
    }

    public function deleteAll()
    {
        // Supprimer toutes les entrées de la table preRelease
        // PreRelease::truncate();
        $ord = PreRelease::all();
        $ord->delete();

        // Retourner une réponse indiquant que la table a été vidée avec succès
        return response()->json(['message' => 'La table preRelease a été vidée.']);
    }


}