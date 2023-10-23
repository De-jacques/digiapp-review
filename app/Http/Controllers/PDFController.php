<?php

namespace App\Http\Controllers;

use PDF;

use Illuminate\Http\Request;

class PDFController extends Controller
{
    // function to display preview
    public function preview()
    {
        return view('pages.back.admin.proformas.graph');
    }

    // function to generate PDF
    public function generatePDF()
    {
        $pdf = PDF::loadView('pages.back.admin.proformas.graph');
        $pdf->setOptions([
            'margin-top' => 0,
            'margin-bottom' => 0,
            'margin-right' => 5,
            'margin-left' => 5,
            'page-size' => 'a4',
            'orientation' => 'portrait',
            'footer-html' => '<h1>bonjour</h1>',
            
            // 'footer-html' => view('pages.back.admin.proformas.docs._footer'),
          ]);
       return $pdf->stream('fichier.pdf');
    }

}
