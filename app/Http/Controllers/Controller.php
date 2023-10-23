<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Entreprise;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
/*
    public function getContactEntreprise(Request $request)
    {
        $id = $request->id;
        $contact = Contact::where('entreprise_id',$request->$id)->get();
        $entreprise = Entreprise::find($request->$id);

        return view('pages.back.admin.clients.entreprise.contacts', compact('contact','entreprise'));

    }*/
}
