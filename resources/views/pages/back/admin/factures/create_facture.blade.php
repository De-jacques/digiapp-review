{{-- @extends('pages.back.admin.master', ['titre' => 'FACTURES']) --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="{{ public_path('assets/css/dompdf.css') }}">
    {{-- <link rel="stylesheet" href="{{ public_path('assets/fonts/tangosans/tangosans.css') }}"> --}}
    {{-- <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"> --}}
</head>
<body>

    <header style="margin-bottom:130px">
        {{-- <img src="{{ public_path('proforma/entete.svg') }}" alt=""> --}}
    </header>
    <footer>
        <img style="margin-bottom: 200px; z-index: auto" class="d-felx" src="{{ public_path('proforma/fond.svg') }}">
       
        {{-- <img src="{{ public_path('proforma/footer.jpg') }}" alt=""> --}}
    </footer>
    <main style="z-index: 1">
        <div class="">
            <div class="text-uppercase text-center">
                <h1>FACTURE PROFORMA</h1>
            </div>

            <div class="informations">
                {{-- <div class="text-right text-capitalize">
                    {{ $issue_date }}
                </div>
                <div class="mt-2 text-left">
                    <span class="gras">
                        N° : {{ $proforma['ref_proforma'] }}
                    </span>
                </div>
                <div class="mt-2 text-right">
                    <span class="fw-bold text-uppercase">
                        {{ $customer }}
                    </span>
                    @if (isset($customer_addresse))
                        <br>
                        <span class="text-capitalize">
                            {{ $customer_addresse }}
                        </span>
                    @endif

                    @if (isset($customer_number))
                        <br>
                        <span>{{ $customer_number }}</span>
                    @endif
                </div>
                <div class=" mt-3 mb-3">
                    <span style="text-decoration : underline;">
                        Objet
                    </span>
                    :
                    <span class="fw-bold text-uppercase">
                        {!! $proforma['note'] !!}
                    </span>
                </div> --}}
            </div>
        </div>

        <table id="main_table">
            <tr class="table_head">
                <th>Ref</th>
                <th class="text-center">Désignation</th>
                <th class="text-center">Quantité</th>
                <th>PU HT</th>
                <th>Total HT</th>
            </tr>
            {{-- @foreach ($proformaItems as $item)
                <tr class="">
                    <td class="ref">
                        @isset($item->getProduit($item->product_id)->ref)
                            {{ $item->getProduit($item->product_id)->ref }}
                        @endisset
                    </td>
                    <td class="designation">
                        <span class="gras">
                            {{ $item->getProduit($item->product_id)->designation }}
                        </span>
                        @isset($item->getProduit($item->product_id)->description)
                            <br>
                            <span class="design">
                                {!! $item->getProduit($item->product_id)->description !!}
                            </span>
                        @endisset
                    </td>
                    <td class="qte">
                        @php
                            $quantity = $item->quantity;
                            
                            if (strlen($quantity) === 1) {
                                $quantity = '0' . $quantity;
                            }
                        @endphp

                        {{ $quantity }}
                    </td>
                    <td class="price">
                        {{ number_format($item->price, 0, ',', ' ') }}
                    </td>
                    <td class="total">
                        {{ number_format($item->total, 0, ',', ' ') }}
                    </td>
                </tr>
            @endforeach --}}

        </table>
        <div class="tm_table tm_style1">
            <div class="tm_invoice_footer tm_mb30 tm_m0_md mt-5 ">
                <div class="col-md-12">
                    {{-- <table id="price_table">
                        <thead>
                            <tr>
                                <th>
                                    Total HT
                                </th>
                                <th class="none">
                                    Remise
                                    <span>({{ $proforma['discount'] }}%)</span>
                                </th>
                                <th class="none">
                                    Net Commercial
                                </th>
                                <th class="none">
                                    TVA
                                    <span>( {{ $taxe_tva }} % )</span>
                                </th>
                                @isset($retenu)
                                    <th class="none">
                                        AIRSI
                                        <span>( 5 % )</span>
                                    </th>
                                @endisset
                                <th>
                                    @if ($taxe_tva == 0)
                                        Net à payer
                                    @endif
                                    @if ($taxe_tva == 18)
                                        Total TTC
                                    @endif
                                </th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <tr>
                                <td class="fw-bold">
                                    {{ number_format($proforma['total_ht'], 0, ',', ' ') }}

                                </td>

                                <td class="none">
                                    {{ number_format($proforma['discount_amount'], 0, ',', ' ') }}

                                </td>

                                <td class="none">
                                    {{ number_format($proforma['commercial_net'], 0, ',', ' ') }}

                                </td>

                                <td class="none">
                                    {{ number_format($proforma['tva_amount'], 0, ',', ' ') }}

                                </td>
                                @isset($retenu)
                                    <td class="none">
                                        {{ number_format($proforma['retenu'], 0, ',', ' ') }}

                                    </td>
                                @endisset

                                <td class="fw-bold">
                                    {{ number_format($proforma['total'], 0, ',', ' ') }}

                                </td>
                            </tr>
                        </tbody>
                    </table> --}}
                </div>
            </div>
        </div>
        <div class="mt-3  tm_primary_color">
            Arrêtée la présente proforma à la somme de
            <span class="fw-bold">
                {{-- {{ $numberToWords }} --}}

            </span>
            francs CFA
        </div>
        <div class="oneSection">
            <div class="mt-5 tm_type1 tm_box_3 container">
                <div class="content row col-md-12" style="display: flex;justify-content: flex-right; margin-left:5px">
                    <div class="col-md-5" style="">
                        <div class="mb-3">
                            <b>
                                Condition de paiement
                            </b>
                            <br>

                            {{-- @if ($type == 'comptant' || $type == 'unique')
                                @foreach ($fractions as $fct)
                                    - {{ $fct['norme'] . ' % ' . $fct['description'] }}@if ($fct['date'] != 0)
                                        (dans {{ $fct['date'] . ' jours' }})
                                    @endif
                                    <br>
                                @endforeach
                            @else
                                @foreach ($fractions as $fct)
                                    - {{ $fct['norme'] . ' % ' . $fct['description'] }}
                                    @if ($fct['date'] != 0)
                                        (dans {{ $fct['date'] . ' jours' }})
                                    @endif
                                    <br>
                                @endforeach
                            @endif --}}

                        </div>
                        <div class="mt-2">
                            <b>
                                Livraison:
                            </b>
                            {{-- {{ $fractions[0]['livraison'] }} jours ouvrables --}}
                        </div>
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="section col-md-5" style="">
                        <div class="mb-3">
                            <b>Moyen de reglement</b>
                            <br>
                            Règlement possible par cash, chèque et virement bancaire au droit de DIGICORP.
                        </div>
                        <div class="text-center mr-5 ">
                            <b class="tm_primary_color mb-1">
                                {{-- {{ $author->poste }} --}}
                            </b>
                            <br>
                            <div id="sign_section">
                                    <img id="cachet" width="60px" src="{{ public_path('proforma/cachet.svg') }}" alt=""> 
                            </div>

                            <p class="author fw-bold tm_f16 tm_primary_color text-capitalize">
                                {{-- {{ $author->name }}
                                {{ $author->first_name }} --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5" style="margin-top:20px">
                <b>Garantie</b>
                <br>
                Nos produits sont garantie sur une période de 12 mois.
            </div>
        </div>

    </main>
</body>
</html>
