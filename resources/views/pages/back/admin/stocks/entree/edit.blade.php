@extends('pages.back.admin.master', ['titre' => "EDITION DE BON D'ENTRÉE "])


@section('admin-content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/tooltip.js/1.3.0/tooltip.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/tooltip.js/1.3.0/tooltip.min.js"></script>

{{-- <section class="section"> --}}
    <div class="card">
        {{-- {!! getReturnedMessage($errors, session('error'), session('success')) !!} --}}
        <div class="card-body">
            <div class="d-flex justify-content-between">

                <div class="mb-5 mt-1">
                    <a class="btn btn-outline-secondary" href="{{ route('stocks.entre') }}"> Liste des bons d'entrée
                    </a>
                </div>
                <div class="form-check form-switch text-danger" onchange="provider()">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label " for="flexSwitchCheckDefault">Prestataire</label>
                </div>

            </div>

            <form class="form form-vertical" method="POST" action="{{ route('entree.update',$entree->id) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row match-height">
                    <div class="col-md-3 col-12" style="" id="fournisseurSection">

                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="type_client">Fournisseur : </label>
                                        <div class="form-group">
                                            <select class="form-select-fournisseur form-control" name="fournisseur_id"
                                                id="four">
                                                <option selected disabled>~~ Sélectionner fournisseur~~</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-danger">
                            @error('fournisseur_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="fournisseur_type" value="">
                    </div>
                    <div class="col-md-3 col-12" id="prestataireSection" style="display:none">

                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="type_client">Prestataire : </label>
                                        <div class="form-group">
                                            <select class="form-select-prestataire form-control" name="prestataire_id"
                                                id="prest">
                                                <option selected disabled>~~ Sélectionner prestataire~~</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-danger">
                            @error('fournisseur_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="fournisseur_type" value="">

                    </div>


                    <div class="col-md-3 col-12">

                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="type_client">Entrepot : </label>
                                        <div class="form-group">
                                            <select class="form-select-entrepot form-control " name="entrepot_id"
                                                id="entrepot">
                                                <option selected disabled>~~ Sélectionner entrepot~~</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-danger">
                            @error('entrepot_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2 col-12">

                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="type_client">N° Commande : </label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="num_facture"
                                                value="{{$entree->num_facture}}" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-danger">
                            @error('num_facture')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2  d-flex justify-content-between">
                        <div class="form-body col-md-10">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="type_client">N° BL : </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="num_bl"
                                            value="{{$entree->num_bl}}" required />
                                    </div>
                                </div>
                            </div>
                            <div class="text-danger">
                                @error('num_bl')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2" style="margin-top: 30px">
                            <div class="custom-file d-flex justify-content-center">
                                <input type="file" class="custom-file-input" id="bl_file" onchange="updateIcon(this)"
                                    name="bl_file" required hidden>
                                <label class="custom-file-label" for="bl_file" data-toggle="tooltip"
                                    title="Veuillez charger le fichier">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </label>
                            </div>
                            <div class="text-danger">
                                @error('bl_file')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <div class="col-md-2 col-12">

                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="type_client">Date : </label>
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="date"
                                                value="{{$entree->date}}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-danger">
                            @error('date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <table class="table table-responsive" id="productTable">
                    <thead>
                        <tr>
                            <th style="">Produit</th>
                            <th style="">Qté. Commandée</th>
                            <th style="">Qté. Livrée </th>
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
                                        id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)">
                                        <option value="">Selectionner un produit</option>

                                    </select>
                                </div>
                            </td>

                            {{-- <td style="">
                                <div class="form-group" style="">
                                    <input type="text" name="ratev[]" id="ratev<?php echo $x; ?>" autocomplete="off"
                                        class="form-control" disabled onchange="getTotal(<?php echo $x; ?>)"
                                        onkeyup="getTotal(<?php echo $x; ?>)" required />

                                    <input type="hidden" name="ratevValue[]" id="ratevValue<?php echo $x; ?>"
                                        autocomplete="off" onchange="getTotal(<?php echo $x; ?>)"
                                        onkeyup="getTotal(<?php echo $x; ?>)" class="form-control" required />
                                </div>
                            </td> --}}

                            <td class="col-md-2">
                                <div class="form-group" style="">
                                    <input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" {{--
                                        onchange="getTotal(<?php echo $x; ?>)" onkeyup="getTotal(<?php echo $x; ?>)"
                                        --}} autocomplete="off" class="form-control" min="1" />
                                </div>
                            </td>
                            <td class="col-md-2">
                                <div class="form-group" style="">
                                    <input type="number" name="qte_livre[]" id="qte_livre<?php echo $x; ?>" {{--
                                        onchange="getTotal(<?php echo $x; ?>)" onkeyup="getTotal(<?php echo $x; ?>)"
                                        --}} onchange="getReste(<?php echo $x; ?>)"
                                        onkeyup="getReste(<?php echo $x; ?>)" autocomplete="off" class="form-control"
                                        min="1" />
                                </div>
                            </td>
                            <td class="col-md-2">
                                <div class="form-group" style="">
                                    <input type="number" name="reste[]" id="reste<?php echo $x; ?>" {{--
                                        onchange="getTotal(<?php echo $x; ?>)" onkeyup="getTotal(<?php echo $x; ?>)"
                                        --}} autocomplete="off" class="form-control" min="1" readonly />
                                </div>
                            </td>
                            <td class="col-md-2">
                                <div class="form-group" style="">
                                    <input type="text" name="observation[]" id="observation<?php echo $x; ?>" {{--
                                        onchange="getTotal(<?php echo $x; ?>)" onkeyup="getTotal(<?php echo $x; ?>)"
                                        --}} autocomplete="off" class="form-control" />
                                </div>
                            </td>

                            {{-- <td style="">
                                <div class="form-group" style="">
                                    <input type="text" name="total[]" required id="total<?php echo $x; ?>"
                                        autocomplete="off" class="form-control" disabled />

                                    <input hidden type="text" name="totalValue[]" id="totalValue<?php echo $x; ?>"
                                        required autocomplete="off" class="form-control" />
                                </div>
                            </td> --}}
                            <td class="col-md-2" style="text-align: center">
                                <button class="btn btn-default removeProductRowBtn" type="button"
                                    id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i
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


                <div class="col-12 d-flex justify-content-left mt-2" style="font-weight: bold">
                    <button type="button" class="btn btn-sm btn-primary me-1 mb-1" id="addRowBtn"
                        onclick="AjouterUneLigne()" style="font-weight: bold">
                        <i class="bi bi-plus"></i> Ajouter une ligne
                    </button>
                </div>

                <hr>
                <div class="row match-height">
                    <div class="col-md-4 col-12">
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-between mt-4" style="">
                    <button type="reset" class="btn btn-danger me-1 mb-1"
                        style="padding-left: 5%; padding-right: 5%;">Annuler</button>
                    <button type="submit" class="btn btn-primary me-1 mb-1 "
                        style="padding-left: 5%; padding-right: 5%;">Enregistrer</button>
                </div>
            </form>

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
</style>
<script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script>
<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
<script>
    function provider(){
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

    function updateIcon(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
    
        reader.onload = function(e) {
          var icon = input.parentElement.querySelector('.custom-file-label i');
          icon.classList.remove('fas', 'fa-cloud-upload-alt');
          icon.classList.add('fas', 'fa-check');
          input.parentElement.querySelector('.custom-file-label').classList.add('uploaded');
          input.parentElement.querySelector('.custom-file-label').style.color = '#28a745'; // changer la couleur de fond en vert
        }
    
        reader.readAsDataURL(input.files[0]); // lecture du fichier et appel de la fonction onload
      }
    }

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

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

    function removeProductRow(row = null) {
        if (row) {
            $("#row" + row).remove();
            subAmount();
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
            if (Number(reste) < 0 ) {
                // console.log("Valeur inférieure");
                alert("La valeur saisie est inférieur à 0");
                // alertInferieure();
                
            }
            $("#reste" + row).val(new Intl.NumberFormat('fr-FR').format(reste));
            
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
                $('#entrepot').append('<option value="{{ $produit->id }}" @if ($produit->id === $entree->entrepot_id) selected @endif>{{ $produit->name }}</option>');
            @endforeach

            var choices = new Choices('.form-select-entrepot', {
                searchEnabled: true,
                itemSelectText: '',
            });

        }
       


    // function loadFournisseur() {
    //     // ajax request
    //     var selectedType = 'supplier'; // Remplace par le type sélectionné

    //     $.ajax({
    //         url: '{{ route('stock.getFournisseur') }}',
    //         type: 'get',
    //         dataType: 'json',
    //         data: { type: selectedType }, // Envoie le type sélectionné en tant que paramètre
    //         success: function(response) {
 
    //             $.each(response.suppliers, function(index, supplier) {
    //             $('#four').append('<option value="' + supplier.id +'" data-type="supplier"   @if ('+supplier.id+' === $entree->supplier_id) selected @endif>' + supplier.name +
    //                 '</option>');
    //         });

              
          
    //             var choices = new Choices('.form-select-fournisseur', {
    //                 searchEnabled: true,
    //                 itemSelectText: '',
    //             });
    //         }
    //     });
    // }

    // function loadPrestataire() {
    //     // ajax request
    //     var selectedType = 'supplier'; // Remplace par le type sélectionné

    //     $.ajax({
    //         url: '{{ route('stocks.getPrestataire') }}',
    //         type: 'get',
    //         dataType: 'json',
    //         data: { type: selectedType }, // Envoie le type sélectionné en tant que paramètre
    //         success: function(response) {
 
    //         //     $.each(response.suppliers, function(index, supplier) {
    //         //     $('#prest').append('<option value="' + supplier.id +'" data-type="supplier"  @if ('+supplier.id+' === $entree->supplier_id) selected @endif>' + supplier.name +
    //         //         '</option>');
    //         // });

              
    //         $.each(response.providers, function(index, provider) {
    //             $('#prest').append('<option value="' + provider.id + '" data-type="provider"  @if ('+provider.id+' === $entree->provider_id) selected @endif>' + provider.name +
    //                 '</option>');
    //         });
    //             var choices = new Choices('.form-select-prestataire', {
    //                 searchEnabled: true,
    //                 itemSelectText: '',
    //             });
    //         }
    //     });
    // }

    function getProductData(row = null) {
    if (row) {
        var productId = $("#productName" + row).val();
        if (productId == "") {
            resetFields(row);
        } else {
            $.ajax({
                url: '{{ route('stock.getProductData') }}',
                type: 'post',
                data: {
                    id: productId,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                   if (response.pv != null && response.pv != '' && response.pv != 0) {

                                $("#ratev" + row).attr('disabled', 'true').attr('type', 'text').attr('required',
                                    'true');
                                $("#ratevValue" + row).attr('type', 'hidden').val('');

                                $("#ratev" + row).val(new Intl.NumberFormat('fr-FR').format(response.pv));
                                $("#ratevValue" + row).val(response.pv);
                            } else {
                                $("#ratev" + row).attr('type', 'hidden').val('');
                                $("#ratevValue" + row).attr('type', 'text').val('');
                            }

                            $("#quantity" + row).val(1);
                            getTotal(row);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    } else {
        alert("Pas d'entrée ! Veuillez rafraîchir la page !");
    }
}



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
                    '    </td>' ;
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
                    '    <td class="col-md-2" style="text-align:center">';
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
    function loadFournisseur() {

// foreach $customers
@foreach ($fournisseurs as $four)
    // add customer to the select
    $('#four').append('<option value="{{ $four->id }}" @if ($four->id === $entree->supplier_id) selected @endif>{{ $four->name }}</option>');
@endforeach

var choices = new Choices('.form-select-fournisseur', {
    searchEnabled: true,
    itemSelectText: '',
});

}

function loadPrestataire() {

// foreach $customers
@foreach ($prestataires as $pre)
    // add customer to the select
    $('#pre').append('<option value="{{ $pre->id }}" @if ($pre->id === $entree->provider_id) selected @endif>{{ $pre->name }}</option>');
@endforeach

var choices = new Choices('.form-select-fournisseur', {
    searchEnabled: true,
    itemSelectText: '',
});

}
</script>
@endsection