<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;

class Setting extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produit = Produit::first();
        if ($produit == null) {
            return redirect()->route('produits.create')->with('message', "Veuillez insérer au moins un produit !");
        } else {
            $marge = Produit::all()->first()->marge;
            $marge_goov = Produit::all()->first()->marge_goov;
            $data['marge'] = $marge;
            $data['marge_goov'] = $marge_goov;
            return view('pages.back.admin.settings.set', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Get pass blade
     */
    public function pass()
    {
        $data['user'] = Auth::user();
        // dd($data['user']);
        return view('pages.back.admin.settings.pass', $data);
    }


    public function updateMarge(Request $request)
    {
        $marge = $request->input('marge');

        $produits = Produit::all();

        foreach ($produits as $produit) {
            $prixRevient = $produit->prix_revient;
            $prixVente = $prixRevient * (1 + ($marge / 100));
            $prixGoov = $prixVente; // Modifier le prix goov également si nécessaire

            $produit->marge = $marge;
            $produit->prix_vente = $prixVente;
            $produit->prix_goov = $prixGoov;

            $produit->save();
        }

        return redirect()->back()->with('success', 'La marge des produits a été mise à jour avec succès.');
    }
    public function testmyapp()
    {
        return view('pages.back.admin.proformas.testmyapp');
    }
    public function testmyappPost()
    {
        dd('succes');
    }

    public function updateMargeGoov(Request $request)
    {
        $marge_goov = $request->input('marge_goov');

        $produits = Produit::all();

        foreach ($produits as $produit) {
            $prixRevient = $produit->prix_revient;
            $prixGoov = $prixRevient * (1 + ($marge_goov / 100));

            // Modifier le prix goov également si nécessaire

            $produit->marge_goov = $marge_goov;
            $produit->prix_goov = $prixGoov;

            $produit->save();
        }

        return redirect()->back()->with('success', 'La marge des produits a été mise à jour avec succès.');
    }
}
