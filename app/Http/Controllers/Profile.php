<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Profile extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['user'] = Auth::user();
        // dd($data['user']);
        return view('pages.back.admin.settings.profile', $data);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Valider les données du formulaire avec des messages personnalisés
        $validatedData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|max:20',
            'confirm_password' => 'required|same:new_password',
        ], [
            'old_password.required' => 'Ce champ est requis.',
            'new_password.required' => 'Ce champ est requis.',
            'new_password.min' => 'Ce champ doit contenir au moins :min caractères.',
            'new_password.max' => 'Ce champ doit contenir au maximum :max caractères.',
            'confirm_password.required' => 'Ce champ est requis.',
            'confirm_password.same' => 'Ce champ doit correspondre au champ Nouveau mot de passe.',
        ]);


        // Vérifier si l'ancien mot de passe correspond à celui de l'utilisateur
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'L\'ancien mot de passe est incorrect.');
        }

        // Mettre à jour le mot de passe de l'utilisateur
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('message', 'Le mot de passe a été modifié avec succès.');

    }
}