@extends('pages.back.admin.master', ['titre' => 'ENREGISTRER UN BON DE RECEPTION '])

@section('admin-content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css" />
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">

                <div class="mb-5 mt-1">
                    <a class="btn btn-outline-secondary" href="{{ route('stocks.entre') }}">
                        <i class="fa fa-arrow-left"></i>
                        BONS DE RECEPTION
                    </a>
                </div>
                <div class="form-check form-switch text-danger" onchange="provider()">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label " for="flexSwitchCheckDefault">Prestataire</label>
                </div>

            </div>
            <div class="container">
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <form class="form form-vertical" method="POST" action="{{ route('entree.store') }}"
                enctype="multipart/form-data" id="form">
                @csrf
                <div class="row match-height">
                    <div class="col-md-4 col-12" style="" id="fournisseurSection">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="type_client">Fournisseur
                                            (
                                            <span class="text-danger"> *</span>
                                            )
                                        </label>
                                        <div class="form-group">
                                            <select class="form-select-fournisseur form-control" name="fournisseur_id"
                                                id="four">
                                                <option selected disabled>~~ Choix fournisseur~~</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-danger">
                            {{-- @error('fournisseur_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror --}}
                        </div>
                        <input type="hidden" name="fournisseur_type" value="">
                    </div>

                    <div class="col-md-4 col-12" id="prestataireSection" style="display:none">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="type_client" class="text-danger">Prestataire (
                                            <span class="text-danger"> *</span>
                                            )</label>
                                        <div class="form-group">
                                            <select class="form-select-prestataire form-control" name="prestataire_id"
                                                id="prest">
                                                <option selected disabled>~~ Choix prestataire~~</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-danger">
                            {{-- @error('fournisseur_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror --}}
                        </div>
                        <input type="hidden" name="fournisseur_type" value="">
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="type_client">Entrepot (
                                            <span class="text-danger"> *</span>
                                            ) </label>
                                        <div class="form-group">
                                            <select class="form-select-entrepot form-control " name="entrepot_id"
                                                id="entrepot">
                                                <option selected disabled>~ Choix entrepot~</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="type_client">N° Commande (
                                <span class="text-danger"> *</span>
                                )
                            </label>
                            <div class="form-group">
                                <input type="text" id="commande" class="form-control" name="num_facture"
                                    {{-- value="{{ Carbon\Carbon::today()->toDateString() }}" --}} />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mt-3 d-flex justify-content-between">
                        <div class="form-body">
                            <label for="type_client">N° BL (
                                <span class="text-danger"> *</span>
                                ) </label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="num_bl" placeholder="N° BL"
                                    id="num_bl" />
                                {{-- <div class="input-group-append">
                                    <label class="input-group-text btn btn-primary" for="bl_file">
                                        <i class="fas fa-cloud-upload-alt"></i> Charger
                                    </label>
                                    <input class="form-control" type="file" id="bl_file" style="display: none;">
                                </div> --}}
                                <div class="input-group-append">
                                    <label class="input-group-text btn btn-danger custom-file-label" for="bl_file">
                                        <i class="fas fa-cloud-upload-alt"></i> Charger
                                    </label>
                                    <input onchange="updateIcon(this)" class="form-control" type="file"
                                        id="bl_file" style="display: none;" name="bl_file">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-12 mt-3 mb-3">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="type_client">Date : </label>
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="date"
                                                value="{{ Carbon\Carbon::today()->toDateString() }}" id="date" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <table class="table table-responsive" id="productTable">
                    <thead>
                        <tr>
                            <th style="">Produit</th>
                            <th style="">Qté. Commandée</th>
                            <th style="">Qté. Livrée</th>
                            <th style="">Reste</th>
                            <th style="">Observation</th>
                            <th style=""></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $arrayNumber = 0;
                        for ($x = 1; $x < 2; $x++) {
                        ?>
                        <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
                            <td class="col-md-4" style="">
                                <div class="form-group">
                                    <select class="form-control form-select<?php echo $x; ?>" name="productName[]"
                                        id="productName<?php echo $x; ?>"
                                        onchange="getProductData(<?php echo $x; ?>)">
                                        <option value="">Sélectionner un produit</option>
                                    </select>
                                </div>
                            </td>
                            <td class="col-md-2">
                                <div class="form-group" style="">
                                    <input type="number" name="quantity[]" id="quantity<?php echo $x; ?>"
                                        autocomplete="off" class="form-control" min="1" />
                                </div>
                            </td>
                            <td class="col-md-2">
                                <div class="form-group" style="">
                                    <input type="number" name="qte_livre[]" id="qte_livre<?php echo $x; ?>"
                                        onchange="getReste(<?php echo $x; ?>)" onkeyup="getReste(<?php echo $x; ?>)"
                                        autocomplete="off" class="form-control" min="1" />
                                </div>
                            </td>
                            <td class="col-md-2">
                                <div class="form-group" style="">
                                    <input type="number" name="reste[]" id="reste<?php echo $x; ?>"
                                        autocomplete="off" class="form-control" min="1" readonly />
                                </div>
                            </td>
                            <td class="col-md-2">
                                <div class="form-group" style="">
                                    <input type="text" name="observation[]" id="observation<?php echo $x; ?>"
                                        autocomplete="off" class="form-control" />
                                </div>
                            </td>
                            <td class="col-md-2 d-flex justify-content-between" style="text-align: center">

                                <button class="btn btn-default removeProductRowBtn" type="button"
                                    id="removeProductRowBtn<?php echo $x; ?>"
                                    onclick="removeProductRow(<?php echo $x; ?>)">
                                    <i class="bi bi-trash-fill" style="color: red; font-size: 1.5em"></i>
                                </button>
                            </td>
                        </tr>
                        <?php
                            $arrayNumber++;
                        } // /for
                        ?>
                    </tbody>
                </table>



                <div class="col-12 d-flex justify-content-left mt-2" style="font-weight: bold">
                    <button type="button" class="btn btn-sm btn-primary me-1 mb-1" id="addRowBtn"
                        onclick="AjouterUneLigne()" style="font-weight: bold">
                        <i class="bi bi-plus"></i> Ajouter une ligne
                    </button>
                </div>

                <hr>
                <div id="collapse">
                    {{-- <h1 class="text-center">SECTION DE COLLAPSE</h1> --}}
                    {{-- <hr> --}}
                    <div class="collapse" id="collapseExample<?php echo $x; ?>">
                        <div class="d-flex justify-space-between">
                            <div class="" style="margin-right:10px">
                                <input class="form-control" type="text" name="sn[]" id="sn<?php echo $x; ?>"
                                    placeholder="numéro de série">
                            </div>
                        </div>
                    </div>


                </div>
                {{-- <hr> --}}
                <div class="row match-height">
                    <div class="col-md-4 col-12">
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end mt-4" style="">
                    {{-- <button id="addBtn" type="submit" class="btn btn-success me-1 mb-1 "
                        style="padding-left: 5%; padding-right: 5%;">Enregistrer</button> --}}

                    <a id="addBtn" class="btn btn-success me-1 rounded-pill"
                        style="padding-left: 5%; padding-right: 5%;" data-bs-toggle="modal"
                        data-bs-target="#spinnerModal">Enregistrer</a>
                </div>
            </form>

        </div>
    </div>

    <!-- Modal Spinner -->
    <div class="modal fade" id="spinnerModal" tabindex="-1" aria-labelledby="spinnerModalLabel" aria-hidden="true"
        id="modalNote">
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
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Retourner</button>
                </div>
            </div>
        </div>
    </div>

    {{-- </section> --}}
    <style>
        .custom-file-label {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
        }

        .btn.active {
            background-color: white;
            color: blue;
        }
    </style>
    {{-- <script src="{{ asset('assets/js/main.js') }}"></script> --}}
    <script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>

    <script>
        var produitsListe = [];

        // Déclaration de la variable produitsRencontres en dehors de la fonction success
        var produitsRencontres = [];

        function provider() {
            // Récupérer la référence de la case à cocher
            var checkbox = document.getElementById("flexSwitchCheckDefault");

            // Vérifier si la case à cocher est cochée
            if (checkbox.checked) {
                console.log("La case à cocher est activée !");
                $('#fournisseurSection').hide();
                $('#prestataireSection').show();
            } else {
                $('#prestataireSection').hide();
                $('#fournisseurSection').show();
                console.log("La case à cocher n'est pas activée.");
            }
        }


        function convertToUppercase(input) {
            input.value = input.value.toUpperCase();
        }


        $(function() {

            // call getfournisseur function
            loadFournisseur();
            loadPrestataire();
            loadProduct();
            loadEntrepot();

            $("#four").change(function() {
                var four = $(this).val();


                $.ajax({
                    url: '{{ route('stock.getFournisseur') }}',
                    type: 'post',
                    data: {
                        id: four,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'html',
                    success: function(response) {


                        $('#num_facture').html(response);

                        // init choices
                        //*
                        var choices = new Choices('.form-select' + four, {
                            searchEnabled: true,
                            itemSelectText: '',
                        });
                    } // /success
                }); // /ajax function to fetch the product data
            });
            $("#prest").change(function() {
                var prest = $(this).val();


                $.ajax({
                    url: '{{ route('stocks.getPrestataire') }}',
                    type: 'post',
                    data: {
                        id: prest,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'html',
                    success: function(response) {


                        // $('#num_facture').html(response);

                        // init choices
                        //*
                        var choices = new Choices('.form-select' + prest, {
                            searchEnabled: true,
                            itemSelectText: '',
                        });
                    } // /success
                }); // /ajax function to fetch the product data
            });
        });

        // function removeProductRow(row = null) {
        //     if (row) {
        //         $("#row" + row).remove();
        //         subAmount();
        //     } else {
        //         alert('Erreur! Veuillez rafraîchir la page !');
        //     }
        // }

        function removeProductRow(row = null) {
            if (row) {
                var nomProduit = produitsRencontres[row - 1];
                produitsRencontres.splice(row - 1, 1);
                $("#row" + row).remove();
                // Supprimer un produit de la liste produitsRencontres
                subAmount();
                console.log(produitsRencontres);
            } else {
                alert('Erreur! Veuillez rafraîchir la page !');
            }
        }

        function getTotal(row = null) {
            if (row) {
                var total = Number($("#ratevValue" + row).val()) * Number($("#quantity" + row).val());
                total = total.toFixed(0);
                $("#total" + row).val(new Intl.NumberFormat('fr-FR').format(total));
                $("#totalValue" + row).val(total);
                subAmount();
            } else {
                alert("Pas d'entrée ! Veuillez rafraîchir la page !");
            }
        }


        function getReste(row = null) {

            console.log("selected " + row);

            if (row != null) {
                var reste = Number($("#quantity" + row).val()) - Number($("#qte_livre" + row).val());
                reste = reste.toFixed(0);
                console.log(reste);
                if (Number(reste) < 0) {
                    // console.log("Valeur inférieure");
                    alert("La valeur saisie est inférieur à 0");
                    // alertInferieure();

                }

                $("#reste" + row).val(new Intl.NumberFormat('fr-FR').format(reste));

                $("#reste" + row).val(new Intl.NumberFormat('fr-FR').format(reste));
                if (Number(reste) === 0) {
                    $("#observation" + row).val("RAS");
                    $("#observation" + row).prop("readonly", true);
                } else {
                    $("#observation" + row).prop("readonly", false);
                }

            } else {
                alert("Pas d'entrée ! Veuillez rafraîchir la page !");
            }
        }


        function loadProduct() {
            // foreach $produits
            @foreach ($produits as $product)
                // add produit to the select
                $('#productName1').append('<option value="{{ $product->id }}">{{ $product->designation }}</option>');
            @endforeach

            var choices = new Choices('#productName1', {
                searchEnabled: true,
                itemSelectText: '',
            });

        }

        function loadEntrepot() {
            // foreach $customers
            @foreach ($entrepots as $produit)
                // add customer to the select
                $('#entrepot').append('<option value="{{ $produit->id }}">{{ $produit->name }}</option>');
            @endforeach

            var choices = new Choices('.form-select-entrepot', {
                searchEnabled: true,
                itemSelectText: '',
            });

        }


        function loadFournisseur() {
            // ajax request
            var selectedType = 'supplier'; // Remplace par le type sélectionné

            $.ajax({
                url: '{{ route('stock.getFournisseur') }}',
                type: 'get',
                dataType: 'json',
                data: {
                    type: selectedType
                }, // Envoie le type sélectionné en tant que paramètre
                success: function(response) {

                    $.each(response.suppliers, function(index, supplier) {
                        $('#four').append('<option value="' + supplier.id + '" data-type="supplier">' +
                            supplier.name +
                            '</option>');
                    });


                    $.each(response.providers, function(index, provider) {
                        $('#four').append('<option value="' + provider.id + '" data-type="provider">' +
                            provider.name +
                            '</option>');
                    });
                    var choices = new Choices('.form-select-fournisseur', {
                        searchEnabled: true,
                        itemSelectText: '',
                    });
                }
            });
        }

        function loadPrestataire() {
            // ajax request
            var selectedType = 'supplier'; // Remplace par le type sélectionné

            $.ajax({
                url: '{{ route('stocks.getPrestataire') }}',
                type: 'get',
                dataType: 'json',
                data: {
                    type: selectedType
                }, // Envoie le type sélectionné en tant que paramètre
                success: function(response) {

                    $.each(response.suppliers, function(index, supplier) {
                        $('#prest').append('<option value="' + supplier.id + '" data-type="supplier">' +
                            supplier.name +
                            '</option>');
                    });


                    $.each(response.providers, function(index, provider) {
                        $('#prest').append('<option value="' + provider.id + '" data-type="provider">' +
                            provider.name +
                            '</option>');
                    });
                    var choices = new Choices('.form-select-prestataire', {
                        searchEnabled: true,
                        itemSelectText: '',
                    });
                }
            });
        }

        // function getProductData(row = null) {
        //     if (row) {
        //         var productId = $("#productName" + row).val();
        //         if (productId == "") {
        //             resetFields(row);
        //         } else {
        //             $.ajax({
        //                 url: '{{ route('stock.getProductData') }}',
        //                 type: 'post',
        //                 data: {
        //                     id: productId,
        //                     _token: '{{ csrf_token() }}'
        //                 },
        //                 dataType: 'json',
        //                 success: function(response) {
        //                     if (response.pv != null && response.pv != '' && response.pv != 0) {

        //                         $("#ratev" + row).attr('disabled', 'true').attr('type', 'text').attr('required',
        //                             'true');
        //                         $("#ratevValue" + row).attr('type', 'hidden').val('');

        //                         $("#ratev" + row).val(new Intl.NumberFormat('fr-FR').format(response.pv));
        //                         $("#ratevValue" + row).val(response.pv);
        //                     } else {
        //                         $("#ratev" + row).attr('type', 'hidden').val('');
        //                         $("#ratevValue" + row).attr('type', 'text').val('');
        //                     }

        //                     $("#quantity" + row).val(1);
        //                     getTotal(row);
        //                 },
        //                 error: function(xhr, status, error) {
        //                     console.log(xhr.responseText);
        //                 }
        //             });
        //         }
        //     } else {
        //         alert("Pas d'entrée ! Veuillez rafraîchir la page !");
        //     }
        // }
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

                                console.log(produitsRencontres);

                                produitsListe = produitsRencontres;
                            }
                            var group_client = $('#group_client').val();
                            $("#quantity" + row).removeAttr('max');

                            if (customer_genre == "Goov") {
                                // console.log('Informations vérifiées');
                                if (response.prix_goov != null && response.prix_goov != '' && response
                                    .prix_goov != 0) {
                                    // console.log(response.prix_goov);

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
                                    // console.log(response.prix_goov);

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
                            // $("#quantity" + row).attr("max", response.quantity);
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
            // console.log(total_ttc_amount.val());
        } // /select on product data


        function resertFileds(row = null) {
            $("#ratev" + row).val("");
            $("#ratevValue" + row).val("");

            $("#quantity" + row).val("");

            $("#total" + row).val("");
            $("#totalValue" + row).val("");

            $("#quantity" + row).attr("max", "0").attr("min", "0");

            $("#total_amount").val("");
            $("#total_amountValue").val("");
        }

        function subAmount() {
            var tableProductLength = $("#productTable tbody tr").length;
            var totalSubAmount = 0;
            for (x = 0; x < tableProductLength; x++) {
                var tr = $("#productTable tbody tr")[x];
                var count = $(tr).attr('id');
                count = count.substring(3);
                totalSubAmount = Number(totalSubAmount) + Number($("#totalValue" + count).val());
                //alert(remis);
            } // /for

            totalSubAmount = totalSubAmount.toFixed(0);

            // sub total
            $("#total_amount").val(new Intl.NumberFormat('fr-FR').format(totalSubAmount));
            $("#total_amountValue").val(totalSubAmount);

            //discountValue();

        } // /sub total amount

        function AjouterUneLigne() {
            $("#addRowBtn").button("loading");
            var tableLength = $("#productTable tbody tr").length;
            var tableRow;
            var arrayNumber;
            var count;
            if (tableLength > 0) {
                tableRow = $("#productTable tbody tr:last").attr('id');
                arrayNumber = $("#productTable tbody tr:last").attr('class');
                count = tableRow.substring(3);
                count = Number(count) + 1;
                arrayNumber = Number(arrayNumber) + 1;
            } else {
                // no table row
                count = 1;
                arrayNumber = 0;
            }

            $.ajax({
                url: '{{ route('stock.listProduct') }}',
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    // console.log(response);

                    $("#addRowBtn").button("reset");

                    var tr = '<tr id="row' + count + '" class="' + arrayNumber + '">' +
                        '<td class="col-md-5"  style="">' +
                        '<div class="form-group">' +
                        '<select class="form-control choices form-select' + count + '"' +
                        'name="productName[]" id="productName' + count + '"' +
                        'onchange="getProductData(' + count + ')">' +
                        '<option value="">Selectionner un produit</option>';

                    $.each(response, function(index, value) {

                        tr += '<option value="' + value['id'] + '">' + value['designation'] +
                            '</option>';
                    });
                    // var session = $("#userSession").val();

                    tr += '</select>' +
                        '</div>' +
                        '</td>';

                    tr +=
                        '    <td class="col-md-2" >' +
                        '        <div class="form-group" style="">' +
                        '            <input type="number" name="quantity[]"' +
                        '                id="quantity' + count + '"' +
                        // '                onchange="getTotal(' + count + ')"' +
                        // '                onkeyup="getTotal(' + count + ')" autocomplete="off"' +
                        '                class="form-control" min="1" />' +
                        '        </div>' +
                        '    </td>';
                    tr +=
                        '    <td class="col-md-2" >' +
                        '        <div class="form-group" style="">' +
                        '            <input type="number" name="qte_livre[]"' +
                        '                id="qte_livre' + count + '"' +
                        // '                onchange="getTotal(' + count + ')"' +
                        // '                onkeyup="getTotal(' + count + ')" autocomplete="off"' +
                        'onchange="getReste(' + count + ')"' +
                        '                onkeyup="getReste(' + count + ')"' +
                        '                class="form-control" min="1" />' +
                        '        </div>' +
                        '    </td>';
                    tr +=
                        '    <td class="col-md-2" >' +
                        '        <div class="form-group" style="">' +
                        '            <input type="number" name="reste[]"' +
                        '                id="reste' + count + '"' +
                        // '                onchange="getTotal(' + count + ')"' +
                        // '                onkeyup="getTotal(' + count + ')" autocomplete="off"' +
                        '                class="form-control" min="1" readonly />' +
                        '        </div>' +
                        '    </td>'
                    tr +=
                        '    <td class="col-md-2" >' +
                        '        <div class="form-group" style="">' +
                        '            <input type="text" name="observation[]"' +
                        '                id="observation' + count + '"' +
                        // '                onchange="getTotal(' + count + ')"' +
                        // '                onkeyup="getTotal(' + count + ')" autocomplete="off"' +
                        '                class="form-control" min="1" />' +
                        '        </div>' +
                        '    </td>' +
                        '    <td class="col-md-2 d-flex justify-content-between" style="text-align:center">';
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

        function getRowNumber(button) {
            var row = $(button).closest('tr');
            var rowIndex = row.index() + 1;

            var button = $('#collapse-btn' + (rowIndex));
            var icon = $('#icon' + (rowIndex));

            console.log('Numéro de ligne : ' + rowIndex);

            if (icon.hasClass('bi-dash')) {
                // button.removeClass('active');
                button.css('background-color', '');
                button.css('color', '');
                icon.removeClass('bi-dash').addClass('bi-plus');
            } else {
                // button.addClass('active');
                button.css('background-color', button.css('color'));
                button.css('color', button.css('background-color'));
                icon.removeClass('bi-plus').addClass('bi-dash');

            }
        }
    </script>
    <script>
        $(document).ready(function() {
            // Écouter l'événement de clic sur le bouton "Vérifier" dans le modal
            $("#addBtn").click(function() {
                var four_id = $("#four").val();
                var prest = $("#prest").val();
                var entrepot = $("#entrepot").val();
                var commande = $("#commande").val();
                var num_bl = $("#num_bl").val();
                var bl_file = $("#bl_file").val();
                var date = $("#date").val();
                var listeProduit = produitsListe;
                console.log("Fournisseur:" + four_id, "| Prestataire :" + prest, "| Entrepot: " + entrepot,
                    "| Commande :" + commande, "| Numero BL: " + num_bl, "| Date :" + date);
                var errors = []; // Tableau pour stocker les messages d'erreur

                if (four_id === "~~ Choix fournisseur~~" && prest === "~~ Choix prestataire~~") {
                    errors.push("Fournisseur ou Prestataire");
                }
                if (entrepot === "~ Choix entrepot~") {
                    errors.push("Entrepot");
                }
                if (commande === "") {
                    errors.push("Commande");
                }
                if (num_bl === "") {
                    errors.push("Numéro BL");
                }
                if (bl_file === "") {
                    errors.push("Fichier BL");
                }
                if (date === "") {
                    errors.push("Date");
                }
                if (listeProduit.length == 0) {
                    errors.push("Produits");
                }

                console.log("Liste des erreurs:" + errors);
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


        function updateIcon(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var icon = input.parentElement.querySelector('.custom-file-label i');
                    icon.classList.remove('fas', 'fa-cloud-upload-alt');
                    icon.classList.add('fas', 'fa-check');
                    input.parentElement.querySelector('.custom-file-label').classList.add('uploaded');
                    input.parentElement.querySelector('.custom-file-label').style.color =
                        '#fff'; // changer la couleur de fond en vert
                    input.parentElement.querySelector('.custom-file-label').classList.remove('btn-danger');
                    input.parentElement.querySelector('.custom-file-label').classList.add('btn-success');
                }

                reader.readAsDataURL(input.files[0]); // lecture du fichier et appel de la fonction onload
            }
        }

        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
