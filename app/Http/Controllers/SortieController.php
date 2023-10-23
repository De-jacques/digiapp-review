<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Entrepot;
use App\Models\Produit;
use App\Models\Proforma;
use App\Models\Provider;
use App\Models\SerialNumber;
use App\Models\Sortie;
use App\Models\SortieIterm;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class SortieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['entrepots'] = Entrepot::all();
        $data['fournisseurs'] = Provider::all();
        $data['produits'] = Produit::all();
        $data['sorties'] = Sortie::all();
        $data['proforma'] = Proforma::all();

        return view('pages.back.admin.stocks.sortie.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['entrepots'] = Entrepot::all();
        $data['fournisseurs'] = Client::all();
        $data['produits'] = Produit::all();
        $data['proformas'] = Proforma::all();
        $data['sorties'] = Stock::where('quantite', '!=', 0)->get();

        return view('pages.back.admin.stocks.sortie.add_sortie', $data);
    }


    // public function destroy($id)
    // {
    //     try {
    //         $sortie = Sortie::find($id);
    //         $serialNumbers = SerialNumber::where('sortie_id', $id)->get();


    //         foreach ($serialNumbers as $serialNumber) {
    //             $serialNumber->status = "stock";
    //             $serialNumber->uuid_sortie = null;
    //             $serialNumber->sortie_id = null;
    //             $serialNumber->ref_sortie = null;
    //             $serialNumber->customer_id = null;
    //             $serialNumber->save();
    //         }

    //         // Restaurer les quantités en stock des produits associés à la sortie
    //         $sortieIterms = SortieIterm::where('sortie_id', $id)->get();

    //         foreach ($sortieIterms as $sortieIterm) {
    //             $stock = Stock::where('produit_id', $sortieIterm->produit_id)->where('entrepot_id', $sortie->entrepot_id)->first();
    //             if (!is_null($stock->quantite)) {
    //                 $stock->quantite += $sortieIterm->qte_livre;
    //                 $stock->save();
    //             }
    //         }

    //         $sortie->sortieIterms()->delete();

    //         $sortie->delete();

    //         return redirect()->back()->with('message', "Le bon de sortie a été supprimé avec succès.");
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la suppression du bon de livraison : ' . $e->getMessage());
    //     }
    // }


    public function destroy($id)
    {
        try {
            // Utiliser des transactions pour garantir l'intégrité des données
            DB::beginTransaction();

            $sortie = Sortie::findOrFail($id);
            $serialNumbers = SerialNumber::where('sortie_id', $id)->get();

            // Réinitialiser les numéros de série associés au bon de sortie
            foreach ($serialNumbers as $serialNumber) {
                $serialNumber->status = "stock";
                $serialNumber->uuid_sortie = null;
                $serialNumber->sortie_id = null;
                $serialNumber->ref_sortie = null;
                $serialNumber->customer_id = null;
                $serialNumber->save();
            }

            // Restaurer les quantités en stock des produits associés à la sortie
            $sortieIterms = $sortie->sortieIterms;
            foreach ($sortieIterms as $sortieIterm) {
                $stock = Stock::where('produit_id', $sortieIterm->produit_id)
                    ->where('entrepot_id', $sortie->entrepot_id)
                    ->first();

                if ($stock) {
                    $stock->quantite += $sortieIterm->qte_livre;
                    $stock->save();
                }
            }

            // Supprimer les éléments de sortie associés
            $sortie->sortieIterms()->delete();

            // Supprimer le bon de sortie lui-même
            $sortie->delete();

            // Toutes les opérations ont été effectuées avec succès, on commit la transaction
            DB::commit();

            return redirect()->back()->with('message', "Le bon de sortie a été supprimé avec succès.");
        } catch (\Exception $e) {
            // En cas d'erreur, on annule la transaction
            DB::rollback();

            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la suppression du bon de livraison : ' . $e->getMessage());
        }
    }

    public function getCustomer()
    {
        $customers = [];

        $customers['suppliers'] = Client::all();

        return response()->json($customers);
    }
}
