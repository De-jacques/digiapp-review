<!DOCTYPE html>
<html lang="fr">

<head>
</head>


<style>
    .pagenum:before {
        content: counter(page);
    }
</style>


<body>

    <header>
        <img src="{{ public_path('proforma/entete.png') }}" alt="">
    </header>

    <footer>
        <img class="d-felx" src="{{ public_path('proforma/fond.png') }}">
        {{-- <div class="mb-1">
            <span class="pagenum"></span>
            {{$totalPages}}
        </div> --}}

        <img src="{{ public_path('proforma/pied.png') }}" alt="">
    </footer>

    <main>
        <div class="">
            <h1 class="text-center">BON DE RECEPTION</h1>

            <div class="informations">
                <div class="text-right text-capitalize mb-3">
                    <b>Date:</b>
                    {{ $date }}
                </div>
                <div class="mt-2 text-left">

                    <b>
                        N° :
                        {{ $entree['ref_entree'] }}
                    </b>
                    <br>
                    <span style="margin-top:15px">
                        Ref_commande :
                        {{ $entree['num_facture'] }}
                    </span>
                    <br>
                    <span style="margin-top:15px">
                        Ref_BL :
                        {{ $entree['num_facture'] }}
                    </span>

                </div>
                <div class="mt-3 text-right">
                    <span class="fw-bold text-uppercase">
                        {{ $fournisseur->name }}
                    </span>
                    @if (isset($fournisseur->city, $fournisseur->country))
                    <br>
                    <span class="text-capitalize">
                        {{ $fournisseur->city }} ,{{$fournisseur->country }}
                    </span>
                    @endif
                    @if (isset($fournisseur->email))
                    <br>
                    <span class="text-capitalize">
                        {{ $fournisseur->email }}
                    </span>
                    @endif
                    @if (isset($fournisseur->contact))
                    <br>
                    <span class="text-capitalize">
                        {{ $fournisseur->contact }}
                    </span>
                    @endif

                </div>
                <div class=" mt-3 mb-3">
                    <span class="fw-bold text-uppercase">
                        {{ $entrepot->name }}
                    </span>
                    @if (isset($entrepot->localisation))
                    <br>
                    <span class="text-capitalize">
                        {{ $entrepot->localisation }}
                    </span>
                    @endif
                    @if (isset($entrepot->contact))
                    <br>
                    <span class="text-capitalize">
                        {{ $entrepot->contact }}
                    </span>
                    @endif
                </div>

            </div>
            <div class="tm_table tm_style1">
                <div class="tm_border">
                    <div class="tm_table_responsive">
                        <table id="table" page-break-inside: auto;>

                            <tbody>
                                <tr class="bg-blue text-white" id="entete">
                                    <td class="tm_width_2  text-center">
                                        Ref
                                    </td>
                                    <td class="tm_width_3  text-center">
                                        Désignation
                                    </td>
                                    <td class="tm_width_2  text-center">
                                        Qté. Commandée
                                    </td>
                                    <td class="tm_width_2  text-center">
                                        Qté. Livrée
                                    </td>
                                    <td class="tm_width_2  text-center">
                                        Qté. Restante
                                        </th>
                                    <td class="tm_width_1  text-center">
                                        Observation
                                        </th>
                                </tr>
                                @foreach ($entreeIterms as $item)
                                <tr>
                                    <td class="tm_width_2">
                                        <b>
                                            {{ $item->refProduit($item->produit_id) }}
                                        </b>
                                    </td>
                                    <td class="tm_width_3">
                                        <b>
                                            {{ $item->getProduit($item->produit_id)->designation }}
                                        </b>
                                    </td>
                                    <td class="tm_width_2 text-center">
                                        @php
                                        $quantity = $item->qte_cmd;

                                        if (strlen($quantity) === 1) {
                                        $quantity = '0' . $quantity;
                                        }
                                        @endphp

                                        {{ $quantity }}
                                    </td>
                                    <td class="tm_width_2 text-center">
                                        {{ number_format($item->qte_livre, 0, ',', ' ') }}
                                    </td>
                                    <td class="tm_width_2 text-center">
                                        {{ number_format($item->reste, 0, ',', ' ') }}
                                    </td>
                                    <td class="tm_width_1 text-center">
                                        {{ $item->observation }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <!-- Optional: Add footer content here if needed -->
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>

            <div class="oneSection text-center">
                <div class="mt-5 tm_type1 tm_box_3 container" >
                    <div class="content row col-md-12" style="display: flex;justify-content: flex-right;" left=50%>
                        <div class="section col-md-4" style="">
                            <div class="mt-2">
                                <b class="tm_primary_color mb-5">{{$poste}} </b>
                                <br>
                                @if (isset($sign))
                                <img class="mt-3" src="{{ public_path('storage/'.$sign) }}" alt="" width="220px">
                                @else
                                <img class="mt-3" src="{{ public_path('proforma/assets/img/sign.png') }}" alt="">

                                @endif
                                <img class="cachet" src="{{ public_path('proforma/cachet.png') }}" alt="">

                                <p class="fw-bold tm_m0 tm_f16 tm_primary_color text-capitalize">
                                    {{ $name }}
                                    {{ $prenom }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div style="page-break-after: always;"></div>

            <div class="serial-number-list">
                <h2 class="text-uppercase">Numéros de série</h2>

                <div class="tm_table tm_style1">
                    <div class="tm_border">
                        <div class="tm_table_responsive">
                            <table id="table" page-break-inside: auto;>

                                <tbody>
                                    <tr class="bg-blue text-white" id="entete">
                                        <td class="tm_width_6  text-center">
                                            Désignation
                                        </td>
                                        <td class="tm_width_6  text-center">
                                            Numéro de série
                                        </td>
                                    </tr>
                                    @foreach ($serialNumbers as $sn)
                                    @foreach ($sn['serialNumbers'] as $serial)
                                    <tr>
                                        <td class="tm_width_6">
                                            <b>
                                                {{ $sn['designation'] }}
                                            </b>
                                        </td>
                                        <td class="tm_width_6 text-center">
                                            {{ $serial['serial_number'] }}
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <!-- Optional: Add footer content here if needed -->
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </main>
</body>

<style>
    @page {
        margin: 160px 25px;
        /* font-family: 'Courier New', Courier, monospace; */

        font-family: 'Times New Roman', Times, serif;
        /* font-family: "Tango"; */
    }

    header {
        top: -180px;
        position: fixed;
        left: 0px;
        right: 0px;
        text-align: center;
    }

    footer {
        bottom: -150px;
        position: fixed;
        left: 0px;
        right: 0px;
        text-align: center;
    }

    thead {
        /* display: table-header-group; */
        /* display: inline-block; */
    }

    /* thead:before, thead:after { display: none; } t */

    .bg-blue {
        background-color: #2F3383;
    }

    .container {
        page-break-inside: avoid;
        position: relative;
        top: 0;
        left: 0;

    }

    .oneSection {
        margin-left:175px;
        display: flex;
        justify-content: flex-end;
        page-break-inside: avoid;

    }

    .bloc {
        page-break-inside: avoid;
        position: absolute;
        top: 0;
        left: 0;
        /* page-break-inside: avoid; */

    }

    .section {
        /* page-break-inside: avoid; */
        position: absolute;
        top: 0;
        right: 0;
    }

    .bg-red {
        background-color: #BD1622;
    }

    .text-white {
        color: white;
    }

    img {
        max-width: 750px;
    }

    main {
        margin-top: 0px;
        margin-bottom: 70px;
    }

    .row {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        display: flex;
        flex-wrap: wrap;
        margin-top: calc(-1 * var(--bs-gutter-y));
        margin-right: calc(-0.5 * var(--bs-gutter-x));
        margin-left: calc(-0.5 * var(--bs-gutter-x));
    }

    .text-center {
        text-align: center !important;
    }

    .d-flex {
        display: flex !important;
    }

    .flex-row-reverse {
        flex-direction: row-reverse !important;
    }

    .text-capitalize {
        text-transform: capitalize !important;
    }

    .text-uppercase {
        text-transform: uppercase !important;
    }

    .text-lowercase {
        text-transform: lowercase !important;
    }

    .mb-5 {
        margin-bottom: 3rem !important;
    }

    .col-md-12 {
        flex: 0 0 auto;
        width: 100%;
    }

    .col-md-5 {
        flex: 0 0 auto;
        width: 42%;
    }

    .col-md-2 {
        flex: 0 0 auto;
        width: 17%;
    }

    .fw-bold {
        font-weight: 600 !important;
    }

    .justify-content-between {
        justify-content: space-between !important;
    }

    .px-5 {
        padding-right: 3rem !important;
        padding-left: 3rem !important;
    }

    .py-3 {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    .border {
        border: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;
    }

    .rounded-3 {
        border-radius: var(--bs-border-radius-lg) !important;
    }

    .justify-content-end {
        display: grid;
        justify-content: end !important;
    }

    .text-right {
        text-align: right
    }

    .proforma {
        margin-top: 1em;
    }

    .mt-0 {
        margin-top: 0 !important;
    }

    .mt-3 {
        margin-top: 1rem !important;
    }

    .mt-5 {
        margin-top: 3rem !important;
    }

    table {
        width: 100%;
        caption-side: bottom;
        border-collapse: collapse;
    }

    th {
        text-align: left;
    }

    td {
        border-top: 1px solid #dbdfea;
    }

    td {
        padding: 5px 10px;
        line-height: 1em;
    }

    th {
        padding: 5px 10px;
        line-height: 1em;
    }

    dl {
        margin-bottom: 25px;
    }

    dl dt {
        font-weight: 600;
    }

    b,
    strong {
        font-weight: bold;
    }

    pre {
        color: #666;
        border: 1px solid #dbdfea;
        font-size: 18px;
        padding: 25px;
        border-radius: 5px;
    }

    kbd {
        font-size: 100%;
        background-color: #666;
        border-radius: 5px;
    }

    a:hover {
        color: #007aff;
    }

    ul {
        padding-left: 15px;
    }

    .tm_f10 {
        font-size: 10px;
    }

    .tm_f11 {
        font-size: 11px;
    }

    .tm_f12 {
        font-size: 12px;
    }

    .tm_f13 {
        font-size: 13px;
    }

    .tm_f14 {
        font-size: 14px;
    }

    .tm_f15 {
        font-size: 15px;
    }

    .tm_f16 {
        font-size: 16px;
    }

    .tm_f17 {
        font-size: 17px;
    }

    .tm_f18 {
        font-size: 18px;
    }

    .tm_f19 {
        font-size: 19px;
    }

    .tm_f20 {
        font-size: 20px;
    }

    .tm_f21 {
        font-size: 21px;
    }

    .tm_f22 {
        font-size: 22px;
    }

    .tm_f23 {
        font-size: 23px;
    }

    .tm_f24 {
        font-size: 24px;
    }

    .tm_f25 {
        font-size: 25px;
    }

    .tm_f26 {
        font-size: 26px;
    }

    .tm_f27 {
        font-size: 27px;
    }

    .tm_f28 {
        font-size: 28px;
    }

    .tm_f29 {
        font-size: 29px;
    }

    .tm_f30 {
        font-size: 30px;
    }

    .tm_f40 {
        font-size: 40px;
    }

    .tm_f50 {
        font-size: 50px;
    }

    .tm_light {
        font-weight: 300;
    }

    .tm_normal {
        font-weight: 400;
    }

    .tm_medium {
        font-weight: 500;
    }

    .tm_semi_bold {
        font-weight: 600;
    }

    .tm_bold {
        font-weight: 700;
    }

    .tm_m0 {
        margin: 0px;
    }

    .tm_mb0 {
        margin-bottom: 0px;
    }

    .tm_mb1 {
        margin-bottom: 1px;
    }

    .tm_mb2 {
        margin-bottom: 2px;
    }

    .tm_mb3 {
        margin-bottom: 3px;
    }

    .tm_mb4 {
        margin-bottom: 4px;
    }

    .tm_mb5 {
        margin-bottom: 5px;
    }

    .tm_mb6 {
        margin-bottom: 6px;
    }

    .tm_mb7 {
        margin-bottom: 7px;
    }

    .tm_mb8 {
        margin-bottom: 8px;
    }

    .tm_mb9 {
        margin-bottom: 9px;
    }

    .tm_mb10 {
        margin-bottom: 10px;
    }

    .tm_mb11 {
        margin-bottom: 11px;
    }

    .tm_mb12 {
        margin-bottom: 12px;
    }

    .tm_mb13 {
        margin-bottom: 13px;
    }

    .tm_mb14 {
        margin-bottom: 14px;
    }

    .tm_mb15 {
        margin-bottom: 15px;
    }

    .tm_mb16 {
        margin-bottom: 16px;
    }

    .tm_mb17 {
        margin-bottom: 17px;
    }

    .tm_mb18 {
        margin-bottom: 18px;
    }

    .tm_mb19 {
        margin-bottom: 19px;
    }

    .tm_mb20 {
        margin-bottom: 20px;
    }

    .tm_mb21 {
        margin-bottom: 21px;
    }

    .tm_mb22 {
        margin-bottom: 22px;
    }

    .tm_mb23 {
        margin-bottom: 23px;
    }

    .tm_mb24 {
        margin-bottom: 24px;
    }

    .tm_mb25 {
        margin-bottom: 25px;
    }

    .tm_mb26 {
        margin-bottom: 26px;
    }

    .tm_mb27 {
        margin-bottom: 27px;
    }

    .tm_mb28 {
        margin-bottom: 28px;
    }

    .tm_mb29 {
        margin-bottom: 29px;
    }

    .tm_mb30 {
        margin-bottom: 30px;
    }

    .tm_mb40 {
        margin-bottom: 40px;
    }

    .tm_pt25 {
        padding-top: 25px;
    }

    .tm_pt0 {
        padding-top: 0;
    }

    .tm_radius_6_0_0_6 {
        border-radius: 6px 0 0 6px;
    }

    .tm_radius_0_6_6_0 {
        border-radius: 0 6px 6px 0;
    }

    .tm_radius_0 {
        border-radius: 0 !important;
    }

    .tm_width_1 {
        width: 8.33333333%;
    }

    .tm_width_2 {
        width: 16.66666667%;
    }

    .tm_width_3 {
        width: 25%;
    }

    .tm_width_4 {
        width: 33.33333333%;
    }

    .tm_width_5 {
        width: 41.66666667%;
    }

    .tm_width_6 {
        width: 50%;
    }

    .tm_width_7 {
        width: 58.33333333%;
    }

    .tm_width_8 {
        width: 66.66666667%;
    }

    .tm_width_9 {
        width: 75%;
    }

    .tm_width_10 {
        width: 83.33333333%;
    }

    .tm_width_11 {
        width: 91.66666667%;
    }

    .tm_width_12 {
        width: 100%;
    }

    .tm_border {
        border: 1px solid #dbdfea;
    }

    .tm_border_bottom {
        border-bottom: 1px solid #dbdfea;
    }

    .tm_border_top {
        border-top: 1px solid #dbdfea;
    }

    .tm_border_left {
        border-left: 1px solid #dbdfea;
    }

    .tm_border_right {
        border-right: 1px solid #dbdfea;
    }

    .tm_round_border {
        border: 1px solid #dbdfea;
        overflow: hidden;
        border-radius: 6px;
    }

    .tm_accent_color,
    .tm_accent_color_hover:hover {
        color: #007aff;
    }

    .tm_accent_bg,
    .tm_accent_bg_hover:hover {
        background-color: #007aff;
    }

    .tm_accent_bg_10 {
        background-color: rgba(0, 122, 255, 0.1);
    }

    .tm_accent_bg_20 {
        background-color: rgba(0, 122, 255, 0.15);
    }

    .tm_green_bg {
        background-color: #34c759;
    }

    .tm_green_bg_15 {
        background-color: rgba(52, 199, 89, 0.1);
    }

    .tm_primary_bg,
    .tm_primary_bg_hover:hover {
        background-color: #111;
    }

    .tm_primary_bg_2 {
        background-color: #000036;
    }

    .tm_danger_color {
        color: red;
    }

    .tm_primary_color {
        color: #111;
    }

    .tm_secondary_color {
        color: #666;
    }

    .tm_ternary_color {
        /* color: #b5b5b5; */
        color: whitesmoke;
    }

    .tm_white_color {
        color: #fff;
    }

    .tm_white_color_60 {
        color: rgba(255, 255, 255, 0.6);
    }

    .tm_gray_bg {
        background: #f5f6fa;
    }

    .tm_ternary_bg {
        background-color: #b5b5b5;
    }

    .tm_accent_10_bg {
        background-color: rgba(0, 122, 255, 0.1);
    }

    .tm_accent_border {
        border-color: #007aff;
    }

    .tm_accent_border_10 {
        border-color: rgba(0, 122, 255, 0.1);
    }

    .tm_accent_border_30 {
        border-color: rgba(0, 122, 255, 0.3);
    }

    .tm_accent_border_40 {
        border-color: rgba(0, 122, 255, 0.4);
    }

    .tm_accent_border_50 {
        border-color: rgba(0, 122, 255, 0.5);
    }

    .tm_primary_border {
        border-color: #111;
    }

    .tm_gray_border {
        border-color: #f5f6fa;
    }

    .tm_primary_border_2 {
        border-color: #000036;
    }

    .tm_secondary_border {
        border-color: #666;
    }

    .tm_ternary_border {
        border-color: #b5b5b5;
    }

    .tm_border_color {
        border-color: #dbdfea;
    }

    .tm_border_1 {
        border-style: solid;
        border-width: 1px;
    }

    .tm_body_lineheight {
        line-height: 1.5em;
    }

    .tm_invoice_in {
        position: relative;
        z-index: 100;
    }

    .tm_container {
        max-width: 880px;
        padding: 0px 0px;
        margin-left: auto;
        margin-right: auto;
        position: relative;
    }

    .tm_text_center {
        text-align: center;
    }

    .tm_text_uppercase {
        text-transform: uppercase;
    }

    .tm_text_right {
        text-align: right;
    }

    .tm_align_center {
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .tm_border_bottom_0 {
        border-bottom: 0;
    }

    .tm_border_top_0 {
        border-top: 0;
    }

    .tm_table_baseline {
        vertical-align: baseline;
    }

    .tm_border_none {
        border: none !important;
    }

    .tm_flex {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .tm_justify_between {
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    .tm__align_center {
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .tm_border_left_none {
        border-left-width: 0;
    }

    .tm_border_right_none {
        border-right-width: 0;
    }

    .tm_table_responsive {
        overflow-x: auto;
    }

    .tm_table_responsive>table {
        min-width: 600px;
    }

    .tm_50_col>* {
        width: 50%;
        -webkit-box-flex: 0;
        -ms-flex: none;
        flex: none;
    }

    .tm_no_border {
        border: none !important;
    }

    .tm_grid_row {
        display: -ms-grid;
        display: grid;
        grid-gap: 10px 20px;
        list-style: none;
        padding: 0;
    }



    .tm_col_3 {
        -ms-grid-columns: (1fr)[3];
        grid-template-columns: repeat(3, 1fr);
    }

    .tm_col_4 {
        -ms-grid-columns: (1fr)[4];
        grid-template-columns: repeat(4, 1fr);
    }

    .tm_max_w_150 {
        max-width: 150px;
    }

    .tm_left_auto {
        margin-left: auto;
    }

    hr {
        background: #dbdfea;
        height: 1px;
        border: none;
        margin: 0;
    }

    .tm_invoice {
        background: #fff;
        border-radius: 10px;
        padding: 50px;
    }

    .tm_invoice_footer {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .tm_invoice_footer table {
        margin-top: -1px;
    }

    .tm_invoice_footer .tm_left_footer {
        width: 58%;
        padding: 10px 15px;
        -webkit-box-flex: 0;
        -ms-flex: none;
        flex: none;
    }

    .tm_invoice_footer .tm_right_footer {
        width: 42%;
    }

    .tm_note {
        margin-top: 30px;
        font-style: italic;
    }

    .tm_font_style_normal {
        font-style: normal;
    }

    .tm_sign img {
        max-height: 45px;
    }

    .tm_coffee_shop_img {
        position: absolute;
        height: 200px;
        opacity: 0.04;
        top: 40px;
        left: 50%;
        -webkit-transform: translateX(-50%);
        transform: translateX(-50%);
    }

    .tm_coffee_shop_img img {
        max-height: 100%;
    }

    .tm_invoice.tm_style1 .tm_invoice_right {
        -webkit-box-flex: 0;
        -ms-flex: none;
        flex: none;
        width: 60%;
    }

    .tm_invoice.tm_style1 .tm_invoice_table {
        grid-gap: 1px;
    }

    .tm_invoice.tm_style1 .tm_invoice_table>* {
        border: 1px solid #dbdfea;
        margin: -1px;
        padding: 8px 15px 10px;
    }

    .tm_invoice.tm_style1 .tm_invoice_head {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    .tm_invoice.tm_style1 .tm_invoice_head .tm_invoice_right div {
        line-height: 1em;
    }

    .tm_invoice.tm_style1 .tm_invoice_info {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    .tm_invoice.tm_style1 .tm_invoice_info_2 {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        border-top: 1px solid #dbdfea;
        border-bottom: 1px solid #dbdfea;
        padding: 11px 0;
    }

    .tm_invoice.tm_style1 .tm_invoice_seperator {
        min-height: 18px;
        border-radius: 1.6em;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
        margin-right: 20px;
    }

    .tm_invoice.tm_style1 .tm_invoice_info_list {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .tm_invoice.tm_style1 .tm_invoice_info_list>*:not(:last-child) {
        margin-right: 20px;
    }

    .tm_invoice.tm_style1 .tm_logo img {
        max-height: 50px;
    }

    .tm_invoice.tm_style1 .tm_logo.tm_size1 img {
        max-height: 60px;
    }

    .tm_invoice.tm_style1 .tm_logo.tm_size2 img {
        max-height: 70px;
    }

    .tm_invoice.tm_style1 .tm_grand_total {
        padding: 8px 15px;
    }

    .tm_invoice.tm_style1 .tm_box_3 {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .tm_invoice.tm_style1 .tm_box_3>* {
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
    }

    .tm_invoice.tm_style1 .tm_box_3 ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .tm_invoice.tm_style1 .tm_box_3 ul li {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .tm_invoice.tm_style1 .tm_box_3 ul li:not(:last-child) {
        margin-bottom: 5px;
    }

    .tm_invoice.tm_style1 .tm_box_3 ul span {
        -webkit-box-flex: 0;
        -ms-flex: none;
        flex: none;
    }

    .tm_invoice.tm_style1 .tm_box_3 ul span:first-child {
        margin-right: 5px;
    }

    .tm_invoice.tm_style1 .tm_box_3 ul span:last-child {
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
    }

    .tm_invoice.tm_style2 .tm_invoice_head {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        border-bottom: 1px solid #dbdfea;
        padding-bottom: 15px;
        position: relative;
    }

    .tm_invoice.tm_style2 .tm_invoice_left {
        width: 30%;
        -webkit-box-flex: 0;
        -ms-flex: none;
        flex: none;
    }

    .tm_invoice.tm_style2 .tm_invoice_right {
        width: 70%;
        -webkit-box-flex: 0;
        -ms-flex: none;
        flex: none;
    }

    .tm_invoice.tm_style2 .tm_invoice_info {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .tm_invoice.tm_style2 .tm_invoice_info_left {
        width: 30%;
        -webkit-box-flex: 0;
        -ms-flex: none;
        flex: none;
    }

    .tm_invoice.tm_style2 .tm_invoice_info_right {
        width: 70%;
        -webkit-box-flex: 0;
        -ms-flex: none;
        flex: none;
    }

    .tm_invoice.tm_style2 .tm_logo img {
        max-height: 60px;
    }

    .tm_invoice.tm_style2 .tm_invoice_title {
        line-height: 0.8em;
    }

    .tm_invoice.tm_style2 .tm_invoice_info_in {
        padding: 12px 20px;
        border-radius: 10px;
    }

    .tm_invoice.tm_style2 .tm_card_note {
        display: inline-block;
        padding: 6px 15px;
        border-radius: 6px;
        margin-bottom: 10px;
        margin-top: 5px;
    }

    .tm_invoice.tm_style2 .tm_invoice_footer .tm_left_footer {
        padding-left: 0;
    }

    .tm_invoice.tm_style1.tm_type1 {
        padding: 0px 50px 30px;
        position: relative;
        overflow: hidden;
        border-radius: 0;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_invoice_head {
        height: 110px;
        position: relative;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_shape_bg {
        position: absolute;
        height: 100%;
        width: 70%;
        -webkit-transform: skewX(35deg);
        transform: skewX(35deg);
        top: 0px;
        right: -100px;
        overflow: hidden;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_shape_bg img {
        height: 100%;
        width: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        -webkit-transform: skewX(-35deg) translateX(-45px);
        transform: skewX(-35deg) translateX(-45px);
    }

    .tm_invoice.tm_style1.tm_type1 .tm_logo img {
        max-height: 70px;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_invoice_seperator {
        margin-right: 0;
        border-radius: 0;
        -webkit-transform: skewX(35deg);
        transform: skewX(35deg);
        position: absolute;
        height: 100%;
        width: 57.5%;
        right: -60px;
        overflow: hidden;
        border: none;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_invoice_seperator img {
        height: 100%;
        width: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        -webkit-transform: skewX(-35deg);
        transform: skewX(-35deg);
        -webkit-transform: skewX(-35deg) translateX(-10px);
        transform: skewX(-35deg) translateX(-10px);
    }

    .tm_invoice.tm_style1.tm_type1 .tm_invoice_info {
        position: relative;
        padding: 4px 0;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_card_note,
    .tm_invoice.tm_style1.tm_type1 .tm_invoice_info_list {
        position: relative;
        z-index: 1;
    }

    @media (min-width: 500px) {
        .tm_invoice.tm_style1.tm_type2 {
            position: relative;
            overflow: hidden;
            border-radius: 0;
        }

        .tm_invoice.tm_style1.tm_type2 td {
            padding-top: 12px;
            padding-bottom: 12px;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_pt0 {
            padding-top: 0;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_bars {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            position: absolute;
            top: 0px;
            left: 50%;
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%);
            overflow: hidden;
            padding: 0 15px;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_bars span {
            height: 100px;
            width: 5px;
            display: block;
            margin: -15px 20px 0;
            -webkit-transform: rotate(-40deg);
            transform: rotate(-40deg);
        }

        .tm_invoice.tm_style1.tm_type2 .tm_bars.tm_type1 {
            top: initial;
            bottom: 0;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_bars.tm_type1 span {
            margin: 0 20px 0;
            position: relative;
            bottom: -15px;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape {
            height: 230px;
            width: 250px;
            position: absolute;
            top: 0;
            right: 0;
            overflow: hidden;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape .tm_shape_in {
            position: absolute;
            height: 350px;
            width: 350px;
            -webkit-transform: rotate(40deg);
            transform: rotate(40deg);
            top: -199px;
            left: 67px;
            overflow: hidden;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape.tm_type1 {
            top: initial;
            bottom: 0;
            right: initial;
            left: 0;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape.tm_type1 .tm_shape_in {
            top: 135px;
            left: -153px;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape_2 {
            height: 120px;
            width: 120px;
            border: 5px solid currentColor;
            padding: 20px;
            position: absolute;
            bottom: -30px;
            right: 77px;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape_2 .tm_shape_2_in {
            height: 100%;
            width: 100%;
            border: 20px solid currentColor;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape_2.tm_type1 {
            left: -76px;
            right: initial;
            bottom: 245px;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape_2.tm_type1 .tm_shape_2_in {
            border-width: 6px;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_invoice_right {
            width: 40%;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_logo img {
            max-height: 65px;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_invoice_footer {
            margin-bottom: 120px;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_right_footer {
            position: relative;
            padding: 6px 0;
        }


        .tm_invoice.tm_style1.tm_type2 .tm_left_footer {
            padding: 30px 15px;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape_3 {
            position: absolute;
            top: 0;
            left: -40px;
            height: 100%;
            width: calc(100% + 150px);
            -webkit-transform: skewX(35deg);
            transform: skewX(35deg);
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape_4 {
            position: absolute;
            bottom: 200px;
            left: 0;
            height: 200px;
            width: 200px;
        }

        .tm_invoice.tm_style1.tm_type3 {
            position: relative;
            overflow: hidden;
            border-radius: 0;
        }

        .tm_invoice.tm_style1.tm_type3 .tm_shape_1 {
            position: absolute;
            top: -1px;
            left: 0;
        }

        .tm_invoice.tm_style1.tm_type3 .tm_shape_2 {
            position: absolute;
            bottom: 0;
            left: 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        .tm_invoice.tm_style1.tm_type3 .tm_logo img {
            max-height: 60px;
        }

        .tm_invoice.tm_style1.tm_type3 .tm_invoice_head.tm_mb20 {
            margin-bottom: 65px;
        }

        .tm_invoice.tm_style1.tm_type3 .tm_invoice_info_list {
            position: relative;
            padding: 10px 0 10px 40px;
        }

        .tm_invoice.tm_style1.tm_type3 .tm_invoice_info_list_bg {
            position: absolute;
            height: 100%;
            width: calc(100% + 100px);
            top: 0;
            left: 0;
            border-radius: 20px 0 0 0px;
            -webkit-transform: skewX(-35deg);
            transform: skewX(-35deg);
        }

        .tm_invoice.tm_style2.tm_type1 {
            padding-top: 0;
            padding-bottom: 0;
            border-width: 40px 0 0;
            border-style: solid;
            position: relative;
            overflow: hidden;
        }

        .tm_invoice.tm_style2.tm_type1.tm_small_border {
            border-width: 7px 0 0;
        }

        .tm_invoice.tm_style2.tm_type1 .tm_shape_bg {
            position: absolute;
            height: 100%;
            width: 42%;
            -webkit-transform: skewX(-35deg);
            transform: skewX(-35deg);
            top: 0px;
            left: -100px;
        }

        .tm_invoice.tm_style2.tm_type1 .tm_invoice_head {
            padding-top: 15px;
            border-bottom: none;
        }


        .tm_invoice.tm_style2.tm_type1 .tm_bottom_invoice {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            padding: 15px 50px 20px;
            border-top: 1px solid #dbdfea;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin: 30px -50px 0;
        }

        .tm_invoice_content {
            position: relative;
            z-index: 10;
        }

        .tm_invoice_wrap {
            position: relative;
        }

        .tm_note_list li:not(:last-child) {
            margin-bottom: 5px;
        }

        .tm_list.tm_style1 {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .tm_list.tm_style1 svg {
            width: 16px;
            height: initial;
        }

        .tm_list.tm_style1 .tm_list_icon {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            position: absolute;
            left: 0;
            top: 3px;
        }

        .tm_list.tm_style1 li {
            padding-left: 25px;
            position: relative;
        }

        .tm_list.tm_style1 li:not(:last-child) {
            margin-bottom: 5px;
        }

        .tm_list.tm_style1.tm_text_right li {
            padding-left: 0;
            padding-right: 25px;
        }

        .tm_list.tm_style1.tm_text_right .tm_list_icon {
            left: initial;
            right: 0;
        }

        .tm_section_heading {
            border-width: 0 0 1px 0;
            border-style: solid;
        }

        .tm_section_heading>span {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 7px 7px 0 0;
        }

        .tm_section_heading .tm_curve_35 {
            margin-left: 12px;
            margin-right: 0;
        }

        .tm_section_heading .tm_curve_35 span {
            display: inline-block;
        }

        .tm_padd_15_20 {
            padding: 15px 20px;
        }

        .tm_padd_8_20 {
            padding: 8px 20px;
        }

        .tm_padd_20 {
            padding: 20px;
        }

        .tm_padd_15 {
            padding: 15px;
        }

        .tm_padd_10 {
            padding: 10px;
        }

        .tm_padd_5 {
            padding: 5px;
        }

        .tm_curve_35 {
            -webkit-transform: skewX(-35deg);
            transform: skewX(-35deg);
            padding: 12px 20px 12px 30px;
            margin-left: 22px;
            margin-right: 22px;
        }

        .tm_curve_35>* {
            -webkit-transform: skewX(35deg);
            transform: skewX(35deg);
        }

        .tm_dark_invoice_body {
            background-color: #18191a;
        }

        .tm_dark_invoice {
            background: #252526;
            color: rgba(255, 255, 255, 0.65);
        }

        .tm_dark_invoice .tm_primary_color {
            color: rgba(255, 255, 255, 0.9);
        }

        .tm_dark_invoice .tm_secondary_color {
            color: rgba(255, 255, 255, 0.65);
        }

        .tm_dark_invoice .tm_ternary_color {
            /* color: rgba(255, 255, 255, 0.4); */
            color: whitesmoke;
        }

        .tm_dark_invoice .tm_gray_bg {
            background: rgba(255, 255, 255, 0.08);
        }

        .tm_dark_invoice .tm_border_color,
        .tm_dark_invoice .tm_round_border,
        .tm_dark_invoice td,
        .tm_dark_invoice th,
        .tm_dark_invoice .tm_border_top,
        .tm_dark_invoice .tm_border_bottom {
            border-color: rgba(255, 255, 255, 0.1);
        }

        .tm_dark_invoice+.tm_invoice_btns {
            background: #252526;
            border-color: #252526;
        }

        @media (min-width: 1000px) {
            .tm_invoice_btns {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -ms-flex-direction: column;
                flex-direction: column;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;
                margin-top: 0px;
                margin-left: 20px;
                position: absolute;
                left: 100%;
                top: 0;
                -webkit-box-shadow: -2px 0 24px -2px rgba(43, 55, 72, 0.05);
                box-shadow: -2px 0 24px -2px rgba(43, 55, 72, 0.05);
                border: 3px solid #fff;
                border-radius: 6px;
                background-color: #fff;
            }

            .tm_invoice_btn {
                display: -webkit-inline-box;
                display: -ms-inline-flexbox;
                display: inline-flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                border: none;
                font-weight: 600;
                cursor: pointer;
                padding: 0;
                background-color: transparent;
                position: relative;
            }

            .tm_invoice_btn svg {
                width: 24px;
            }

            .tm_invoice_btn .tm_btn_icon {
                padding: 0;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                height: 42px;
                width: 42px;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;
            }

            .tm_invoice_btn .tm_btn_text {
                position: absolute;
                left: 100%;
                background-color: #111;
                color: #fff;
                padding: 3px 12px;
                display: inline-block;
                margin-left: 10px;
                border-radius: 5px;
                top: 50%;
                -webkit-transform: translateY(-50%);
                transform: translateY(-50%);
                font-weight: 500;
                min-height: 28px;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                opacity: 0;
                visibility: hidden;
            }

            .tm_invoice_btn .tm_btn_text:before {
                content: '';
                height: 10px;
                width: 10px;
                position: absolute;
                background-color: #111;
                -webkit-transform: rotate(45deg);
                transform: rotate(45deg);
                left: -3px;
                top: 50%;
                margin-top: -6px;
                border-radius: 2px;
            }

            .tm_invoice_btn:hover .tm_btn_text {
                opacity: 1;
                visibility: visible;
            }

            .tm_invoice_btn:not(:last-child) {
                margin-bottom: 3px;
            }

            .tm_invoice_btn.tm_color1 {
                background-color: rgba(0, 122, 255, 0.1);
                color: #007aff;
                border-radius: 5px 5px 0 0;
            }

        }

        .tm_invoice_btn.tm_color2 {
            background-color: rgba(52, 199, 89, 0.1);
            color: #34c759;
            border-radius: 0 0 5px 5px;
        }

    }


    @media (max-width: 999px) {
        .tm_invoice_btns {
            display: -webkit-inline-box;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            margin-top: 0px;
            margin-top: 20px;
            -webkit-box-shadow: -2px 0 24px -2px rgba(43, 55, 72, 0.05);
            box-shadow: -2px 0 24px -2px rgba(43, 55, 72, 0.05);
            border: 3px solid #fff;
            border-radius: 6px;
            background-color: #fff;
            position: relative;
            left: 50%;
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%);
        }

        .tm_invoice_btn {
            display: -webkit-inline-box;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            border: none;
            font-weight: 600;
            cursor: pointer;
            padding: 0;
            background-color: transparent;
            position: relative;
            border-radius: 5px;
            padding: 6px 15px;
        }

        .tm_invoice_btn svg {
            width: 24px;
        }

        .tm_invoice_btn .tm_btn_icon {
            padding: 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            margin-right: 8px;
        }

        .tm_invoice_btn:not(:last-child) {
            margin-right: 3px;
        }

        .tm_invoice_btn.tm_color1 {
            background-color: rgba(0, 122, 255, 0.1);
            color: #007aff;
        }

    }

    .tm_invoice_btn.tm_color2 {
        background-color: rgba(52, 199, 89, 0.1);
        color: #34c759;
    }


    @media (max-width: 767px) {
        .tm_col_4 {
            -ms-grid-columns: (1fr)[1];
            grid-template-columns: repeat(1, 1fr);
        }

    }

    .tm_m0_md {
        margin: 0;
    }

    .tm_mb10_md {
        margin-bottom: 10px;
    }

    .tm_mb15_md {
        margin-bottom: 15px;
    }

    .tm_mb20_md {
        margin-bottom: 20px;
    }

    .tm_mobile_hide {
        display: none;
    }

    .tm_invoice {
        padding: 30px 20px;
    }

    .tm_invoice .tm_right_footer {
        width: 100%;
    }

    .tm_invoice_footer {
        -webkit-box-orient: vertical;
        -webkit-box-direction: reverse;
        -ms-flex-direction: column-reverse;
        flex-direction: column-reverse;
    }

    .tm_invoice_footer .tm_left_footer {
        width: 100%;
        border-top: 1px solid #dbdfea;
        margin-top: -1px;
        padding: 15px 0;
    }

    .tm_invoice.tm_style2 .tm_card_note {
        margin-top: 0;
    }

    .tm_note.tm_text_center {
        text-align: left;
    }

    .tm_note.tm_text_center p br {
        display: none;
    }

    .tm_invoice_footer.tm_type1 {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
    }

    .tm_invoice.tm_style2 .tm_invoice_head {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
    }

    .tm_invoice.tm_style2 .tm_invoice_head>* {
        width: 100%;
    }

    .tm_invoice.tm_style2 .tm_invoice_head .tm_invoice_left {
        margin-bottom: 15px;
    }

    .tm_invoice.tm_style2 .tm_invoice_head .tm_text_right {
        text-align: left;
    }

    .tm_invoice.tm_style2 .tm_invoice_info {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
    }

    .tm_invoice.tm_style2 .tm_invoice_info>* {
        width: 100%;
    }

    .tm_invoice.tm_style1.tm_type1 {
        padding: 30px 20px;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_invoice_head {
        height: initial;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_invoice_info {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-align: start;
        -ms-flex-align: start;
        align-items: flex-start;
        padding-left: 15px;
        padding-right: 15px;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_invoice_seperator {
        width: 100%;
        -webkit-transform: initial;
        transform: initial;
        right: 0;
        top: 0;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_logo img {
        max-height: 60px;
    }

    .tm_invoice.tm_style2.tm_type1 {
        border-width: 20px 0 0;
    }

    .tm_invoice.tm_style2.tm_type1 .tm_shape_bg {
        width: 250px;
        height: 80px;
    }

    .tm_invoice.tm_style2.tm_type1 .tm_invoice_head .tm_text_center {
        text-align: left;
    }

    .tm_invoice.tm_style2.tm_type1 .tm_logo {
        top: -8px;
        margin-bottom: 15px;
    }

    .tm_invoice.tm_style2 .tm_invoice_info_in {
        padding: 12px 15px;
    }

    .tm_border_none_md {
        border: none !important;
    }

    .tm_border_left_none_md {
        border-left-width: 0;
    }

    .tm_border_right_none_md {
        border-right-width: 0;
    }

    .tm_padd_left_15_md {
        padding-left: 15px !important;
    }

    .tm_invoice.tm_style2 .tm_logo img {
        max-height: 50px;
    }

    .tm_curve_35 {
        -webkit-transform: skewX(0deg);
        transform: skewX(0deg);
        margin-left: 0;
        margin-right: 0;
    }

    .tm_curve_35>* {
        -webkit-transform: inherit;
        transform: inherit;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_invoice_seperator,
    .tm_invoice.tm_style1.tm_type1 .tm_invoice_seperator img {
        -webkit-transform: initial;
        transform: initial;
    }

    .tm_section_heading .tm_curve_35 {
        margin-left: 0;
    }

    .tm_shape_2.tm_type1 {
        display: none;
    }


    @media (max-width: 500px) {
        .tm_border_none_sm {
            border: none !important;
        }

        .tm_flex_column_sm {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .tm_align_start_sm {
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
        }

        .tm_m0_sm {
            margin-bottom: 0;
        }

        .tm_invoice.tm_style1 .tm_logo {
            margin-bottom: 10px;
        }

        .tm_invoice.tm_style1 .tm_invoice_head {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .tm_invoice.tm_style1 .tm_invoice_head .tm_invoice_left,
        .tm_invoice.tm_style1 .tm_invoice_head .tm_invoice_right {
            width: 100%;
        }

        .tm_invoice.tm_style1 .tm_invoice_head .tm_invoice_right {
            text-align: left;
        }

        .tm_list.tm_style2 li {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .tm_list.tm_style2 li>* {
            padding: 5px 20px;
        }

        .tm_col_2,
        .tm_col_3 {
            -ms-grid-columns: (1fr)[1];
            grid-template-columns: repeat(1, 1fr);
        }

    }

    .tm_table.tm_style1.tm_type1 {
        padding: 0px 20px;
    }

    .tm_box2_wrap {
        -ms-grid-columns: (1fr)[1];
        grid-template-columns: repeat(1, 1fr);
    }

    .tm_box.tm_style1.tm_type1 {
        max-width: 100%;
        width: 100%;
    }

    .tm_invoice.tm_style1 .tm_invoice_left {
        max-width: 100%;
    }

    .tm_f50 {
        font-size: 30px;
    }

    .tm_invoice.tm_style1 .tm_invoice_info {
        -webkit-box-orient: vertical;
        -webkit-box-direction: reverse;
        -ms-flex-direction: column-reverse;
        flex-direction: column-reverse;
    }

    .tm_invoice.tm_style1 .tm_invoice_seperator {
        -webkit-box-flex: 0;
        -ms-flex: none;
        flex: none;
        width: 100%;
        margin-right: 0;
        min-height: 5px;
    }

    .tm_invoice.tm_style1 .tm_invoice_info_list {
        width: 100%;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }

    .tm_invoice.tm_style1 .tm_invoice_seperator+.tm_invoice_info_list {
        margin-bottom: 5px;
    }

    .tm_f30 {
        font-size: 22px;
    }

    .tm_invoice.tm_style1 .tm_box_3 {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
    }

    .tm_invoice.tm_style1 .tm_box_3 span br {
        display: none;
    }

    .tm_invoice.tm_style1 .tm_box_3>*:not(:last-child) {
        margin-bottom: 15px;
    }

    .tm_invoice.tm_style1 .tm_box_3 ul li {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
    }

    .tm_invoice.tm_style1 .tm_box_3 ul li:not(:last-child) {
        margin-bottom: 5px;
    }
    }


    @media print {
        .tm_gray_bg {
            background-color: #f5f6fa !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_ternary_bg {
            background-color: #b5b5b5 !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_primary_bg {
            background-color: #111 !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_secondary_bg {
            background-color: #666 !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_accent_bg {
            background-color: #007aff;
            -webkit-print-color-adjust: exact;
        }

        .tm_accent_bg_10 {
            background-color: rgba(0, 122, 255, 0.1) !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_accent_bg_20 {
            background-color: rgba(0, 122, 255, 0.15) !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_white_color {
            color: #fff !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_accent_color {
            color: #007aff !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_ternary_color {
            /* color: #b5b5b5 !important; */
            color: whitesmoke !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_hide_print {
            display: none !important;
        }

        .tm_dark_invoice .tm_gray_bg {
            background-color: #111 !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_dark_invoice {
            background: #111 !important;
            color: rgba(255, 255, 255, 0.65) !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_dark_invoice .tm_gray_bg {
            background: rgba(255, 255, 255, 0.05) !important;
            -webkit-print-color-adjust: exact;
        }

        hr {
            background: #dbdfea !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_col_4,
        .tm_col_4.tm_col_2_md {
            -ms-grid-columns: (1fr)[4];
            grid-template-columns: repeat(4, 1fr);
        }

    }

    .tm_mb1 {
        margin-bottom: 1px;
    }

    .tm_mb2 {
        margin-bottom: 2px;
    }

    .tm_mb3 {
        margin-bottom: 3px;
    }

    .tm_mb4 {
        margin-bottom: 4px;
    }

    .tm_mb5 {
        margin-bottom: 5px;
    }

    .tm_mb6 {
        margin-bottom: 6px;
    }

    .tm_mb7 {
        margin-bottom: 7px;
    }

    .tm_mb8 {
        margin-bottom: 8px;
    }

    .tm_mb9 {
        margin-bottom: 9px;
    }

    .tm_mb10 {
        margin-bottom: 10px;
    }

    .tm_mb11 {
        margin-bottom: 11px;
    }

    .tm_mb12 {
        margin-bottom: 12px;
    }

    .tm_mb13 {
        margin-bottom: 13px;
    }

    .tm_mb14 {
        margin-bottom: 14px;
    }

    .tm_mb15 {
        margin-bottom: 15px;
    }

    .tm_mb16 {
        margin-bottom: 16px;
    }

    .tm_mb17 {
        margin-bottom: 17px;
    }

    .tm_mb18 {
        margin-bottom: 18px;
    }

    .tm_mb19 {
        margin-bottom: 19px;
    }

    .tm_mb20 {
        margin-bottom: 20px;
    }

    .tm_mb21 {
        margin-bottom: 21px;
    }

    .tm_mb22 {
        margin-bottom: 22px;
    }

    .tm_mb23 {
        margin-bottom: 23px;
    }

    .tm_mb24 {
        margin-bottom: 24px;
    }

    .tm_mb25 {
        margin-bottom: 25px;
    }

    .tm_mb26 {
        margin-bottom: 26px;
    }

    .tm_mb27 {
        margin-bottom: 27px;
    }

    .tm_mb28 {
        margin-bottom: 28px;
    }

    .tm_mb29 {
        margin-bottom: 29px;
    }

    .tm_mb30 {
        margin-bottom: 30px;
    }

    .tm_mb40 {
        margin-bottom: 40px;
    }

    .tm_mobile_hide {
        display: block;
    }

    .tm_invoice {
        padding: 10px;
    }

    .tm_invoice .tm_right_footer {
        width: 42%;
    }

    .tm_invoice_footer {
        -webkit-box-orient: initial;
        -webkit-box-direction: initial;
        -ms-flex-direction: initial;
        flex-direction: initial;
    }

    .tm_invoice_footer .tm_left_footer {
        width: 58%;
        padding: 10px 15px;
        -webkit-box-flex: 0;
        -ms-flex: none;
        flex: none;
        border-top: none;
        margin-top: 0px;
    }

    .tm_invoice.tm_style2 .tm_card_note {
        margin-top: 5px;
    }

    .tm_note.tm_text_center {
        text-align: center;
    }

    .tm_note.tm_text_center p br {
        display: initial;
    }

    .tm_invoice_footer.tm_type1 {
        -webkit-box-orient: initial;
        -webkit-box-direction: initial;
        -ms-flex-direction: initial;
        flex-direction: initial;
    }

    .tm_invoice.tm_style2 .tm_invoice_head {
        -webkit-box-orient: initial;
        -webkit-box-direction: initial;
        -ms-flex-direction: initial;
        flex-direction: initial;
    }

    .tm_invoice.tm_style2 .tm_invoice_head>.tm_invoice_left {
        width: 30%;
    }

    .tm_invoice.tm_style2 .tm_invoice_head>.tm_invoice_right {
        width: 70%;
    }

    .tm_invoice.tm_style2 .tm_invoice_head .tm_invoice_left {
        margin-bottom: initial;
    }

    .tm_invoice.tm_style2 .tm_invoice_head .tm_text_right {
        text-align: right;
    }

    .tm_invoice.tm_style2 .tm_invoice_info {
        -webkit-box-orient: initial;
        -webkit-box-direction: initial;
        -ms-flex-direction: initial;
        flex-direction: initial;
    }

    .tm_invoice.tm_style2 .tm_invoice_info>.tm_invoice_info_left {
        width: 30%;
    }

    .tm_invoice.tm_style2 .tm_invoice_info>.tm_invoice_info_right {
        width: 70%;
    }

    .tm_invoice.tm_style1.tm_type1 {
        padding: 0px 20px 30px;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_invoice_head {
        height: 110px;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_invoice_info {
        padding: 4px 0;
        -webkit-box-orient: initial;
        -webkit-box-direction: initial;
        -ms-flex-direction: initial;
        flex-direction: initial;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_invoice_seperator {
        top: initial;
        margin-right: 0;
        border-radius: 0;
        -webkit-transform: skewX(35deg);
        transform: skewX(35deg);
        position: absolute;
        height: 100%;
        width: 57.5%;
        right: -60px;
        overflow: hidden;
        border: none;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_logo img {
        max-height: 70px;
    }

    .tm_invoice.tm_style2.tm_type1 {
        border-width: 20px 0 0;
    }

    .tm_invoice.tm_style2.tm_type1 .tm_shape_bg {
        height: 100%;
        width: 42%;
    }

    .tm_invoice.tm_style2.tm_type1 .tm_invoice_head .tm_text_center {
        text-align: center;
    }

    .tm_invoice.tm_style2.tm_type1 .tm_logo {
        top: initial;
        margin-bottom: initial;
    }

    .tm_invoice.tm_style2 .tm_invoice_info_in {
        padding: 12px 20px;
    }

    .tm_invoice.tm_style2 .tm_logo img {
        max-height: 60px;
    }

    .tm_curve_35 {
        -webkit-transform: skewX(-35deg);
        transform: skewX(-35deg);
        margin-left: 22px;
        margin-right: 22px;
    }

    .tm_curve_35>* {
        -webkit-transform: skewX(35deg);
        transform: skewX(35deg);
    }

    .tm_invoice.tm_style1.tm_type1 .tm_invoice_seperator {
        -webkit-transform: skewX(35deg);
        transform: skewX(35deg);
    }

    .tm_invoice.tm_style1.tm_type1 .tm_invoice_seperator img {
        -webkit-transform: skewX(-35deg) translateX(-45px);
        transform: skewX(-35deg) translateX(-45px);
    }

    .tm_section_heading .tm_curve_35 {
        margin-left: 12px;
    }

    .tm_round_border {
        border-top-width: 2px;
    }

    .tm_border_left_none_md {
        border-left-width: 1px;
    }

    .tm_border_right_none_md {
        border-right-width: 1px;
    }

    .tm_note {
        margin-top: 30px;
    }

    .tm_pagebreak {
        page-break-before: always;
    }


    #table {
        /* margin-top: 100px; */
        background-image: url(public_path().'proforma/assets/img/fond.png');
        background-repeat: no-repeat;
        background-size: contain;
        opacity: 1;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    .mr-5 {
        margin-right: 80px;
    }

    .row {
        margin-right: -15px;
        margin-left: -15px;
    }

    .none {
        font-weight: normal;
    }

    .description {
        margin-top: 5px;
        line-height: 0.4px;
    }

    /* Position absolue pour l'image du cachet */
    img.cachet {
        position: absolute;
        width: 150px;
        top: 2%;
        transform: translateX(-50%);
        z-index: 1;
        
    }
  

</style>

</html>