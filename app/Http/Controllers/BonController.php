<?php

namespace App\Http\Controllers;

use App\Models\Bon;
use App\Models\Client;
use App\Models\Proforma;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class BonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bons = Bon::all();
        return view('pages.back.admin.bons.list_bons', compact('bons'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orderRef = url()->current();
        $extractLink = Str::after($orderRef, 'creer/');
        $refProforma = $extractLink;
        $proforma = Proforma::where('ref_proforma', '=', $refProforma)->first();
        return view('pages.back.admin.bons.bon', compact('refProforma'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $prevUrl = url()->previous();
        $extractLink = Str::after($prevUrl, 'creer/');
        $refProforma = $extractLink;
        $proforma = Proforma::where('ref_proforma', '=', $refProforma)->first();
        $customerId = $proforma->customer_id;
        $proformaId = $proforma->id;
        $client = Client::where('id', $customerId)->get();
        $convertToArray = $client->toArray();
        $clientName = $convertToArray[0]['nom'];
        $request->validate([
            'refProforma' => 'required',
            'doc' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:50000',
            'type_bon' => 'required'
        ]);
         if ($request->hasfile('doc')) {
                $day = date('d');
                $month = date('m');
                $year = date('Y');
                $lastValueYear = substr($year, 2);
                $refDate = $day.''.$month.''.$lastValueYear;
                $hour = date('His');
                $fileDoc = $request->file('doc');
                $getExtension = $request->file('doc')->getClientOriginalExtension();
            if ($request->type_bon == "BC") {
                $refBC = 'BC'.'-'.$refDate.'-'.$hour;
                $fileBon = $refBC.'.'.$getExtension;
                $replaceEspaceForDash = str_replace(" ", "-", $clientName);
                $pathStorage ='uploads/bons/'.$replaceEspaceForDash .'/'.'BC'.'/';
                $fileDoc->move($pathStorage, $fileBon);
                $saveBC = Bon::create([
                    'type_bon_id' => 1,
                    'proforma_id' => $proformaId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'path' => $pathStorage,
                    'file_bon' => $fileBon,
                    'bon_ref' => $refBC
                ]);
                if ($saveBC) {
                    $findProforma = Proforma::where('id', $proformaId )->update(['status_bon' => 1]);
                    return redirect()->route('bons.index')->with('success-bon', 'Le bon a été crée avec succès.');   
                } else {
                    return route()->back();
                }
            }
            elseif ($request->type_bon = "BPA") {
                    $refBPA = 'BPA'.'-'.$refDate.'-'.$hour;
                    $fileBon = $refBPA.'.'.$getExtension;
                    $saveDoc = $refBPA.'.'.$getExtension;
                    $replaceEspaceForDash = str_replace(" ", "-", $clientName);
                    $pathStorage = 'uploads/bons/'.$replaceEspaceForDash .'/'.'BPA'.'/';
                    $fileDoc->move($pathStorage, $fileBon);
                    $saveBPA = Bon::create([
                        'type_bon_id' => 2,
                        'proforma_id' => $proformaId,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'path' => $pathStorage,
                        'file_bon' => $fileBon,
                        'bon_ref' => $refBPA
                    ]);
                    if ($saveBPA) {
                        $findProforma = Proforma::where('id', $proformaId )->update(['status_bon' => 1]);
                        return redirect()->route('bons.index')->with('success-bon', 'Le bon a été crée avec succès.');   
                    } else {
                        return route()->back();
                    }
            }
            // if ($request->type_bon == "BPA") {
            //     $refBPA = 'BPA'.'-'.$refDate.'-'.$hour;
            //     dd($refBPA);
            //     $renameDoc = $refBPA.'.'.$getExtension;
            //     $saveDoc = $refBPA.'.'.$getExtension;
            //     $pathStorage = $clientName .'/'.'BPA'.'/';
            //     $fileDoc->move($pathStorage, $renameDoc);
            //     $saveBPA = Bon::create([
            //         'type_bon_id' => 2,
            //         'proforma_id' => $proformaId,
            //         'created_at' => Carbon::now(),
            //         'updated_at' => Carbon::now(),
            //         'path' => $pathStorage,
            //         'ref_bon' => $renameDoc
            //     ]);
            //     if ($saveBPA) {
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
