<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategorieController extends Controller
{

    public function index()
    {
        $data['categories'] = Categorie::all();
        $data['sub_categories'] = SubCategory::all();
        return view('pages.back.admin.produits.categories.index', $data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            Categorie::create($request->post());

            return redirect()->back()->with('message', 'la catégorie a été crée avec succès.');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'la catégorie n\'a été ajoutée suite à une érreur, veuillez actualiser la page et reprendre l\'enrégistrement. Merci !');

        }

    }


    public function update(Request $request, $id)
    {

        $a = Categorie::findOrFail($id);
        try {
            $a->fill($request->post())->save();

            return redirect()->back()->with('message', 'la catégorie a été mise à jour avec succès.');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'la catégorie n\'a pas été mise à jour suite à une érreur, veuillez actualiser la page et reprendre l\'enrégistrement. Merci !');

        }

    }


    public function destroy(int $id)
    {
        $categorie = Categorie::findOrFail($id);

        try {

            $categorie->delete();
            return redirect()->back()->with('message', 'la catégorie a été rétirée avec succès.');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'la catégorie n\'a été retirée suite à une érreur, veuillez actualiser la page et reprendre l\'enrégistrement. Merci !');

        }

    }
}