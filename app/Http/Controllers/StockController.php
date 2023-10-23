<?php

namespace App\Http\Controllers;

use App\Models\Entree;
use App\Models\EntreeIterm;
use App\Models\Entrepot;
use App\Models\Produit;
use App\Models\Provider;
use App\Models\SerialNumber;
use App\Models\Stock;
use App\Models\Supplier;
use FontLib\Table\Type\name;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StockController extends Controller
{

    public function getQuantiteByEntrepot($entrepot_id, $produit_id)
    {
        $quantite = Stock::where('entrepot_id', $entrepot_id)->where('produit_id', $produit_id)->value('quantite');
        return response()->json(['quantite' => $quantite]);
    }

    public function getEntre()
    {
        $data['entrepots'] = Entrepot::all();
        $data['fournisseurs'] = Provider::all();
        $data['produits'] = Produit::all();
        $data['entrees'] = Entree::all();

        return view('pages.back.admin.stocks.entree.entre', $data);
    }
    public function getAddEntre()
    {
        $data['entrepots'] = Entrepot::all();
        $data['fournisseurs'] = Provider::all();
        $data['produits'] = Produit::all();
        $data['entrees'] = Stock::where('quantite', '!=', 0)->get();

        return view('pages.back.admin.stocks.entree.add_entre', $data);
    }
    public function editEntre($id)
    {
        $data['entree'] = Entree::find($id)->first();
        $data['entrepots'] = Entrepot::all();
        $data['fournisseurs'] = Provider::all();
        $data['prestataires'] = Provider::all();
        $data['produits'] = Produit::all();
        $data['entrees'] = Stock::where('quantite', '!=', 0)->get();

        return view('pages.back.admin.stocks.entree.edit', $data);
    }
    public function getProductData(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ], [
            'id.required' => 'Le produit est obligatoire',
        ]);

        $product = Produit::findOrFail($request->id);

        return response()->json($product);
    }

    public function getFournisseur()
    {
        $fournisseur = [];

        $fournisseur['suppliers'] = Supplier::all();

        return response()->json($fournisseur);
    }
    public function getPrestataire()
    {
        $prestataire = [];

        $prestataire['providers'] = Provider::all();

        return response()->json($prestataire);
    }

    public function postEntre(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'entrepot_id' => 'required',
            'fournisseur_id' => 'required',
            'num_bl' => 'required',
            'num_facture' => 'required',
        ], [
            'entrepot_id.required' => 'L\'entrepot est obligatoire',
            'fournisseur_id.required' => 'Le fournisseur est obligatoire',
            'num_bl.required' => 'Le numéro B/L est obligatoire',
            'num_facture.required' => 'Le numéro facture est obligatoire',
        ]);



        $entree = new Entree();
        $entree->entrepot_id = $request->entrepot_id;
        $entree->author = $user->id;
        $entree->num_facture = $request->num_facture;
        $entree->date = $request->date;
        if ($request->prestataire_id != "~~ Choix prestataire~~") {
            $entree->provider_id = $request->prestataire_id;
            // ------------------------------------------------
            // Enregistrement du document de bon de livraison
            if ($request->bl_file) {
                $fn = Provider::find($request->prestataire_id);

                $fn_name = $fn->name;
                $file = $request->bl_file;
                $fileName = 'BL-' . $fn_name . '-' . $request->date . '.' . $file->getClientOriginalExtension();

                // Déplacez le fichier téléchargé dans le répertoire de stockage
                Storage::putFileAs('bl' . '/' . $fn_name . '/', $file, $fileName);

                // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
                $entree->bl_path = $fn_name . '/bl' . '/' . $fileName;
            }
        } else {
            $entree->supplier_id = $request->fournisseur_id;

            // ------------------------------------------------
            // Enregistrement du document de bon de reception
            if ($request->bl_file) {
                $fn = Supplier::find($request->fournisseur_id);

                $fn_name = $fn->name;
                $file = $request->bl_file;
                $fileName = 'BL-' . $fn_name . '-' . $request->date . '.' . $file->getClientOriginalExtension();

                // Déplacez le fichier téléchargé dans le répertoire de stockage
                Storage::putFileAs('bl' . '/' . $fn_name . '/', $file, $fileName);

                // Enregistrez le chemin d'accès du fichier dans la base de données ou effectuez d'autres opérations
                $entree->bl_path = $fn_name . '/bl' . '/' . $fileName;
            }
        }
        $entree->num_bl = $request->num_bl;
        $entree->ref_entree = 'BR' . '-' . date("dmy-His");
        $entree->uuid = Str::uuid();
        $entree->save();
        // dd($entree->bl_path);
        // dd($request->productName);

        

        for ($i = 0; $i < count($request->productName); $i++) {
            // Convertir l'identifiant du produit en entier
            // $convertProductId = intval($request->productName[$i]);
            // dd($convertProductId);
            //Fouiller dans le stock histoire de retrouver le produit et augmenter sa quantité
            $stock = Stock::Where('produit_id', $request->productName[$i])->where('entrepot_id', $request->entrepot_id)->first();
            // dd($stock);

            // dd($stock);
            $stock->quantite += $request->qte_livre[$i];
            $stock->save();

            $entreItem = new EntreeIterm();
            $entreItem->uuid = Str::uuid();
            $entreItem->entree_id = $entree->id;
            $entreItem->ref_entree = $entree->ref_entree;
            $entreItem->produit_id = $request->productName[$i];
            $entreItem->qte_cmd = $request->quantity[$i];
            $entreItem->qte_livre = $request->qte_livre[$i];
            $entreItem->reste = $request->quantity[$i] - $request->qte_livre[$i];
            $entreItem->observation = $request->observation[$i];
            $entreItem->save();
        }

        return redirect()->route('serial-number.makeSn', $entree->ref_entree)->with('message', 'Bon d\'entrée ajouté avec succès');





        // return redirect()->route('stocks.entre')->with('message', 'Bon d\'entrée ajouté avec succès');
    }


    public function getFactureClientByClient(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',

        ], [
            'id.required' => 'Le client est requis',
        ]);

        $client = Provider::findOrFail($request->id);
        $factures = $client->factures;
        $operations = $client->operations;

        $outputFactures = '';
        $outputOperations = '';

        if ($factures->count() > 0) {
            foreach ($factures as $item) {
                $outputFactures .= '<tr>
                                <td>' . date('d/m/Y à H:m:s', strtotime($item->created_at)) . '</td>
                                <td>' . $item->reference . '</td>
                                <td>' . $item->montantTTC . '</td>
                            </tr>';
            }
        } else {
            $outputFactures .= '<tr><td colspan="3" class="text-center">Aucune facture</td></tr>';
        }



        if ($operations->count() > 0) {
            foreach ($operations as $item) {
                $outputOperations .= '<tr>
                <td>' . date('d/m/Y à H:m:s', strtotime($item->created_at)) . '</td>
                                <td>' . $item->compte->libelle . '</td>
                                <td>' . $item->montant . '</td>
                            </tr>';
            }
        } else {
            $outputOperations .= '<tr><td colspan="3" class="text-center">Aucune opération</td></tr>';
        }

        return response()->json([
            'factures' => $outputFactures,
            'operations' => $outputOperations,
            'client' => $client,
        ]);
    }

    public function listProduct()
    {
        $produits = Produit::orderBy('id', 'desc')->get();
        return response()->json($produits);
    }



    // public function deleteEntree(Entree $entree)
    // {
    //     try {
    //         // Récupérer les numéros de série associés à l'entrée
    //         $sn = SerialNumber::where('ref_entree', $entree->ref_entree)->get();
    //         $entreeIterms = EntreeIterm::where('ref_entree', $entree->ref_entree)->get();

    //         // Vérifier si la quantité à retirer est inférieure ou égale à la quantité disponible en stock (DBR)
    //         foreach ($entreeIterms as $item) {
    //             $stock = Stock::where('produit_id', $item->produit_id)->where('entrepot_id', $entree->entrepot_id)->first();
    //             $qteDisponible = $stock->quantite;

    //             if ($item->qte_livre <= $qteDisponible) {

    //                 // Retirer la quantité de stock
    //                 $stock->quantite -= $item->qte_livre;
    //                 $stock->save();
    //             } else {
    //                 return redirect()->back()->with('error', "La quantité à retirer est supérieure à la quantité disponible en stock. L'entrée ne peut pas être supprimée. Veuillez vérifier que les bon de sorties ne correspondent au produit !");
    //             }
    //         }

    //         // Supprimer les numéros de série associés à l'entrée
    //         $sn->each->delete();

    //         // Supprimer les fractionnements associés à l'entrée
    //         $entreeIterms->each->delete();

    //         // Supprimer l'entrée elle-même
    //         $entree->delete();

    //         return redirect()->back()->with('message', "Le bon d'entrée a été supprimé avec succès.");
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la suppression du bon d\'entrée : ' . $e->getMessage());
    //     }
    // }

    public function deleteEntree(Entree $entree)
    {
        try {
            // Récupérer les numéros de série associés à l'entrée
            $sn = SerialNumber::where('ref_entree', $entree->ref_entree)->get();
            $entreeIterms = EntreeIterm::where('ref_entree', $entree->ref_entree)->get();

            // Vérifier si la quantité à retirer est inférieure ou égale à la quantité disponible en stock (DBR)
            foreach ($entreeIterms as $item) {
                $stock = Stock::where('produit_id', $item->produit_id)->where('entrepot_id', $entree->entrepot_id)->first();

                if ($stock && $item->qte_livre <= $stock->quantite) {
                    // Retirer la quantité de stock
                    $stock->quantite -= $item->qte_livre;
                    $stock->save();
                } else {
                    return redirect()->back()->with('error', "La quantité à retirer est supérieure à la quantité disponible en stock. L'entrée ne peut pas être supprimée. Veuillez vérifier que les bons de sortie ne correspondent pas au produit !");
                }
            }

            // Supprimer les numéros de série associés à l'entrée
            $sn->each->delete();

            // Supprimer les fractionnements associés à l'entrée
            $entreeIterms->each->delete();

            // Supprimer l'entrée elle-même
            $entree->delete();

            return redirect()->back()->with('message', "Le bon d'entrée a été supprimé avec succès.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la suppression du bon d\'entrée : ' . $e->getMessage());
        }
    }
}
