@extends('pages.back.admin.master', ['titre' => 'ENREGISTREMENT DE CLIENT'])
@section('style')
@endsection
@section('admin-content')
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tooltip.js/1.3.0/tooltip.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tooltip.js/1.3.0/tooltip.min.js"></script>


    <div class="card">
        <div class="p-3 d-flex justify-content-between">
            <div>
                <a class="btn btn-outline-danger" href="{{ route('customers.index') }}">
                    <i class="fa fa-arrow-left"></i>
                    Clients </a>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" method="POST" action="{{ route('customers.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row match-height">
                        <div class="col-md-3 col-12">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="status_client">Status du client (
                                                <span class="text-danger"> *</span>
                                                )</label>
                                            <div class="form-group">
                                                <select class="form-select-fournisseur form-control" name="status"
                                                    id="status_client">
                                                    <option value="Entreprise" selected>Entreprise</option>
                                                    <option value="Particulier">Particulier</option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                            <label for="domiciliation">Domiciliation (
                                                <span class="text-danger"> *</span>
                                                )</label>
                                            <div class="form-group">
                                                <select class="form-select-domiciliation form-control" name="domiciliation"
                                                    id="domiciliation">
                                                    <option value="Locale" selected>Locale</option>
                                                    <option value="Etrangere">Etrangère</option>
                                                </select>
                                                @error('domiciliation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                            <label for="type">Type de Client (
                                                <span class="text-danger"> *</span>
                                                )</label>
                                            <div class="form-group">
                                                <select class="form-select-type form-control" name="type" id="type">
                                                    <option value="Normal" selected>Normal</option>
                                                    <option value="Partenaire">Partenaire</option>
                                                    <option value="Goov">Goov</option>
                                                </select>
                                                @error('type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12" id="tva_div">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="taxe">Paye t'elle la Taxe TVA ?(
                                            <span class="text-danger"> *</span>
                                            )</label>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tva_status"
                                                    id="rad1" value="Oui" onchange="statusChange()" checked>
                                                <label class="form-check-label" for="rad1">Oui</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tva_status"
                                                    id="rad2" value="Non" onchange="statusChange()">
                                                <label class="form-check-label" for="rad2">Non</label>
                                            </div>
                                            @error('tva_status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="docsTva" class="col-md-12 mt-3">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Veuillez insérer la fiche d'exonération (Type
                                    PDF)</label>
                                <input class="form-control" type="file" id="formFile" name="file"
                                    accept="application/pdf">
                                @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if (old('file'))
                                    <span class="text-success">Fichier précédemment téléchargé: {{ old('file') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-12 mt-5">
                        <div class="form-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="form-group" id="fname">
                                        <label for="first-name-vertical">Nom et Prénoms (
                                            <span class="text-danger"> *</span>
                                            )</label>
                                        <input type="text" id="first-name-vertical" class="form-control"
                                            name="particular_name" placeholder="Nom complet">
                                        @error('particular_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="row form-group justify-content-between" id="entreprise">
                                        <div class="col-md-4">
                                            <label for="first-name-vertical">Raison sociale (
                                                <span class="text-danger"> *</span>
                                                )</label>
                                            <input type="text" id="first-name-vertical" class="form-control"
                                                name="enterprise_name" placeholder="Raison sociale">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-body">
                                                <label for="first-name-vertical">NCC (
                                                    <span class="text-danger"> *</span>
                                                    )</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control custom-file-input"
                                                        name="rcc_number" placeholder="N° NCC" id="rcc"
                                                        oninput="convertToUppercase(this)" />
                                                    <div class="input-group-append">
                                                        <label class="input-group-text btn btn-danger custom-file-label"
                                                            for="rcc_file">
                                                            <i class="fas fa-cloud-upload-alt"></i> Charger
                                                        </label>
                                                        <input onchange="updateIcon(this)" class="form-control"
                                                            type="file" id="rcc_file" style="display: none;"
                                                            name="rcc_file">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-body">
                                                <label for="first-name-vertical">RCCM (
                                                    <span class="text-danger"> *</span>
                                                    )</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control custom-file-input"
                                                        name="rcm_number" placeholder="N° RCCM" id="first-name-vertical"
                                                        oninput="convertToUppercase(this)" />
                                                    <div class="input-group-append">
                                                        <label class="input-group-text btn btn-danger custom-file-label"
                                                            for="rcm_file">
                                                            <i class="fas fa-cloud-upload-alt"></i> Charger
                                                        </label>
                                                        <input onchange="updateIcon(this)" class="form-control"
                                                            type="file" id="rcm_file" style="display: none;"
                                                            name="rcm_file">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 row">
                        <div class="col-md-4 col-12" id="regime_div">
                            <div class="form-body">
                                <label for="first-name-vertical">REGIME (
                                    <span class="text-danger"> *</span>
                                    )</label>
                                <div class="input-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="regime" id="inlineRadio1"
                                            value="TEE" checked>
                                        <label class="form-check-label" for="inlineRadio1">TEE</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="regime" id="inlineRadio2"
                                            value="RME">
                                        <label class="form-check-label" for="inlineRadio2">RME</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="regime" id="inlineRadio3"
                                            value="RSI">
                                        <label class="form-check-label" for="inlineRadio3">RSI</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="regime" id="inlineRadio4"
                                            value="RNI">
                                        <label class="form-check-label" for="inlineRadio4">RNI</label>
                                    </div>
                                    <div class="input-group-append" id="retenu_file_section">
                                        <label class="input-group-text btn btn-danger custom-file-label"
                                            for="retenu_file">
                                            <i class="fas fa-cloud-upload-alt"></i> Charger
                                        </label>
                                        <input onchange="updateIcon(this)" class="form-control" type="file"
                                            id="retenu_file" style="display: none;" name="retenu_file">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Email (
                                                <span class="text-danger"> *</span>
                                                )</label>
                                            <input type="email" id="email-id-vertical" class="form-control"
                                                name="email" placeholder="Email" required>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-12" id="solde_div">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="solde">Solde départ (
                                                <span class="text-danger"> *</span>
                                                )</label>
                                            <input type="number" id="solde" class="form-control" name="solde"
                                                placeholder="Solde départ" value="0" required>
                                            @error('solde')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-12" id="telephone_div">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Téléphone (
                                                <span class="text-danger"> *</span>
                                                )</label>
                                            <input type="tel" id="first-name-vertical" class="form-control"
                                                name="telephone" placeholder="Numéro de téléphone"
                                                value="{{ old('telephone') }}" required>
                                            @error('telephone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4 col-12">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Pays (
                                                <span class="text-danger"> *</span>
                                                )</label>
                                            <input type="text" id="first-name-vertical" class="form-control"
                                                name="pays" placeholder="Pays" required>
                                            @error('pays')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Ville (
                                                <span class="text-danger"> *</span>
                                                )</label>
                                            <input type="text" id="first-name-vertical" class="form-control"
                                                name="ville" placeholder="Ville" required>
                                            @error('ville')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Commune (
                                                <span class="text-danger"> *</span>
                                                )</label>
                                            <input type="text" id="first-name-vertical" class="form-control"
                                                name="commune" placeholder="Commune">
                                            @error('commune')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4 col-12">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Code Postal (
                                                <span class="text-danger"> *</span>
                                                )</label>
                                            <input type="text" id="first-name-vertical" class="form-control"
                                                name="code_postale" placeholder="Code postal">
                                            @error('code_postale')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Situation géographique (
                                                <span class="text-danger"> *</span>
                                                )</label>
                                            <input type="text" id="first-name-vertical" class="form-control"
                                                name="localisation" placeholder="Situation géographique" required>
                                            @error('localisation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3" id="persContact">
                        <legend>Personne à contacter</legend>
                        <div class="col-md-3 col-12">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-name">Nom du contact (
                                                <span class="text-danger"> *</span>
                                                )</label>
                                            <input type="text" id="contact-name" class="form-control"
                                                name="contact_name" placeholder="Nom du contact">
                                            @error('contact_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
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
                                            <label for="contact-email">Email du contact (
                                                <span class="text-danger"> *</span>
                                                )</label>
                                            <input type="email" id="contact-email" class="form-control"
                                                name="contact_email" placeholder="Email du contact">
                                            @error('contact_email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
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
                                            <label for="contact-telephone">Téléphone du contact (
                                                <span class="text-danger"> *</span>
                                                )</label>
                                            <input type="tel" id="contact-telephone" class="form-control"
                                                name="contact_telephone" placeholder="Téléphone du contact">
                                            @error('contact_telephone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
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
                                            <label for="contact-poste">Poste du contact (
                                                <span class="text-danger"> *</span>
                                                )</label>
                                            <input type="text" id="contact-poste" class="form-control"
                                                name="contact_poste" placeholder="Poste du contact">
                                            @error('contact_poste')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end mt-4" style="">
                        {{-- <button type="submit" class="btn btn-success me-1 mb-1"
                            style="padding-left: 5%; padding-right: 5%;">
                            Enregistrer
                        </button> --}}
                        <button type="submit" class="btn btn-primary me-1 mb-1 "
                            style="padding-left: 5%; padding-right: 5%;" disabled>
                            Enregistrer
                        </button>

                    </div>
                </form>


            </div>
        </div>
    </div>
    <div id="errorModal" class="modal fade" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div id="missingFields" class="mt-3" style="display: none;">
                        <span class="text-danger">
                            <i class="fas fa-times-circle me-1"></i> Champs manquants: <span
                                id="missingFieldsText"></span>
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Retourner</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script>
        $(document).ready(function() {
            // Show particulier form on particulier button click
            $("#particulierRadio").click(function() {
                $("#formulaire").html($("#particulierForm").html());
            });

            // Show entreprise form on entreprise button click
            $("#entreprise-radio").click(function() {
                $("#formulaire").html($("#entreprise-form").html());
            });
        });
    </script>
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script>

    <script>
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
            $('#docsTva').hide();
            $("#fname").hide();
            $("#entreprise").show();
            $("#persContact").show();

            $("#status_client").change(function() {
                var select = $(this).val();
                console.log("STATUS CHANGED " + select);
                if (select == 'Entreprise') {
                    $("#fname").hide();
                    $("#tva_div").show();
                    $("#regime_div").show();
                    $("#entreprise").show();
                    $("#persContact").show();
                    replaceClass("telephone_div", "col-md-4", "col-md-2");
                    replaceClass("solde_div", "col-md-4", "col-md-2");
                } else {
                    //telephone_div && solde_div remove col-md-2 for col-md-4
                    $("#tva_div").hide();
                    $("#regime_div").hide();
                    $("#fname").show();
                    $("#entreprise").hide();
                    $("#persContact").hide();
                    replaceClass("telephone_div", "col-md-2", "col-md-4");
                    replaceClass("solde_div", "col-md-2", "col-md-4");
                }
            });
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
        // function statusChange() {
        //     const radioButtons = document.getElementsByName('tva_status');
        //     let selectedValue;
        //     const fileInput = document.getElementById('formFile');

        //     for (let i = 0; i < radioButtons.length; i++) {
        //         if (radioButtons[i].checked) {
        //             selectedValue = radioButtons[i].value;
        //             break;
        //         }
        //     }

        //     console.log(selectedValue);

        //     if (selectedValue === 'Oui') {
        //         fileInput.removeAttribute('required');
        //         $('#docsTva').hide();
        //     } else {

        //         fileInput.setAttribute('required', 'required');
        //         $('#docsTva').show();
        //     }
        // }
        function statusChange() {
            const radioButtons = document.getElementsByName('tva_status');
            let selectedValue;
            const fileInput = document.getElementById('formFile');
            const regimeRadioButtons = document.getElementsByName('regime');
            var rsiRniSection = $("#retenu_file_section");


            for (let i = 0; i < radioButtons.length; i++) {
                if (radioButtons[i].checked) {
                    selectedValue = radioButtons[i].value;
                    break;
                }
            }

            if (selectedValue === 'Oui') {
                fileInput.removeAttribute('required');
                $('#docsTva').hide();
                rsiRniSection.hide();


                // Activer tous les boutons du régime
                for (let i = 0; i < regimeRadioButtons.length; i++) {
                    regimeRadioButtons[i].disabled = false;
                }
            } else {
                fileInput.setAttribute('required', 'required');
                $('#docsTva').show();
                rsiRniSection.show();

                // Désactiver les deux premiers boutons du régime et sélectionner le troisième
                for (let i = 0; i < regimeRadioButtons.length; i++) {
                    if (i < 2) {
                        regimeRadioButtons[i].disabled = true;
                    } else {
                        regimeRadioButtons[i].disabled = false;
                    }
                }

                // Sélectionner RSI comme valeur par défaut pour le régime
                document.querySelector('input[name="regime"][value="RSI"]').checked = true;
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
    </script>
@endsection
