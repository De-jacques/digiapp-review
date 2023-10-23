@extends('pages.back.admin.master', ['titre' => 'GESTION DES PROFORMAS'])

@section('admin-content')
    <style>
        .button-float {
            position: fixed;
            top: 50%;
            right: 0px;
            border: none;
            padding: 10px;
            transform: translate(0, -50%);
        }

        .inline {
            display: inline-block;
            vertical-align: middle;
        }
    </style>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
            <div class="tables">
                <div class="card">
                    <div class="p-3">
                        <a class="btn btn-outline-danger" href="{{ route('proformas.index') }}">
                            <i class="fa fa-arrow-left"></i>
                            Proformas
                        </a>
                    </div>
                    <section id="basic-vertical-layouts">
                        <div class="card-body">
                            <form id="form" class="form form-vertical" method="POST"
                                action="{{ route('proformas.store') }}">
                                @csrf
                                <div class="row match-height">
                                    <div class="col-md-3 col-12">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="type_client">Client (
                                                            <span class="text-danger"> *</span>
                                                            ) </label>
                                                        <div class="form-group">
                                                            <select class="form-select-client" name="client"
                                                                id="client">
                                                                <option value="">Selectionner un client</option>

                                                            </select>
                                                            <input type="hidden" id="group_client">
                                                            <span class="error-message" id="client-error-message">Veuillez
                                                                sélectionner un client.</span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="issueDate">Date </label>
                                        <input type="date" class="form-control" id="issueDate" name="issueDate"
                                            value="{{ Carbon\Carbon::today()->toDateString() }}">
                                        <div class="text-danger">
                                            @error('issueDate')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-12">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group with-title mb-3">
                                                        <label>Objet (
                                                            <span class="text-danger"> *</span>
                                                            )</label>
                                                        <textarea id="objet"
                                                            class="form-control 
                                                        @error('objet') is-invalid @enderror"
                                                            id="exampleFormControlTextarea1" rows="1" name="objet" value="{{ old('objet') }}"></textarea>
                                                        @error('objet')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row match-height mt-3">


                                </div>
                                <div id="toastContainer" class="toast-container position-fixed top-0 end-0 p-3"></div>

                                <table class="table table-responsive" id="productTable">
                                    <thead>
                                        <tr class="">
                                            <th style="width: 20%">PRODUIT</th>
                                            <th style="">P.U HT</th>
                                            <th style="">QUANTITE</th>
                                            <th style="">TOTAL</th>
                                            <th style=""></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $arrayNumber = 0;
                for ($x = 1; $x < 2; $x++) {
                    ?>
                                        <tr id="row<?php echo $x; ?>" class="product" clazz="<?php echo $arrayNumber; ?>">
                                            <td style="" class="col-md-5">
                                                <div class="form-group">
                                                    <select class="form-control form-select<?php echo $x; ?>" required
                                                        name="productName[]" id="productName<?php echo $x; ?>"
                                                        onchange="getProductData(<?php echo $x; ?>)">
                                                        <option value="">Produit</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td style="" class="col-md-3">
                                                <div class="form-group" style="">
                                                    <input type="text" name="ratev[]" id="ratev<?php echo $x; ?>"
                                                        autocomplete="off" class="form-control" disabled
                                                        onchange="getTotal(<?php echo $x; ?>)"
                                                        onkeyup="getTotal(<?php echo $x; ?>)" required />

                                                    <input type="hidden" name="ratevValue[]"
                                                        id="ratevValue<?php echo $x; ?>" autocomplete="off"
                                                        onchange="getTotal(<?php echo $x; ?>)"
                                                        onkeyup="getTotal(<?php echo $x; ?>)" class="form-control"
                                                        required />

                                                    <input type="hidden" name="ratevValuea[]"
                                                        id="ratevValuea<?php echo $x; ?>" autocomplete="off"
                                                        onchange="getTotal(<?php echo $x; ?>)"
                                                        onkeyup="getTotal(<?php echo $x; ?>)" class="form-control"
                                                        required />
                                                </div>
                                            </td>
                                            <td class="col-md-1">
                                                <div class="form-group" style="">
                                                    <input type="number" name="quantity[]"
                                                        id="quantity<?php echo $x; ?>"
                                                        onchange="getTotal(<?php echo $x; ?>)"
                                                        onkeyup="getTotal(<?php echo $x; ?>)" autocomplete="off"
                                                        class="form-control" min="1" required />
                                                </div>
                                            </td>

                                            <td style="" class="col-md-3">
                                                <div class="form-group" style="">
                                                    <input type="text" name="total[]" required
                                                        id="total<?php echo $x; ?>" autocomplete="off"
                                                        class="form-control" disabled />

                                                    <input hidden type="text" name="totalValue[]"
                                                        id="totalValue<?php echo $x; ?>" required autocomplete="off"
                                                        class="form-control" />
                                                </div>
                                            </td>
                                            <td>

                                                <button class="btn btn-default removeProductRowBtn" type="button"
                                                    id="removeProductRowBtn"
                                                    onclick="removeProductRow(<?php echo $x; ?>)"><i
                                                        class="bi bi-trash-fill" style="color: red; font-size: 1.5em"></i>
                                                </button>

                                            </td>
                                        </tr>

                                        <?php
                $arrayNumber++;
            } // /for
            ?>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-primary " id="addRowBtn"
                                    onclick="AjouterUneLigne()">
                                    <i class="fa fa-plus"></i> Ajouter une ligne
                                </button>

                                <hr>
                                <div class="container">

                                    <div class="row match-height">
                                        <div class="col-md-2 col-12">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group-lg">
                                                            <label for="subTotal">TOTAL HT</label>
                                                            <input type="text" id="subTotal" class="form-control"
                                                                name="subTotal" disabled>

                                                            <input hidden type="text" id="subTotalValue"
                                                                name="subTotalValue" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="total_amount">REMISE</label>
                                                            <div class="input-group">
                                                                <input type="text" aria-label="%"
                                                                    class="form-control col-4" id="discount"
                                                                    name="discount" placeholder="%" {{--
                                                                onkeyup="calculateDiscount()" --}}
                                                                    onchange="calculateDiscount()" readonly>
                                                                <input type="text" aria-label="Montant"
                                                                    id="discount_amount" name="discount_amount"
                                                                    class="form-control col-8" placeholder="Montant"
                                                                    onkeyup="discountValue()" onchange="discountValue()"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">

                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group-lg">
                                                            <label for="total_amount ">NET COMMERCIAL</label>
                                                            <input type="text" id="total_amount" class="form-control"
                                                                name="total_amount" disabled>

                                                            <input type="text" hidden id="total_amountValue"
                                                                class="form-control" name="total_amountValue">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-2 col-12" id="taxe_div">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="total_amount">TAXE</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend" id="taxeStatut">
                                                                    <span class="input-group-text"
                                                                        id="tva">18%</span>
                                                                    {{-- <input type="text" id="tva"
                                                                    class="input-group-text col-md-3" /> --}}
                                                                </div>
                                                                <input type="text" id="taxe_amount"
                                                                    class="form-control" name="taxe_amount" disabled>

                                                                <input type="text" hidden id="taxe_amountValue"
                                                                    class="form-control " name="taxe_amountValue">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12" id="retenu_div">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="retenu">AIRSI</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend" id="retenu">
                                                                    <span class="input-group-text"
                                                                        id="retenu">5%</span>
                                                                </div>
                                                                <input type="text" id="retenu_amount"
                                                                    class="form-control" name="retenu_amount" disabled>

                                                                <input type="text" hidden id="retenu_amountValue"
                                                                    class="form-control" name="retenu_amountValue">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">

                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group-lg">
                                                            <label id="totalName" for="total_amount">TOTAL TTC </label>
                                                            <input type="text" id="total_ttc_amount"
                                                                class="form-control" name="total_ttc_amount" disabled>

                                                            <input type="text" hidden id="total_ttc_amountValue"
                                                                class="form-control" name="total_ttc_amountValue">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mt-5 col-md-12">
                                    <div class="d-flex justify-content-between form-group">
                                        <div class="col-md-4 col-auto">
                                            <label for="">Reglement (<span class="text-danger"> *</span>
                                                )</label>
                                            <select class="form-control form-select-echeance" onchange="echeance()"
                                                id="echeancement" name="type_reglement">
                                                <option selected disabled>Veuillez selectionner le mode de règlement
                                                </option>
                                                <option value="comptant">Au Comptant</option>
                                                <option value="unique">À Échéance Unique</option>
                                                <option value="fractionne">À Échéance Fractionnée</option>

                                            </select>
                                        </div>
                                        <div class="col-md-3 col-auto">
                                            <div class="input-group mt-4">
                                                <span class="input-group-text">Livraison (<span class="text-danger">
                                                        *</span>
                                                    )</span>
                                                <input type="number" name="livraison" class="form-control"
                                                    placeholder="Nombre de jours" value="{{ old('livraison') }}"
                                                    @error('livraison') is-invalid @enderror id="livraison">
                                            </div>
                                            @error('livraison')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>


                                        <div class="col-md-4 mt-4 col-auto">
                                            <label for="">Moyen de paiement:</label>

                                            {{-- <br> --}}
                                            <label for="">Cheque </label>
                                            /
                                            <label for=""> Virement</label>
                                        </div>
                                    </div>

                                    {{-- Ici travailler sur les ajouts de fractione --}}

                                    {{-- REGLEMENT À ECHANCE UNIQUE --}}
                                    <div class="col-md-6 mt-3 input-group text-center row" id="unique">
                                        <p class="h6 mt-1 mb-3">Veuillez renseigner
                                            <span class="text-success">
                                                la description et la date de l'échéance,
                                            </span>
                                            le taux est bloqué à 100%.
                                            <br>
                                            <br>
                                            <em>
                                                <u>NB:</u>
                                                La date d'échéance correspond au nombre de jour auquel le client compte
                                                regler la facture après livraison.</em>
                                        </p>
                                        <div class="row">
                                            <div class="col-md-1">
                                                Taux
                                                <input type="text" placeholder="100%" class="form-control"
                                                    id="nombre_jour_unique" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                Description (<span class="text-danger"> *</span>
                                                )
                                                <input type="text" placeholder="Description" class="form-control"
                                                    name="uniqueDescription" id="uniqueDescription">
                                            </div>
                                            <div class="col-md-1">
                                                {{-- <span class="input-group-text">Date de paiement</span> --}}
                                                Date (<span class="text-danger"> *</span>
                                                )
                                                <input type="text" placeholder="0" class="form-control"
                                                    name="dateUnique" id="dateUnique">

                                            </div>

                                        </div>

                                    </div>


                                    {{-- REGLEMENT AU COMPTANT --}}

                                    <div class="mt-3 input-group row text-center" id="comptant">
                                        <p class="h6 mt-1 mb-3">
                                            <span class="text-danger">
                                                Veuillez renseigner uniquement la description,
                                            </span>
                                            le taux et le jour sont bloqués respectivement à 100% et 0.
                                        </p>
                                        <div class="row">
                                            <div class="col-md-1">
                                                Taux
                                                <input type="text" placeholder="100%" class="form-control"
                                                    id="niveauComptant" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                Description
                                                (
                                                <span class="text-danger"> *</span>
                                                )
                                                <input type="text" placeholder="Veuillez insérer juste la description"
                                                    class="form-control" name="comptantDescription"
                                                    id="comptantDescription">
                                            </div>
                                            <div class="col-md-1">
                                                Date
                                                <input type="text" placeholder="0" class="form-control"
                                                    id="dateComptant" readonly>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- REGLEMENT À ECHANCE FRACTIONNÉE --}}

                                    <div class="col-md-8 mt-3" id="fractionne">
                                        <div class="container">
                                            <!-- Conteneur pour les lignes de fractionnement -->
                                            <div class="row lines-container col-md-10"></div>
                                            <!-- Bouton d'ajout -->
                                            <a class="btn btn-success rounded-pill mt-3 add-btn col-md-2">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>


                                </div>
                                {{-- MODAL START --}}
                                <div class="col-12 d-flex justify-content-end mt-5" style="">

                                    <a id="enregistrerProformaBtn" class="btn btn-success me-1 rounded-pill"
                                        style="padding-left: 5%; padding-right: 5%;" name="sender"
                                        data-bs-toggle="modal" data-bs-target="#spinnerModal">Enregistrer</a>
                                    <!-- Modal Spinner -->
                                    <div class="modal fade" id="spinnerModal" tabindex="-1"
                                        aria-labelledby="spinnerModalLabel" aria-hidden="true" id="modalNote">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <div class="spinner-border" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                    </div>
                                                    <div id="errorNotification" class="mt-3" style="display: none;">
                                                        <span class="text-danger">
                                                            <i class="fas fa-times-circle me-1"></i> Champ manquant : Objet
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-dark"
                                                        data-bs-dismiss="modal">Retourner</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- MODAL END --}}
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
        var customer_genre = "";
        var tva = "";
        var tva_status = "";
        var regime = "";
        var regime_status = "";
        var regimeValue = "";
        var produitsListe = [];
        var retenu = 0;
        $('#unique').hide();
        $('#fractionne').hide();
        $('#comptant').hide();

        // Déclaration de la variable produitsRencontres en dehors de la fonction success
        var produitsRencontres = [];

        // var produitsRencontres = new Set();
        $(function() {
            $("form").submit(function() {
                $(this).find(".labelFormControl").each(function() {
                    $(this).val($(this).attr("id") + ":" + $(this).val());
                });
            });

            loadProducts();
            loadClients();

            // format montant_facture
            $('#discount_amount').on('keyup change', function() {
                var val = $(this).val();
                val = val.replace(/\D/g, '');
                val = val.replace(/\D/g, 0);
                val = val.replace(/\B(?=(\d{3})+(?!\d))/g, " ");
                $(this).val(val);
            });

            // on change client
            $('#client').on('change', function() {
                var client_id = $(this).val();

                // ajax method to get client data
                $.ajax({
                    url: "{{ route('getCustomer', ['id' => 'id']) }}".replace('id',
                        client_id),
                    type: "GET",
                    success: function(data) {
                        $('#group_client').val(data.group);
                        customer_genre = data.type;
                        taxe_status = data.taxe_tva;
                        regime = data.regime;
                        //Si le status tva est égale à non c'est à dire que notre client est exonéré de la tva
                        if (taxe_status == "Non") {
                            tva = 0;
                            const totalName = document.getElementById('totalName');
                            totalName.textContent = 'NET À PAYER';
                            // retenu = 0;
                            if (regime == "RNI" || regime == "RSI") {
                                retenu = 0;
                            }

                        } else if (taxe_status == "Oui") {
                            tva = 18;
                            const tva_status = document.getElementById('tva');
                            tva_status.value = tva;

                            if (regime == "TEE" || regime == "RME") {
                                retenu = 5;
                            }
                            if (regime == "RNI" || regime == "RSI") {
                                retenu = 0;
                            }
                        }
                        const span = document.getElementById('tva');
                        span.textContent = tva + " %";
                        const regime_status = document.getElementById('retenu');
                        regime_status.value = retenu;
                        const regimeData = document.getElementById('retenu');
                        regimeData.textContent = retenu + " %";
                    }
                });

            });
            calculateDiscount();
        });

        function format(row = null) {
            if (row) {
                var val = $("#ratevValue" + row).val();
                val = val.replace(/\D/g, '');
                val = val.replace(/\D/g, 0);
                val = val.replace(/\B(?=(\d{3})+(?!\d))/g, " ");
                $("#ratevValue" + row).val(val);
            }
        }

        function formatPrice(data) {
            var val = data.toString();
            val = val.replace(/\D/g, '');
            val = val.replace(/\D/g, 0);
            val = val.replace(/\B(?=(\d{3})+(?!\d))/g, " ");
            return val;
        }

        function loadProducts() {
            // foreach $produits
            @foreach ($produits as $produit)
                // add produit to the select
                $('#productName1').append('<option value="{{ $produit->id }}">{{ $produit->designation }}</option>');
            @endforeach

            var choices = new Choices('#productName1', {
                searchEnabled: true,
                itemSelectText: '',
            });
        }

        function loadClients() {
            // foreach $customers
            @foreach ($clients as $produit)
                // add customer to the select
                $('#client').append('<option value="{{ $produit->id }}">{{ $produit->nom }}</option>');
            @endforeach

            var choices = new Choices('.form-select-client', {
                searchEnabled: true,
                itemSelectText: '',
            });
            var choices = new Choices('.form-select-echeance', {
                searchEnabled: true,
                itemSelectText: '',
            });
        }

        function removeProductRow(row = null) {
            if (row) {
                var nomProduit = produitsRencontres[row - 1];
                produitsRencontres.splice(row - 1, 1);
                $("#row" + row).remove();
                // Supprimer un produit de la liste produitsRencontres
                subAmount();
                // console.log(produitsRencontres);
            } else {
                alert('Erreur! Veuillez rafraîchir la page !');
            }
        }

        function removeProductLabel(row = null) {
            if (row) {
                $("#productLabel" + row).remove();
                subAmount();
            } else {
                alert('Erreur! Veuillez rafraîchir la page !');
            }
        }

        function getTotal(row = null) {
            if (row) {
                if ($("#ratevValue" + row).val() == "") {
                    $("#ratevValue" + row).val(Number($("#ratevValuea" + row).val()));
                }
                var total = Number($("#ratevValuea" + row).val()) * Number($("#quantity" + row).val());
                var taxe = ((total * tva) / 100);
                var regimeValue = ((total * retenu) / 100);
                var total_ttc = total + taxe + regimeValue;
                var discount = $('#discount').val();
                total = total.toFixed(0);

                $("#total" + row).val(new Intl.NumberFormat('fr-FR').format(total));
                $("#totalValue" + row).val(total);

                $("#taxe" + row).val(new Intl.NumberFormat('fr-FR').format(taxe));
                $("#taxeValue" + row).val(taxe);

                $("#retenu" + row).val(new Intl.NumberFormat('fr-FR').format(regimeValue));
                $("#retenuValue" + row).val(regimeValue);

                $("#total_ttc" + row).val(new Intl.NumberFormat('fr-FR').format(total_ttc));
                $("#total_ttcValue" + row).val(total_ttc);

                $("#discount" + row).val(new Intl.NumberFormat('fr-FR').format(discount));

                subAmount();
            } else {
                alert("Pas d'entrée ! Veuillez rafraîchir la page !");
            }
        }

        function getProductData(row = null) {

            if (row) {
                var productId = $("#productName" + row).val();
                if (productId == "") {

                    resertFileds(row);
                    getTotal(row);

                } else {
                    $.ajax({
                        url: '{{ route('getProductData') }}',
                        type: 'post',
                        data: {
                            id: productId,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(response) {

                            if (response.designation) {
                                var nomProduit = response.designation;

                                if (produitsRencontres.includes(nomProduit)) {
                                    showErrorToast('Répétition du produit : ' + nomProduit);
                                    return false; // Sortie prématurée de la fonction success
                                } else {
                                    produitsRencontres.push(nomProduit);
                                }

                                // console.log(produitsRencontres);

                                produitsListe = produitsRencontres;
                            }
                            var group_client = $('#group_client').val();
                            $("#quantity" + row).removeAttr('max');

                            if (customer_genre == "Goov") {

                                if (response.prix_goov != null && response.prix_goov != '' && response
                                    .prix_goov != 0) {

                                    $("#ratev" + row).attr('disabled', 'true').attr('type', 'text').attr(
                                        'required',
                                        'true');
                                    $("#ratevValue" + row).attr('type', 'hidden').val('');
                                    $("#ratevValue" + row).val(response.prix_goov);
                                    $("#ratevValuea" + row).val(response.prix_goov);
                                    $("#ratev" + row).val(new Intl.NumberFormat('fr-FR').format(response
                                        .prix_goov));

                                    $("#quantity" + row).val(1).attr('readonly', false);
                                } else {
                                    $("#ratev" + row).attr('type', 'hidden').val('');
                                    $("#ratevValue" + row).val('');
                                    $("#ratevValuea" + row).attr('type', 'text').val('');
                                    $("#quantity" + row).val(1).attr('readonly', true);
                                }

                            } else {

                                if (response.prix_vente != null && response.prix_vente != '' && response
                                    .prix_vente != 0) {

                                    $("#ratev" + row).attr('disabled', 'true').attr('type', 'text').attr(
                                        'required',
                                        'true');
                                    $("#ratevValue" + row).attr('type', 'hidden').val('');
                                    $("#ratevValue" + row).val(response.prix_vente);
                                    $("#ratevValuea" + row).val(response.prix_vente);
                                    $("#ratev" + row).val(new Intl.NumberFormat('fr-FR').format(response
                                        .prix_vente));

                                    $("#quantity" + row).val(1).attr('readonly', false);
                                } else {
                                    $("#ratev" + row).attr('type', 'hidden').val('');
                                    $("#ratevValue" + row).val('');
                                    $("#ratevValuea" + row).attr('type', 'text').val('');
                                    $("#quantity" + row).val(1).attr('readonly', true);
                                }

                            }



                            $("#quantity" + row).val(1);

                            getTotal(row);

                        },
                        // /success
                        error: function(xhr, status, error) {
                            showErrorToast('Erreur AJAX : ' + error);
                        }
                    }); // /ajax function to fetch the product data
                }

            } else {
                alert("Pas d'entrée ! Veuillez rafraîchir la page !");
            }

        } // /select on product data
        function showErrorToast(message) {
            var toastContainer = $('#toastContainer');
            var toast = $('<div class="toast" role="alert" aria-live="assertive" aria-atomic="true"></div>');
            var toastHeader = $('<div class="toast-header bg-danger text-white"></div>');
            var toastBody = $('<div class="toast-body"></div>');
            toastHeader.text('Erreur');
            toastBody.text(message);
            toast.append(toastHeader);
            toast.append(toastBody);
            toastContainer.append(toast);

            toast.toast({
                delay: 3000
            });
            toast.toast('show');
        }

        function resertFileds(row = null) {
            $("#ratev" + row).val("");
            $("#ratevValue" + row).val("");
            $("#ratevValuea" + row).val("");
            $("#quantity" + row).val("");
            $("#total" + row).val("");
            $("#totalValue" + row).val("");
            $("#quantity" + row).attr("max", "0").attr("min", "0");
            $("#subTotal").val('');
            $("#subTotalValue").val("");
            $("#discount").val("");
            $("#discount_amount").val("");
            $("#total_amount").val("");
            $("#total_amountValue").val("");
            $("#retenu_amount").val("");
            $("#retenu_amountValue").val("");
            $("#taxe_amount").val("");
            $("#taxe_amountValue").val("");
            $("#total_ttc_amount").val("");
            $("#total_ttc_amountValue").val("");
        }

        function subAmount() {
            var tableProductLength = $("#productTable tbody tr.product").length;
            var totalSubAmount = 0;
            for (x = 0; x < tableProductLength; x++) {
                var tr = $("#productTable tbody tr.product")[x];
                var count = $(tr).attr('id');
                count = count.substring(3);
                totalSubAmount = Number(totalSubAmount) + Number($("#totalValue" + count).val());

            } // /for

            totalSubAmount = totalSubAmount.toFixed(0);

            // sub total
            $("#subTotal").val(new Intl.NumberFormat('fr-FR').format(totalSubAmount));
            $("#subTotalValue").val(totalSubAmount);

            // reduction remise
            calculateDiscount();

            //discountValue();

        } // /sub total amount

        function AjouterUneLigne() {
            $("#addRowBtn").button("loading");
            var tableLength = $("#productTable tbody tr.product").length;
            var tableRow;
            var arrayNumber;
            var count;
            if (tableLength > 0) {
                tableRow = $("#productTable tbody tr.product:last").attr('id');
                arrayNumber = $("#productTable tbody tr.product:last").attr('clazz');
                count = tableRow.substring(3);
                count = Number(count) + 1;
                arrayNumber = Number(arrayNumber) + 1;
            } else {
                // no table row
                count = 1;
                arrayNumber = 0;
            }

            $.ajax({
                url: '{{ route('listProduct') }}',
                type: 'get',
                dataType: 'json',
                success: function(response) {

                    $("#addRowBtn").button("reset");

                    var tr = '<tr id="row' + count + '" class="product" clazz="' + arrayNumber + '">' +
                        '<td style="">' +
                        '<div class="form-group">' +
                        '<select class="form-control choices form-select' + count + '"' +
                        'name="productName[]" id="productName' + count + '"' +
                        'onchange="getProductData(' + count + ')">' +
                        '<option value="">Selectionner un produit</option>';

                    $.each(response, function(index, value) {

                        tr += '<option value="' + value['id'] + '">' + value['designation'] +
                            '</option>';
                    });

                    tr += '</select>' +
                        '</div>' +
                        '</td>';

                    tr += '<td style="">' +
                        '<div class="form-group" style="">' +
                        '<input type="text" name="ratev[]" id="ratev' + count + '"' +
                        'autocomplete="off" class="form-control" disabled ' +
                        'onchange="getTotal(' + count + ')"' +

                        '                onkeyup="getTotal(' + count + ')" />' +
                        '            <input type="hidden" name="ratevValue[]"' +
                        '                id="ratevValue' + count + '" autocomplete="off"' +
                        'onchange="getTotal(' + count + ')"' +

                        '                onkeyup="getTotal(' + count + ')"' +
                        '                class="form-control" />' +
                        '            <input type="hidden" name="ratevValuea[]"' +
                        '                id="ratevValuea' + count + '" autocomplete="off"' +
                        'onchange="getTotal(' + count + ')"' +

                        '                onkeyup="getTotal(' + count + ')"' +
                        '                class="form-control" />' +
                        '        </div>' +
                        '    </td>' +

                        '    <td>' +
                        '        <div class="form-group" style="">' +
                        '            <input type="number" name="quantity[]"' +
                        '                id="quantity' + count + '"' +
                        '                onchange="getTotal(' + count + ')"' +
                        '                onkeyup="getTotal(' + count + ')" autocomplete="off"' +
                        '                class="form-control" min="1" />' +
                        '        </div>' +
                        '    </td>' +

                        '    <td style="">' +
                        '        <div class="form-group" style="">' +
                        '            <input type="text" name="total[]" id="total' + count + '"' +
                        '                autocomplete="off" class="form-control" disabled />' +

                        '            <input hidden type="text" name="totalValue[]"' +
                        '                id="totalValue' + count + '" autocomplete="off"' +
                        '                class="form-control" />' +
                        '        </div>' +
                        '    </td>' +
                        '    <td>';
                    //if (arrayNumber > 0) {
                    tr += '            <button class="btn btn-default removeProductRowBtn" type="button"' +
                        '                id="removeProductRowBtn"' +
                        '                onclick="removeProductRow(' + count + ')"><i' +
                        '                    class="bi bi-trash-fill"' +
                        '                    style="color: red; font-size: 1.5em"></i>' +
                        '            </button>';
                    //}
                    tr += '    </td>' +
                        '</tr>';
                    if (tableLength > 0) {
                        $("#productTable tbody tr:last").after(tr);
                    } else {
                        $("#productTable tbody").append(tr);
                    }

                    // init choices
                    var choices = new Choices('.form-select' + count, {
                        searchEnabled: true,
                        itemSelectText: '',
                    });

                } // /success
            }); // get the product data

        } // /add row

        function addFract() {
            $("#fractionne").button("loading");
            var tableLength = $("#echa tbody tr").length;
            var tableRow;
            var arrayNumber;
            var count;
            if (tableLength > 0) {
                tableRow = $("#echa tbody tr:last").attr('id');
                arrayNumber = $("#echa tbody tr:last").attr('clazz');
                count = tableRow.substring(3);
                count = Number(count) + 1;
                arrayNumber = Number(arrayNumber) + 1;
            } else {
                // no table row
                count = 1;
                arrayNumber = 0;
            }

            $("#fractionne").button("reset");

            var tr = '<tr id="productLabel' + count + '" clazz="' + arrayNumber + '">' +
                '                           <td colspan="4">' +
                '                               <div class="form-group" style="">' +
                '                                   <input type="text" name="label[]" id="' + count + '"' +
                '                                       placeholder="Insérer un label" autocomplete="off"' +
                '                                       class="form-control labelFormControl" />' +
                '                               </div>' +
                '                           </td>' +
                '                           <td>' +
                '                               <button class="btn btn-default removeProductLabelBtn" type="button"' +
                '                                   id="removeProductLabelBtn"' +
                '                                   onclick="removeProductLabel(' + count + ')"><i' +
                '                                       class="bi bi-trash-fill"' +
                '                                       style="color: red; font-size: 1.5em"></i>' +
                '                               </button>' +
                '                           </td>' +

                '                       </tr>';
            if (tableLength > 0) {
                $("#echa tbody tr:last").after(tr);
            } else {
                $("#echa tbody").append(tr);
            }


        } // /add row


        // /discount function

        function calculateDiscount() {
            var discount = $("#discount").val();
            var total_ht = $("#subTotalValue").val();
            // var customer_genre = "Normal"; // Récupérez la valeur du genre du client si nécessaire

            // if (discount) {
            // Vos conditions de remise
            if (customer_genre == "Normal") {
                if (total_ht >= 10000000) {
                    discount = 5;
                } else if (total_ht >= 5000000) {
                    discount = 2.5;
                } else {
                    discount = 0;
                }

            } else if (customer_genre == "Distributeur") {
                discount = 10;
            } else if (customer_genre == "Revendeur" || customer_genre == "Partenaire") {
                discount = 15;
            } else {
                discount = 0;
            }

            var totalDiscount = (discount * total_ht) / 100;
            totalDiscount = totalDiscount.toFixed(0);

            totalDiscount = totalDiscount.replace(/\D/g, '');
            totalDiscount = totalDiscount.replace(/\D/g, 0);
            totalDiscount = totalDiscount.replace(/\B(?=(\d{3})+(?!\d))/g, " ");

            $("#discount").val(discount);
            $("#discount_amount").val(totalDiscount);
            // }

            discountValue();
        }

        function discountValue() {
            var discountAmount = $("#discount_amount").val();

            // remove spaces from the amount
            discountAmount = discountAmount.replace(/\s+/g, '');

            if (discountAmount) {

                var grandTotal = Number($("#subTotalValue").val()) - Number(discountAmount);

                var taxeOf = ((tva * grandTotal) / 100);
                var retenuOf = ((retenu * grandTotal) / 100);
                var total_ttc = (taxeOf + grandTotal + retenuOf);
                total_ttc = total_ttc.toFixed(0);
                grandTotal = grandTotal.toFixed(0);
                taxeOf = taxeOf.toFixed(0);
                retenuOf = retenuOf.toFixed(0);

                // Total hors taxe
                $("#total_amount").val(new Intl.NumberFormat('fr-FR').format(grandTotal));
                $("#total_amountValue").val(grandTotal);

                // Taxe
                $("#taxe_amount").val(new Intl.NumberFormat('fr-FR').format(taxeOf));
                $("#taxe_amountValue").val(taxeOf);

                // Retenu
                $("#retenu_amount").val(new Intl.NumberFormat('fr-FR').format(retenuOf));
                $("#retenu_amountValue").val(retenuOf);

                // Total TTC
                $("#total_ttc_amount").val(new Intl.NumberFormat('fr-FR').format(total_ttc));
                $("#total_ttc_amountValue").val(total_ttc);


            } else {
                $("#total_amount").val(new Intl.NumberFormat('fr-FR').format($("#subTotalValue").val()));
                $("#total_amountValue").val($("#subTotalValue").val());

                // Taxe
                $("#taxe_amount").val(new Intl.NumberFormat('fr-FR').format($("#subTotalValue").val() * tva / 100));
                $("#taxe_amountValue").val($("#subTotalValue").val() * tva / 100);

                // Regime+
                $("#retenu_amount").val(new Intl.NumberFormat('fr-FR').format($("#subTotalValue").val() * retenu / 100));
                $("#retenu_amountValue").val($("#subTotalValue").val() * retenu / 100);


                //Total TTC
                $("#total_ttc_amount").val(new Intl.NumberFormat('fr-FR').format(Number($("#taxe_amountValue").val()) +
                    Number($("#total_amountValue").val()) + Number($("#retenu_amountValue").val())));
                $("#total_ttc_amountValue").val(Number($("#taxe_amountValue").val()) + Number($("#total_amountValue")
                    .val() + Number($("#retenu_amountValue").val())));

            }

        } // /discountValue function

        // Ajouter une ligne de fractionnement
        var maxLignes = 4; // Nombre maximum d'ajouts
        var lignesAjoutees = 0; // Compteur des lignes ajoutées

        // Ajouter une ligne de fractionnement
        $('.add-btn').click(function() {
            if (lignesAjoutees < maxLignes && canAddLine()) {
                var lineContainer = $('<div>').addClass('input-group mt-2 col-md-12');
                var inputNorme = $('<input>').attr({
                    type: 'number',
                    'aria-label': '%',
                    class: 'form-control norme col-1 col-md-2',
                    name: 'norme[]',
                    placeholder: '%',
                    max: '100',
                    min: '0'
                });
                var inputDate = $('<input>').attr({
                    type: 'number',
                    'aria-label': 'Montant',
                    class: 'form-control col-1 col-md-2',
                    name: 'date[]',
                    placeholder: 'Jour échéance'
                });

                var inputDescription = $('<input>').attr({
                    type: 'text',
                    class: 'form-control col-9 col-md-8',
                    name: 'description[]',
                    placeholder: 'Description'
                });


                var removeBtn = $('<button>').addClass('btn btn-danger rounded-circle remove-btn').text('-');

                // Supprimer la ligne de fractionnement
                removeBtn.click(function() {
                    $(this).closest('.input-group').remove();
                    lignesAjoutees--;
                    updateAddButtonState();
                });

                // Écouter l'événement input pour recalculer la somme
                inputNorme.on('input', function() {
                    updateAddButtonState();
                });

                lineContainer.append(inputNorme, inputDescription, inputDate, removeBtn);
                $('.lines-container').append(lineContainer);
                lignesAjoutees++;

                updateAddButtonState();
            }
        });

        // Vérifier si une nouvelle ligne peut être ajoutée
        function canAddLine() {
            var somme = getSomme();
            return somme < 100;
        }

        // Mettre à jour l'état du bouton d'ajout
        function updateAddButtonState() {
            if (lignesAjoutees >= maxLignes || !canAddLine()) {
                $('.add-btn').prop('disabled', true);
            } else {
                $('.add-btn').prop('disabled', false);
            }
        }

        // Obtenir la somme des nombres saisis
        function getSomme() {
            var somme = 0;
            $('.norme').each(function() {
                var valeur = parseInt($(this).val());
                if (!isNaN(valeur)) {
                    somme += valeur;
                }
            });
            return somme;
        }

        function echeance() {
            var resultEch = $(echeancement).val();

            if (resultEch == "unique") {

                $('#fractionne').hide();
                $('#comptant').hide();
                $('#unique').show();
            }
            if (resultEch == "comptant") {

                $('#unique').hide();
                $('#fractionne').hide();
                $('#comptant').show();

            }
            if (resultEch == "fractionne") {

                $('#unique').hide();
                $('#comptant').hide();
                $('#fractionne').show();

            }

        }
    </script>
    <script>
        $(document).ready(function() {
            // Écouter l'événement de clic sur le bouton "Vérifier" dans le modal
            $("#enregistrerProformaBtn").click(function() {
                var client_id = $("#client").val();
                var clients = client_id;
                var objet = $("#objet").val();
                var livraison = $("#livraison").val();
                var listeProduit = produitsListe;
                var modePaiement = $("#echeancement").val();

                var errors = []; // Tableau pour stocker les messages d'erreur

                if (clients === "") {
                    errors.push("Client");
                }
                if (objet === "") {
                    errors.push("Objet");
                }
                if (livraison === "") {
                    errors.push("Livraison");
                }
                if (listeProduit.length == 0) {
                    errors.push("Produits");
                }
                if (modePaiement === "Veuillez selectionner le mode de règlement") {
                    errors.push("Mode de paiement");
                }
                // Ajoutez ici d'autres validations pour les produits ou autres champs

                // Si des champs sont manquants, afficher le message d'erreur et désactiver le bouton "Enregistrer"
                if (errors.length > 0) {
                    var errorMessage =
                        '<span class="text-danger"><i class="fas fa-times-circle me-1"></i> <br>Il manque des champs à remplir obligatoirement !!!!<br>(la liste s\'affichera en dessous !)<br><br>Champs manquants : ' +
                        errors.join(', ') + '</span>';
                    // $("#sendNow").hide();

                    // $("#enregistrerProformaBtn").show();
                    $("#modalNote").show();
                    $("#errorNotification").html(errorMessage).show();

                } else {
                    $("#errorNotification").html(errorMessage).hide();
                    $("#modalNote").hide();
                    $("#form").submit();
                }
            });
        });
    </script>
@endsection
