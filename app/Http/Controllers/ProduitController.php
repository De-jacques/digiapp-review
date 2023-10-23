<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Marque;
use App\Models\Entrepot;
use App\Models\Stock;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProduitController extends Controller
{

    private function getCommonData()
    {
        return [
            'produits' => Produit::orderBy('designation', 'ASC')->get(),
            'categories' => Categorie::orderBy('name', 'ASC')->get(),
            'marques' => Marque::orderBy('name', 'ASC')->get(),
            'stock' => Stock::all(),
            'entrepots' => Entrepot::orderBy('name', 'ASC')->get(),
            'sousCat' => SubCategory::all(),
        ];
    }

    public function index()
    {
        $data = $this->getCommonData();

        if ($data['produits']->isEmpty() && isset($data['sousCat']) && isset($data['stock']) && isset($data['entrepots']) && isset($data['marques']) && isset($data['categories'])) {
            return redirect()->route('produits.create')->with('message', 'Aucun produit trouvé. Veuillez créer un nouveau produit.');
        }

        return view('pages.back.admin.produits.index', $data);
    }

    public function importer()
    {
        return view('pages.back.admin.produits.importer');
    }
    public function create()
    {
        $data['produits'] = Produit::orderBy('designation', 'ASC')->get();
        $data['categories'] = Categorie::orderBy('name', 'ASC')->get();
        $data['marques'] = Marque::orderBy('name', 'ASC')->get();
        $data['stock'] = Stock::all();
        $data['entrepots'] = Entrepot::orderBy('name', 'ASC')->get();
        $data['sousCat'] = SubCategory::all();


        return view('pages.back.admin.produits.create', $data);
    }

    public function edit($id)
    {
        $data['produit'] = Produit::find($id);
        $data['produits'] = Produit::orderBy('designation', 'ASC')->get();
        $data['categories'] = Categorie::orderBy('name', 'ASC')->get();
        $data['marques'] = Marque::orderBy('name', 'ASC')->get();
        $data['stock'] = Stock::all();
        $data['entrepots'] = Entrepot::orderBy('name', 'ASC')->get();
        $data['sousCat'] = SubCategory::all();


        return view('pages.back.admin.produits.edit', $data);
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
    public function listProduct()
    {
        $produits = Produit::orderBy('id', 'desc')->get();
        return response()->json($produits);
    }

    public function store(Request $request)
    {
        $request->validate([
            'designation' => 'required',
            // 'category_id' => 'required'
        ]);

        if ($request->description) {
            $request['description'] = trim($request->description);
        }


        Produit::create($request->post());

        return redirect()->route('produits.index')->with('message', 'Produit a été créé avec succès.');
    }


    public function show(Produit $produit)
    {
        return view('pages.back.admin.produits.index', compact('produit'));
    }


    public function update(Request $request, $id)
    {
        $a = Produit::findOrFail($id);

        $a->fill($request->post())->save();


        return redirect()->route('produits.index')->with('message', 'Article mis à jour avec succès !');
    }



    // public function destroy(Produit $produit)
    // {


    //     if ($produit->proformaItems()->exists()) {
    //         // Produit lié à une proforma, refuser la suppression et afficher un message d'erreur
    //         return back()->with('error', 'Impossible de supprimer ce produit car il est lié à une proforma.');
    //     }

    //     // Récupérer tous les stocks associés au produit
    //     $stock = Stock::where('produit_id', $produit->id)->get();
    //     foreach ($stock as $key) {
    //         $key->delete();
    //     }

    //     if ($produit->delete()) {
    //         return redirect()->route('produits.index')->with('message', 'Le produit a été supprimé avec succès.');
    //     } else {
    //         return redirect()->route('produits.index')->with('error', 'Oups ! La suppression du produit a échoué.');
    //     }
    // }
    public function destroy(Produit $produit)
    {
        if ($produit->sortieIterms()->exists()) {
            return back()->with('error', 'Impossible de supprimer ce produit car il est lié à un bon de livraison.');
        }
        if ($produit->proformaItems()->exists()) {
            return back()->with('error', 'Impossible de supprimer ce produit car il est lié à une proforma.');
        }
        if ($produit->entreeIterms()->exists()) {
            return back()->with('error', 'Impossible de supprimer ce produit car il est lié à un bon de reception.');
        }

        // Supprimer les stocks associés au produit
        $produit->stock()->delete();

        // Supprimer le produit
        if ($produit->delete()) {
            return redirect()->route('produits.index')->with('message', 'Le produit a été supprimé avec succès.');
        } else {
            return redirect()->route('produits.index')->with('error', 'Oups ! La suppression du produit a échoué.');
        }
    }
}
