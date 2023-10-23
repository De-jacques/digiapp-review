@extends('pages.back.admin.master', ['titre' => 'GESTION DE MOT DE PASSE'])

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

                <section id="basic-vertical-layouts">
                    <div class="card-body">
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


                        <!-- USER SECTION START-->
                        <form class="form form-vertical" method="POST" action="{{ route('profiles.password') }}">
                            @csrf

                            <div class="container-fluid rounded bg-white mt-5 mb-5">
                                <div class="row">
                                    <div class="col-md-3 border-right">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            @if (isset($user->photo))
                                            <img class="rounded-circle mt-1" width="250px" height="250px"
                                                src="{{ asset('storage/' . $user->photo) }}">

                                            @else

                                            <img class="rounded-circle mt-1" width="150px"
                                                src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                                            @endif

                                            <span class="font-weight-bold">{{$user->name}}
                                                {{$user->first_name}}</span><span
                                                class="text-black-50">{{$user->email}}</span><span> </span>
                                        </div>
                                    </div>
                                    <div class="col-md-8 border-right">
                                        <div class="row mt-2">

                                            <div class="row g-3 align-items-center">
                                                <div class="col-auto col-md-2">
                                                    <label for="inputPassword1" class="col-form-label">Ancien mot de
                                                        passe</label>
                                                </div>
                                                <div class="col-auto col-md-6">
                                                    <input type="password" id="inputPassword1" class="form-control"
                                                        aria-labelledby="passwordHelpInline" name="old_password">
                                                    {{-- <span id="passwordHelpInline" class="form-text text-danger">
                                                        Doit contenir entre 8 et 20 caractères.
                                                    </span> --}}
                                                    @error('old_password')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-auto col-md-4 mb-3">
                                                    <i class="fa fa-eye eye" id="eye1" onclick="change1()"></i>

                                                </div>
                                            </div>

                                            <div class="row g-3 align-items-center">
                                                <div class="col-auto col-md-2">
                                                    <label for="inputPassword2" class="col-form-label">Nouveau mot de
                                                        passe</label>
                                                </div>
                                                <div class="col-auto col-md-6">
                                                    <input type="password" id="inputPassword2" class="form-control"
                                                        aria-labelledby="passwordHelpInline" name="new_password">
                                                    {{-- <span id="passwordHelpInline" class="form-text text-danger">
                                                        Doit contenir entre 8 et 20 caractères.
                                                    </span> --}}
                                                    @error('new_password')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-auto col-md-4 mb-3">
                                                    <i class="fa fa-eye eye" id="eye2" onclick="change2()"></i>

                                                </div>
                                            </div>



                                            <div class="row g-3 align-items-center">
                                                <div class="col-auto col-md-2">
                                                    <label for="inputPassword3" class="col-form-label">Confirmer mot de
                                                        passe</label>
                                                </div>
                                                <div class="col-auto col-md-6">
                                                    <input type="password" id="inputPassword3" class="form-control"
                                                        aria-labelledby="passwordHelpInline" name="confirm_password">
                                                    @error('confirm_password')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                    {{-- <span id="passwordHelpInline" class="form-text text-danger">
                                                        Doit contenir entre 8 et 20 caractères.
                                                    </span> --}}
                                                </div>
                                                <div class="col-auto col-md-4 mb-3">
                                                    <i class="fa fa-eye eye" id="eye3" onclick="change3()"></i>

                                                </div>
                                            </div>


                                        </div>

                                        <div class="mt-5 text-center d-flex justify-content-end"><button
                                                class="btn btn-primary profile-button" type="submit">Appliquer</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>


                        <!-- USER SECTION END-->

                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        margin-top: 20px;
        background: #f5f5f5;
    }

    /**
 * Panels
 */
    /*** General styles ***/
    .panel {
        box-shadow: none;
    }

    .panel-heading {
        border-bottom: 0;
    }

    .panel-title {
        font-size: 17px;
    }

    .panel-title>small {
        font-size: .75em;
        color: #999999;
    }

    .panel-body *:first-child {
        margin-top: 0;
    }

    .panel-footer {
        border-top: 0;
    }

    .panel-default>.panel-heading {
        color: #333333;
        background-color: transparent;
        border-color: rgba(0, 0, 0, 0.07);
    }

    form label {
        color: #999999;
        font-weight: 400;
    }

    .form-horizontal .form-group {
        margin-left: -15px;
        margin-right: -15px;
    }

    @media (min-width: 768px) {
        .form-horizontal .control-label {
            text-align: right;
            margin-bottom: 0;
            padding-top: 7px;
        }
    }

    .profile__contact-info-icon {
        float: left;
        font-size: 18px;
        color: #999999;
    }

    .profile__contact-info-body {
        overflow: hidden;
        padding-left: 20px;
        color: #999999;
    }

    .profile-avatar {
        width: 200px;
        position: relative;
        margin: 0px auto;
        margin-top: 196px;
        border: 4px solid #f3f3f3;
    }

    .eye {
        cursor: pointer;
    }
</style>
<script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script>
<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

<script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
    e1 = true;
    e2 = true;
    e3 = true;
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

    function change1() {
       if(e1){
        
        $('#inputPassword1').attr("type","text");
        $('#eye1').addClass("fa fa-eye-slash");
        e1=false;
       }
       else{


        $('#inputPassword1').attr("type","password");
        $('#eye1').removeClass("fa fa-eye-slash").addClass("fa fa-eye");
        e1=true;
       
       }
    }

    function change2() {
       if(e2){
        
        $('#inputPassword2').attr("type","text");
        $('#eye2').addClass("fa fa-eye-slash");
        e2=false;
       }
       else{


        $('#inputPassword2').attr("type","password");
        $('#eye2').removeClass("fa fa-eye-slash").addClass("fa fa-eye");
        e2=true;
       
       }
    }
    function change3() {
       if(e3){
        
        $('#inputPassword3').attr("type","text");
        $('#eye3').addClass("fa fa-eye-slash");
        e3=false;
       }
       else{


        $('#inputPassword3').attr("type","password");
        $('#eye3').removeClass("fa fa-eye-slash").addClass("fa fa-eye");
        e3=true;
       
       }
    }
</script>

@endsection