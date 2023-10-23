@extends('pages.back.admin.master', ['titre' => 'SETTING APP'])

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
    </style>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
            <div class="tables">
                <div class="card">

                    <section id="basic-vertical-layouts" class="col-md-12">
                        <div class="card-body row">

                            {{-- Card 1 --}}
                            <div class="col-md-6">
                                <form class="form form-vertical" method="POST"
                                    action="{{ route('settings.updateMarge') }}">
                                    @csrf
                                    <div class="row match-height">
                                        <div class="col-12 row">
                                            <div class="form-body col-md-8">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="mb-3"> La valeur de la marge <strong>public</strong>
                                                            actuelle est <b>
                                                                {{ $marge }} %</b> </span>
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" id="marge"
                                                                name="marge" placeholder="Entrer marge">
                                                            <label for="marge">Entrer la nouvelle marge
                                                                générale</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-auto d-flex justify-content-start" style="">
                                                <button type="submit"
                                                    class="btn btn-success me-1 mb-1">Enregistrer</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            {{-- End Card 1 --}}
                            {{-- Card 2 --}}
                            <div class="col-md-6">
                                <form class="form form-vertical" method="POST"
                                    action="{{ route('settings.updateMargeGoov') }}">
                                    @csrf
                                    <div class="row match-height">
                                        <div class="col-12 row">
                                            <div class="form-body col-md-8">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="mb-3"> La valeur de la marge <strong>goov</strong>
                                                            actuelle est <b>
                                                                {{ $marge_goov }} %</b> </span>
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" id="marge_goov"
                                                                name="marge_goov" placeholder="Entrer marge">
                                                            <label for="marge_goov">Entrer la nouvelle marge
                                                                goov</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-auto d-flex justify-content-start" style="">
                                                <button type="submit"
                                                    class="btn btn-warning me-1 mb-1">Enregistrer</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{-- End Card 2 --}}

                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#marge').on('input', function() {
                var marge = parseFloat($(this).val());
                var produits = $('.produit');

                produits.each(function(index) {
                    var produit = $(this);
                    var prixRevient = parseFloat(produit.data('prixRevient'));
                    var prixVente = prixRevient * (1 + (marge / 100));
                    var prixGoov = prixVente; // Modifier le prix goov également si nécessaire

                    produit.find('.prix-vente').val(prixVente.toFixed(2));
                    produit.find('.prix-goov').val(prixGoov.toFixed(2));
                });
            });
        });
    </script>
@endsection
