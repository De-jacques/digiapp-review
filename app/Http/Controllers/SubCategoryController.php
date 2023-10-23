<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\SubCategory;


use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $data['sub_categories'] = SubCategory::all();
        $data['categories'] = Categorie::all();
        return view('pages.back.admin.produits.categories.sub_categories', $data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ], [
            'category_id.required' => 'Vous n\'avez sélectionné la catégorie !.',
            // 'marque_id....' => 'Message d\'erreur personnalisé pour la règle de validation ...',
        ]);

        try {
            SubCategory::create($request->post());
            return redirect()->back()->with('message', 'la sous catégorie a été crée avec succès.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'la sous catégorie n\'a été ajoutée suite à une érreur, veuillez actualisé la page et reprendre l\'enrégistrement. Merci !');

        }

    }


    public function update(Request $request, $id)
    {
        $a = SubCategory::findOrFail($id);

        $a->fill($request->post())->save();


        return redirect()->back()->with('message', 'la catégorie a été mise à jour avec succès !');

    }


    public function destroy(SubCategory $sub_category)
    {
        $sub_category->delete();

        return redirect()->back()->with('message', 'la catégorie a été supprimé avec succès');
    }
}