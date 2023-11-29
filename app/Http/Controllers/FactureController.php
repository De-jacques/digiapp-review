<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Facture;
use App\Models\Proforma;
use Illuminate\Support\Str;
// use App\Http\Controllers\Proforma;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $factures = Facture::all();
        return view('pages.back.admin.factures.facture_list', compact('factures'));
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
        $request->validate([
            'refFacture' => 'required',
            'uploadInvoice' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:50000'
        ]);
        $prevUrl = url()->previous();
        $extractLink = Str::after($prevUrl, 'uploadFacture/');
        $refProforma = $extractLink;
        $proforma = Proforma::where('ref_proforma', '=', $refProforma)->first();
        $customerId = $proforma->customer_id;
        $proformaId = $proforma->id;
        $client = Client::where('id', $customerId)->get();
        $convertToArray = $client->toArray();
        $clientName = $convertToArray[0]['nom'];
        $file = $request->file('uploadInvoice');
        if ($request->hasfile('uploadInvoice')) {
            $getExtension = $request->file('uploadInvoice')->getClientOriginalExtension();
            $fileUploaded = strtoupper($request->refFacture).'.'.$getExtension;
            $replaceEspaceForDash = str_replace(" ", "-", $clientName);
            $pathStorage ='uploads/factures/'.$replaceEspaceForDash .'/';
            $file->move($pathStorage, $fileUploaded);
            $facture = Facture::where('ref_proforma', '=', $proformaId)->first();
            $updateInvoice = Facture::where('ref_proforma', '=', $proformaId)->update([
                'ref_facture' => strtoupper($request->refFacture),
                'file_invoice' => $fileUploaded,
                'status_facture' => 1,
                'updated_at' => Carbon::now(),
                'path_invoice' =>  $pathStorage
            ]);
            return redirect()->route('factures.index')->with('uploadedInvoice', 'La facture a été ajoutée avec succès.');

            // dd($pathStorage);
            // $day = date('d');
            // $month = date('m');
            // $year = date('Y');
            // $lastValueYear = substr($year, 2);
            // $refDate = $day.''.$month.''.$lastValueYear;
            // $hour = date('His');
            // $fileDoc = $request->file('doc');
            
        // if ($request->type_bon == "BC") {
        //     $refBC = 'BC'.'-'.$refDate.'-'.$hour;
        //     $fileBon = $refBC.'.'.$getExtension;
        //     $replaceEspaceForDash = str_replace(" ", "-", $clientName);
        //     $pathStorage ='uploads/bons/'.$replaceEspaceForDash .'/'.'BC'.'/';
        //     $fileDoc->move($pathStorage, $fileBon);
        //     $saveBC = Bon::create([
        //         'type_bon_id' => 1,
        //         'proforma_id' => $proformaId,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //         'path' => $pathStorage,
        //         'file_bon' => $fileBon,
        //         'bon_ref' => $refBC
        //     ]);
        //     if ($saveBC) {
        //         $findProforma = Proforma::where('id', $proformaId )->update(['status_bon' => 1]);
        //         return redirect()->route('bons.index')->with('success-bon', 'Le bon a été crée avec succès.');   
        //     } else {
        //         return route()->back();
        //     }
        // }
     }
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
}
