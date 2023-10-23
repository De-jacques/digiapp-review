<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proforma;
use App\Models\Client as Customer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProformaMail;

class EmailController extends Controller
{
    public function sendMail(Request $request)
    {
        $orderRef = url()->current();
        $extractLink = Str::after($orderRef, 'impression/');
        $deleteOrderOnLink = Str::before($extractLink, '/edit');
        $refProforma = $deleteOrderOnLink;
        $proforma = Proforma::where('ref_proforma', '=', $refProforma)->get();
        $data['proforma'] = $proforma;

        $id = $proforma['customer_id'];
        $customer = Customer::find($id)->nom;

        $data['file'] = public_path('/' . 'uploads/' . $customer . '/proformas/proforma.pdf');

        return view('pages.back.admin.proformas.send-mail', $data);
    }

    public function proformaEmail(Request $request)
    {

        $orderRef = url()->current();
        $extractLink = Str::after($orderRef, 'email/');
        $refProforma = $extractLink;
        $pro = Proforma::where('ref_proforma', '=', $refProforma)->get()->toArray();
        $proforma = $pro[0];
        $data['note'] = $proforma['note'];
        $data['ref_proforma'] = $proforma['ref_proforma'];

        // Customer
        $customer = $proforma['customer_id'];
        $data['customer'] = Customer::find($customer)->nom;
        $data['customer_adress'] = Customer::find($customer)->email;



        $data['subject'] = 'Test subject';
        $data['body'] = 'Message from';

        // Le path        
        $data['path'] = storage_path() . '/app' . '/' . $data['customer'] . '/proformas' . '/' . $refProforma . '.pdf';

        $check = @fopen($data['path'], 'r');

        // Vérifier si le fichier existe
        if (!$check) {
            return back()->with('probleme', "Une erreur s'est produite, veuillez enrégistrer la proforma svp ! Celle sélectionnée n'existe pas ! \n   Pour se faire veuiller cliquer sur l'icone d'impression");
        }

        Mail::to($data['customer_adress'])
            ->send(new ProformaMail($data));


        return redirect()->route('proformas.index')->with('message', 'Email envoyé avec succès !');
    }

}