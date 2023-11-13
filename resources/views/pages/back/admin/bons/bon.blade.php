@extends('pages.back.admin.master', ['titre' => 'CREATION DE BON'])
@section('style')
@endsection
@section('admin-content')
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tooltip.js/1.3.0/tooltip.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tooltip.js/1.3.0/tooltip.min.js"></script>


    <div class="card">
        <div class="p-3 d-flex justify-content-between">
            <div>
                <a class="btn btn-outline-danger" href="{{ route('proformas.index') }}">
                    <i class="fa fa-arrow-left"></i>
                    Proformas </a>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" method="POST" action="{{ route('bons.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row match-height">
                        <div class="col-md-3 col-12">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="domiciliation">Numéro Proforma</label>
                                            <div class="form-group">
                                               <input type="text" name="refProforma" class="form-control" readonly value="{{$refProforma}}" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-md-3 col-12">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="reglement">Uploader</label>
                                            <div class="form-group">
                                                <input class="form-control" name="doc" type="file">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="taxe">Sélectionner le Bon :</label>
                                        <div class="form-group">
                                            {{-- <div class="form-check form-check-inline">
                                                <label class="form-check-label" for="choose1">BC</label>
                                                 <input class="form-check-input" type="radio" name="type_bon"
                                                    id="choose1" value="BC">
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type_bon"
                                                    id="choose1">
                                                <label class="form-check-label" value="BPA" for="choose1">BPA</label>
                                            </div> --}}
                                            <input type="radio" name="type_bon" value="BC"> BC
                                            <input type="radio" name="type_bon" value="BPA"> BPA
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end mt-4" style="">
                        <button type="submit" class="btn btn-primary me-1 mb-1 "
                            style="padding-left: 5%; padding-right: 5%;" >
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            // Show particulier form on particulier button click
            #("#status_client_div").hide();
            $("#particulierRadio").click(function() {
                $("#formulaire").html($("#particulierForm").html());
            });

            // Show entreprise form on entreprise button click
            $("#entreprise-radio").click(function() {
                $("#formulaire").html($("#entreprise-form").html());
            });
        });
    </script> --}}
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            const statusClient = document.getElementById("status_client");
            const persContactFields = document.querySelectorAll("#persContact input");
            const missingFieldsText = document.getElementById("missingFieldsText");
            const missingFieldsDiv = document.getElementById("missingFields");
            const submitButton = document.querySelector("button[type='submit']");

            form.addEventListener("submit", function(event) {
                let missingFields = [];

                if (statusClient.value === "Entreprise") {
                    persContactFields.forEach(function(field) {
                        if (!field.value.trim()) {
                            missingFields.push(field.getAttribute("placeholder"));
                        }
                    });
                }

                if (missingFields.length > 0) {
                    event.preventDefault();
                    missingFieldsText.textContent = missingFields.join(", ");
                    missingFieldsDiv.style.display = "block";
                    const errorModal = new bootstrap.Modal(document.getElementById("errorModal"));
                    errorModal.show();
                }
            });
            statusClient.addEventListener("change", function() {
                if (statusClient.value === "Entreprise") {
                    persContactFields.forEach(function(field) {
                        field.setAttribute("required", "required");
                    });
                } else {
                    persContactFields.forEach(function(field) {
                        field.removeAttribute("required");
                    });
                }

                checkSubmitButtonStatus();
            });

            persContactFields.forEach(function(field) {
                field.addEventListener("input", function() {
                    checkSubmitButtonStatus();
                });
            });

            function checkSubmitButtonStatus() {
                const areAllFieldsFilled = Array.from(persContactFields).every(field => field.value.trim() !== "");
                submitButton.disabled = (statusClient.value === "Entreprise" && !areAllFieldsFilled);
            }
        });
    </script>

    <script>
        $(function() {
            var choices = new Choices('.form-select-fournisseur', {
                searchEnabled: true,
                itemSelectText: '',
            });

            var choices = new Choices('.form-select-type', {
                searchEnabled: true,
                itemSelectText: '',
            });
            var choices = new Choices('.form-select-domiciliation', {
                searchEnabled: true,
                itemSelectText: '',
            });
            var choices = new Choices('.form-select-reglement', {
                searchEnabled: true,
                itemSelectText: '',
            });
            $('#docsTva').hide();
            $("#fname").hide();
            $("#entreprise").show();
            $("#persContact").show();


            $("#type").change(function() {
                var select = $(this).val();
                console.log("STATUS CHANGED " + select);
                if (select == 'Goov') {
                    $("#tva_div").hide();
                    $("#regime_div").hide();
                    replaceClass("telephone_div", "col-md-2", "col-md-4");
                    replaceClass("solde_div", "col-md-2", "col-md-4");

                } else {
                    $("#tva_div").show();
                    $("#regime_div").show();
                    replaceClass("telephone_div", "col-md-4", "col-md-2");
                    replaceClass("solde_div", "col-md-4", "col-md-2");
                }
            });
            $("#domiciliation").change(function() {
                var select = $(this).val();
                console.log("STATUS CHANGED " + select);
                if (select == 'Etrangere') {
                    $("#tva_div").hide();
                    $("#regime_div").hide();
                    replaceClass("telephone_div", "col-md-2", "col-md-4");
                    replaceClass("solde_div", "col-md-2", "col-md-4");

                } else {
                    $("#tva_div").show();
                    $("#regime_div").show();
                    replaceClass("telephone_div", "col-md-4", "col-md-2");
                    replaceClass("solde_div", "col-md-4", "col-md-2");
                }
            });

        })

        function replaceClass(id, oldClass, newClass) {
            var elem = $(`#${id}`);
            console.log(elem);
            if (elem.hasClass(oldClass)) {
                elem.removeClass(oldClass);
                console.log("after deleted old class " + elem);

            }
            elem.addClass(newClass);
            console.log("after added new class " + elem);

        }
    </script>
    <script>
        function statusChange() {
            const radioButtons = document.getElementsByName('tva_status');
            let selectedValue;
            const fileInput = document.getElementById('formFile');

            for (let i = 0; i < radioButtons.length; i++) {
                if (radioButtons[i].checked) {
                    selectedValue = radioButtons[i].value;
                    break;
                }
            }

            console.log(selectedValue);

            if (selectedValue === 'Oui') {
                fileInput.removeAttribute('required');
                $('#docsTva').hide();
            } else {
                fileInput.setAttribute('required', 'required');
                $('#docsTva').show();
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

        function convertToUppercase(input) {
            input.value = input.value.toUpperCase();
        }
    </script>
    <script>
        $(document).ready(function() {
            $("input[name='regime']").change(function() {
                var selectedValue = $(this).val();
                var rsiRniFileSection = $("#retenu_file_section");

                if (selectedValue === "RSI" || selectedValue === "RNI") {
                    rsiRniFileSection.show();
                } else {
                    rsiRniFileSection.hide();
                }
            });

            $("input[name='regime']:checked").trigger("change");

            $("#retenu_file_section input[type='file']").change(function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        });
    </script> --}}
@endsection
