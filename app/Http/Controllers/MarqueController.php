<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use Illuminate\Http\Request;

class MarqueController extends Controller
{


    public function index()
    {
        $data['marques'] = Marque::all();
        return view('pages.back.admin.produits.marques.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            Marque::create($request->post());

            return redirect()->back()->with('message', 'la marque a été crée avec succès.');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'la marque n\'a été ajoutée suite à une érreur, veuillez actualiser la page et reprendre l\'enrégistrement. Merci !');

        }

    }



    public function update(Request $request, Marque $marque)
    {
        $request->validate([
            'name' => 'required',
        ]);
        try {
            $marque->fill($request->post())->save();

            return redirect()->back()->with('message', 'la marque a été mise à jour avec succès.');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'la marque n\'a pas pu être mise à jour suite à une érreur, veuillez actualiser la page et reprendre la moldification. Merci !');

        }

    }


    public function destroy(Marque $marque)
    {
        try {
            $marque->delete();
            return redirect()->back()->with('message', 'Marque a été supprimée avec succès');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'la marque n\'a pas pu être supprimée suite à une érreur, veuillez actualiser la page et reprendre la moldification. Merci !');

        }
    }

}