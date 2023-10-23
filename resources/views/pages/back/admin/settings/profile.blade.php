@extends('pages.back.admin.master', ['titre' => 'EDITION DE PROFILE'])

@section('admin-content')
    <div class="card">
        <section id="basic-vertical-layouts">
            <div class="tab-content" id="nav-tabContent">
                <div class="m-3 d-flex justify-content-between mt-1">
                    <a class="btn btn-outline-secondary" href="{{ route('settings.pass') }}">
                        <i class="fa fa-lock"> </i>
                        mot de passe
                    </a>

                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                        <i class="fa fa-eye"></i>
                        Signature
                    </button>


                </div>

                <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
                    tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Ma signature</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="{{ asset('storage/' . $user->signature) }}" alt="Photo de signature"
                                    class="img-thumbnail">

                            </div>

                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                    tabindex="0">
                    <div class="tables">
                        <div>
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <div class="mb-0">
                                        <div class="">
                                            <div class="col-md-12">
                                                @if (Session::has('message'))
                                                    <div class="alert alert-success alert-dismissible fade show"
                                                        role="alert">
                                                        {{ Session::get('message') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form class="form form-vertical" method="POST"
                                                action="{{ route('users.update', $user->id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="col-md-12 col-12 mt-2">
                                                    <div class="form-body container">
                                                        <div class="row">
                                                            <div class="col-md-4 pt-5">
                                                                <div class="text-center">
                                                                    <div class="rounded-circle overflow-hidden"
                                                                        style="width: 250px; height: 250px;">
                                                                        @if (isset($user->photo))
                                                                            <img class="rounded-circle mt-1"
                                                                                alt="Photo de l'utilisateur"
                                                                                class="img-fluid"
                                                                                style="width: 100%; height: 100%; object-fit: cover;"
                                                                                src="{{ asset('storage/' . $user->photo) }}">
                                                                        @else
                                                                            <img class="rounded-circle mt-1"
                                                                                src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"
                                                                                alt="Photo de l'utilisateur"
                                                                                class="img-fluid"
                                                                                style="width: 100%; height: 100%; object-fit: cover;">
                                                                        @endif
                                                                        {{-- <img src="{{ asset('storage/' . $user->photo) }}"
                                                                        alt="Photo de l'utilisateur" class="img-fluid"
                                                                        style="width: 100%; height: 100%; object-fit: cover;"> --}}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-8">

                                                                <div class="row">
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="name">Nom :</label>
                                                                        <input type="text" id="name"
                                                                            class="form-control" name="name"
                                                                            placeholder="Nom" value="{{ $user->name }}"
                                                                            required>
                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="first_name">Prénom :</label>
                                                                        <input type="text" id="first_name"
                                                                            class="form-control" name="first_name"
                                                                            placeholder="Prénom"
                                                                            value="{{ $user->first_name }}" required>
                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="email">Email :</label>
                                                                        <input type="email" id="email"
                                                                            class="form-control" name="email"
                                                                            placeholder="Email" value="{{ $user->email }}"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="poste">Poste :</label>
                                                                        <input type="text" id="poste"
                                                                            class="form-control" name="poste"
                                                                            placeholder="Poste"
                                                                            value="{{ $user->poste }}">
                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="departement">Département :</label>
                                                                        <input type="text" id="departement"
                                                                            class="form-control" name="departement"
                                                                            placeholder="Département"
                                                                            value="{{ $user->departement }}">
                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="matricule">Matricule :</label>
                                                                        <input type="text" id="matricule"
                                                                            class="form-control" name="matricule"
                                                                            placeholder="Matricule"
                                                                            value="{{ $user->matricule }}">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="date_naissance">Date de naissance
                                                                            :</label>
                                                                        <input type="date" id="date_naissance"
                                                                            class="form-control" name="date_naissance"
                                                                            placeholder="Date de naissance"
                                                                            value="{{ $user->date_naissance }}">
                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="lieu_naissance">Lieu de naissance
                                                                            :</label>
                                                                        <input type="text" id="lieu_naissance"
                                                                            class="form-control" name="lieu_naissance"
                                                                            placeholder="Lieu de naissance"
                                                                            value="{{ $user->lieu_naissance }}">
                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="contact">Contact :</label>
                                                                        <input type="tel" id="contact"
                                                                            class="form-control" name="contact"
                                                                            placeholder="Contact"
                                                                            value="{{ $user->contact }}">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="photo">Photo :</label>
                                                                        <input type="file" id="photo"
                                                                            class="form-control" name="photo">
                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="commune">Commune :</label>
                                                                        <input type="text" id="commune"
                                                                            class="form-control" name="commune"
                                                                            placeholder="Commune"
                                                                            value="{{ $user->commune }}">
                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="quartier">Quartier :</label>
                                                                        <input type="text" id="quartier"
                                                                            class="form-control" name="quartier"
                                                                            placeholder="Quartier"
                                                                            value="{{ $user->quartier }}">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="ville">Ville :</label>
                                                                        <input type="text" id="ville"
                                                                            class="form-control" name="ville"
                                                                            placeholder="Ville"
                                                                            value="{{ $user->ville }}">
                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="sexe">Sexe :</label>
                                                                        <select id="sexe" class="form-control"
                                                                            name="sexe">
                                                                            <option value="masculin"
                                                                                @if ($user->sexe === 'masculin') selected @endif>
                                                                                Masculin
                                                                            </option>
                                                                            <option value="feminin"
                                                                                @if ($user->sexe === 'feminin') selected @endif>
                                                                                Féminin</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="signature">Signature :</label>
                                                                        <input type="file" id="signature"
                                                                            class="form-control" name="signature">

                                                                    </div>
                                                                    {{-- <div class="form-group col-md-4 mt-3">
                                                                    <label for="identifiant_credit_acces">Identifiant
                                                                        crédit
                                                                        accès :</label>
                                                                    <input type="text" id="identifiant_credit_acces"
                                                                        class="form-control"
                                                                        name="identifiant_credit_acces"
                                                                        placeholder="Identifiant crédit accès"
                                                                        value="{{ $user->identifiant_credit_acces }}">
                                                                </div> --}}
                                                                </div>

                                                                {{-- <div class="col-md-12">
                                                                <div class="form-group mt-3">
                                                                    <label for="signature">Signature :</label>
                                                                    <input type="file" id="signature"
                                                                        class="form-control" name="signature">
                                                                </div>
                                                            </div> --}}
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-12 d-flex justify-content-end mt-4">
                                                    <button type="submit" class="btn btn-success me-1 mb-1"
                                                        style="padding-left: 5%; padding-right: 5%;">Enregistrer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
@endsection
