<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users'] = User::all();

        return view('pages.back.admin.settings.users', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Vérifier si l'utilisateur connecté a le rôle de super admin
        if (auth()->user()->role !== 'super_admin' && auth()->user()->role !== 'admin') {
            // Rediriger l'utilisateur non autorisé vers une autre page ou afficher un message d'erreur
            return redirect()->route('users.index')->with('error', 'Vous n\'êtes pas autorisé à effectuer cette action.');
        }

        return view('pages.back.admin.settings.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email',
            'poste' => 'nullable',
            'departement' => 'nullable',
            'matricule' => 'nullable',
            'date_naissance' => 'nullable|date',
            'lieu_naissance' => 'nullable',
            'contact' => 'nullable',
            'photo' => 'nullable|image',
            'commune' => 'nullable',
            'quartier' => 'nullable',
            'ville' => 'nullable',
            'sexe' => 'nullable|max:255',
        ]);

        // Créer un nouvel utilisateur avec les données validées
        $user = new User();
        $user->name = $validatedData['name'];
        $user->first_name = $validatedData['first_name'];
        $user->email = $validatedData['email'];
        $user->poste = $validatedData['poste'];
        $user->departement = $validatedData['departement'];
        $user->matricule = $validatedData['matricule'];
        $user->date_naissance = $validatedData['date_naissance'];
        $user->lieu_naissance = $validatedData['lieu_naissance'];
        $user->contact = $validatedData['contact'];
        $user->commune = $validatedData['commune'];
        $user->quartier = $validatedData['quartier'];
        $user->ville = $validatedData['ville'];
        $user->sexe = strtolower($validatedData['sexe']);
        $user->password = Hash::make('Digicorp@2023');


        // Gérer le téléchargement de la photo si elle est présente
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('photos', 'public');
            $user->photo = $photoPath;
        }

        if ($request->hasFile('signature')) {
            $signature = $request->file('signature');
            $signaturePath = $signature->store('signatures', 'public');

            // Enregistrer le chemin du fichier de signature
            $user->signature = $signaturePath;
        }

        // Enregistrer l'utilisateur dans la base de données
        $user->save();

        // Rediriger vers la page appropriée avec un message de succès
        return redirect()->route('users.index')->with('success', 'Utilisateur enregistré avec succès.');
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
        $data['user'] = User::findOrFail($id);

        return view('pages.back.admin.settings.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        // Valider les données de la requête
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            // // Champ optionnel, minimum 6 caractères
            'signature' => 'nullable',
            'poste' => 'nullable',
            'departement' => 'nullable',
            'matricule' => 'nullable',
            'date_naissance' => 'nullable|date',
            'lieu_naissance' => 'nullable',
            'contact' => 'nullable',
            // 'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'photo' => 'nullable',
            // Fichier image, taille maximale 2 Mo
            'first_name' => 'nullable',
            'commune' => 'nullable',
            'quartier' => 'nullable',
            'ville' => 'nullable',
            'sexe' => 'nullable',
            // Ajoutez d'autres règles de validation pour les champs supplémentaires si nécessaire
        ]);


        // Récupérer l'utilisateur à mettre à jour
        $user = User::findOrFail($id);

        // Vérifier si chaque champ existe dans la requête avant de les enregistrer

        if ($request->has('name')) {
            $user->name = $request->input('name');
        }

        if ($request->has('email')) {
            $user->email = $request->input('email');
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password')); // Hasher le mot de passe si fourni
        }

        if ($request->has('signature')) {
            $user->signature = $request->input('signature');
        }

        if ($request->has('poste')) {
            $user->poste = $request->input('poste');
        }

        if ($request->has('departement')) {
            $user->departement = $request->input('departement');
        }

        if ($request->has('matricule')) {
            $user->matricule = $request->input('matricule');
        }

        if ($request->has('date_naissance')) {
            $user->date_naissance = $request->input('date_naissance');
        }

        if ($request->has('lieu_naissance')) {
            $user->lieu_naissance = $request->input('lieu_naissance');
        }

        if ($request->has('contact')) {
            $user->contact = $request->input('contact');
        }

        if ($request->has('first_name')) {
            $user->first_name = $request->input('first_name');
        }

        if ($request->has('commune')) {
            $user->commune = $request->input('commune');
        }

        if ($request->has('quartier')) {
            $user->quartier = $request->input('quartier');
        }

        if ($request->has('ville')) {
            $user->ville = $request->input('ville');
        }

        if ($request->has('sexe')) {
            $user->sexe = $request->input('sexe');
        }
        if ($request->has('role')) {
            $user->role = $request->input('role');
        }

        // dd($request);

        // Gérer le téléchargement de la photo si elle est présente
        if ($request->hasFile('photo')) {

            // Supprimer l'ancienne photo s'il en existe une
            if ($user->photo) {
                Storage::delete($user->photo);
            }

            // Enregistrer la nouvelle photo
            $photoPath = $request->file('photo')->store('photos', 'public');

            // Mettre à jour le champ de la photo dans la base de données
            $user->photo = $photoPath;
        }

        if ($request->hasFile('signature')) {
            $signature = $request->file('signature');
            $signaturePath = $signature->store('signatures', 'public');

            // Enregistrer le chemin du fichier de signature
            $user->signature = $signaturePath;
        }


        // Enregistrer les modifications de l'utilisateur
        $user->save();


        // Rediriger l'utilisateur vers une page de confirmation ou une autre action
        return redirect()->back()->with('success', 'Profil utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        // Supprimer l'utilisateur de la base de données
        $user->delete();

        // Rediriger vers la liste des utilisateurs avec un message de succès
        return redirect()->route('users.index')->with('message', 'Utilisateur supprimé avec succès.');
    }
}
