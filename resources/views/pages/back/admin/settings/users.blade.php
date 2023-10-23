@extends('pages.back.admin.master', ['titre' => 'GESTION DES UTILISATEURS'])

@section('admin-content')


    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
            <div class="tables">
                <div class="card">

                    <section id="basic-vertical-layouts">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab" tabindex="0">
                                <div class="tables">
                                    <div>
                                        <div class="row gy-4">
                                            <div class="col-md-12">
                                                <div class="mb-0">
                                                    <div class="">
                                                        <div class="col-md-12 d-flex justify-content-start px-2 py-3">
                                                            @if (Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')
                                                                <a href="{{ route('users.create') }}"
                                                                    class="btn btn-outline-primary"><i
                                                                        class="fa fa-plus"></i>
                                                                    utilisateur</a>
                                                            @endif

                                                        </div>
                                                        <div class="col-md-12">
                                                            @if (Session::has('message'))
                                                                <div class="alert alert-success alert-dismissible fade show"
                                                                    role="alert">
                                                                    {{ Session::get('message') }}
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="alert" aria-label="Close"></button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table mb-0  table-hover display" id="datatable"
                                                                id="table1">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="d-none">Id</th>
                                                                        <th>#</th>
                                                                        <th>Photo profile</th>
                                                                        <th>Nom et Prénoms</th>
                                                                        <th>Poste</th>
                                                                        <th>Email</th>
                                                                        <th>Contact</th>
                                                                        <th>
                                                                            Actions
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @isset($users)
                                                                        @foreach ($users as $key => $client)
                                                                            <tr>
                                                                                <td class="d-none">{{ $client->id }}</td>
                                                                                <td class="text-center">
                                                                                    {{ $loop->iteration }}
                                                                                </td>
                                                                                <td
                                                                                    class="rounded overflow-hidden align-item-center justify-content-center">
                                                                                    <div class="text-center"
                                                                                        style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden;">
                                                                                        @if (isset($client->photo))
                                                                                            <img class="rounded-circle mt-1"
                                                                                                alt="Photo de l'utilisateur"
                                                                                                class="img-fluid"
                                                                                                style="width: 100%; height: 100%; object-fit: cover;"
                                                                                                src="{{ asset('storage/' . $client->photo) }}">
                                                                                        @else
                                                                                            <img class="rounded-circle mt-1"
                                                                                                src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"
                                                                                                alt="Photo de l'utilisateur"
                                                                                                class="img-fluid"
                                                                                                style="width: 100%; height: 100%; object-fit: cover;">
                                                                                        @endif
                                                                                        {{-- <img src="{{ asset('storage/' . $client->photo) }}"
                                                                                            alt="Photo de l'utilisateur"
                                                                                            style="width: 100%; height: 100%; object-fit: cover;"> --}}
                                                                                    </div>
                                                                                </td>
                                                                                <td>{{ $client->name }}
                                                                                    {{ $client->first_name }}
                                                                                </td>
                                                                                <td>{{ $client->poste }}</td>
                                                                                <td>{{ $client->email }}</td>
                                                                                <td>{{ $client->contact }}</td>
                                                                                <td class="">
                                                                                    <a href="" type="button"
                                                                                        class="btn btn-outline-info"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#show{{ $client->id }}">
                                                                                        <i class="fa fa-eye"></i>
                                                                                    </a>
                                                                                    @if (Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')
                                                                                        <a type="button"
                                                                                            class="btn btn-outline-warning"
                                                                                            href="{{ route('users.edit', $client->id) }}">
                                                                                            <i class="fa fa-pencil"></i>
                                                                                        </a>

                                                                                        <a href="" type="button"
                                                                                            class="btn btn-outline-danger"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#delete{{ $client->id }}">
                                                                                            <i class="fa fa-trash"></i>
                                                                                        </a>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>

                                                                            <!-- Modale de confirmation de suppression -->
                                                                            <div class="modal fade"
                                                                                id="delete{{ $client->id }}" tabindex="-1"
                                                                                role="dialog"
                                                                                aria-labelledby="myModalLabel{{ $client->id }}"
                                                                                aria-hidden="true">
                                                                                <div
                                                                                    class="modal-dialog modal-dialog-centered modal-md">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5"
                                                                                                id="myModalLabel{{ $client->id }}">
                                                                                                Confirmation de suppression</h1>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            Êtes-vous sûr de vouloir supprimer
                                                                                            l'utilisateur {{ $client->name }} ?
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">Annuler</button>
                                                                                            <form
                                                                                                action="{{ route('users.destroy', $client->id) }}"
                                                                                                method="POST">
                                                                                                @csrf
                                                                                                @method('DELETE')
                                                                                                <button type="submit"
                                                                                                    class="btn btn-danger">Supprimer</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Modale de détails de l'utilisateur -->
                                                                            <div class="modal fade"
                                                                                id="show{{ $client->id }}" tabindex="-1"
                                                                                role="dialog"
                                                                                aria-labelledby="myModalLabel{{ $client->id }}"
                                                                                aria-hidden="true">
                                                                                <div
                                                                                    class="modal-dialog modal-dialog-centered modal-xl">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5"
                                                                                                id="myModalLabel{{ $client->id }}">
                                                                                                Détails de l'utilisateur</h1>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">

                                                                                            <div class="row">
                                                                                                <div
                                                                                                    class="col-md-4 mt-5 align-item-center mx-auto d-block rounded-pill">
                                                                                                    <img src="{{ asset('storage/' . $client->photo) }}"
                                                                                                        alt="Photo de l'utilisateur"
                                                                                                        class="img-thumbnail">

                                                                                                    {{-- {{$client->photo}} --}}
                                                                                                </div>
                                                                                                <div class="col-md-8">

                                                                                                    <div class="row mt-3">
                                                                                                        <div class="col-md-6">
                                                                                                            <div
                                                                                                                class="form-group row align-items-center">
                                                                                                                <label
                                                                                                                    class="col-md-4">Nom
                                                                                                                    :</label>
                                                                                                                <div
                                                                                                                    class="col-md-8">
                                                                                                                    <input
                                                                                                                        class="form-control-plaintext fw-bold"
                                                                                                                        type="text"
                                                                                                                        value="{{ $client->name }}"
                                                                                                                        readonly>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="form-group row align-items-center">
                                                                                                                <label
                                                                                                                    class="col-md-4">Prénom
                                                                                                                    :</label>
                                                                                                                <div
                                                                                                                    class="col-md-8">
                                                                                                                    <input
                                                                                                                        class="form-control-plaintext fw-bold"
                                                                                                                        type="text"
                                                                                                                        value="{{ $client->first_name }}"
                                                                                                                        readonly>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="form-group row align-items-center">
                                                                                                                <label
                                                                                                                    class="col-md-4">Email
                                                                                                                    :</label>
                                                                                                                <div
                                                                                                                    class="col-md-8">
                                                                                                                    <input
                                                                                                                        class="form-control-plaintext fw-bold"
                                                                                                                        type="text"
                                                                                                                        value="{{ $client->email }}"
                                                                                                                        readonly>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="form-group row align-items-center">
                                                                                                                <label
                                                                                                                    class="col-md-4">Poste
                                                                                                                    :</label>
                                                                                                                <div
                                                                                                                    class="col-md-8">
                                                                                                                    <input
                                                                                                                        class="form-control-plaintext fw-bold"
                                                                                                                        type="text"
                                                                                                                        value="{{ $client->poste }}"
                                                                                                                        readonly>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-6">
                                                                                                            <div
                                                                                                                class="form-group row align-items-center">
                                                                                                                <label
                                                                                                                    class="col-md-4">Servie
                                                                                                                    :</label>
                                                                                                                <div
                                                                                                                    class="col-md-8">
                                                                                                                    <input
                                                                                                                        class="form-control-plaintext fw-bold"
                                                                                                                        type="text"
                                                                                                                        value="{{ $client->departement }}"
                                                                                                                        readonly>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="form-group row align-items-center">
                                                                                                                <label
                                                                                                                    class="col-md-4">Matricule
                                                                                                                    :</label>
                                                                                                                <div
                                                                                                                    class="col-md-8">
                                                                                                                    <input
                                                                                                                        class="form-control-plaintext fw-bold"
                                                                                                                        type="text"
                                                                                                                        value="{{ $client->matricule }}"
                                                                                                                        readonly>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="form-group row align-items-center">
                                                                                                                <label
                                                                                                                    class="col-md-4">Date
                                                                                                                    de n.
                                                                                                                    :</label>
                                                                                                                <div
                                                                                                                    class="col-md-8">
                                                                                                                    <input
                                                                                                                        class="form-control-plaintext fw-bold"
                                                                                                                        type="text"
                                                                                                                        value="{{ $client->date_naissance }}"
                                                                                                                        readonly>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="form-group row align-items-center">
                                                                                                                <label
                                                                                                                    class="col-md-4">Lieu
                                                                                                                    de n.
                                                                                                                    :</label>
                                                                                                                <div
                                                                                                                    class="col-md-8">
                                                                                                                    <input
                                                                                                                        class="form-control-plaintext fw-bold"
                                                                                                                        type="text"
                                                                                                                        value="{{ $client->lieu_naissance }}"
                                                                                                                        readonly>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>


                                                                                                    <div class="row mt-3">
                                                                                                        <div class="col-md-6">
                                                                                                            <div
                                                                                                                class="form-group row align-items-center">
                                                                                                                <label
                                                                                                                    class="col-md-4">Contact
                                                                                                                    :</label>
                                                                                                                <div
                                                                                                                    class="col-md-8">
                                                                                                                    <input
                                                                                                                        class="form-control-plaintext fw-bold"
                                                                                                                        type="text"
                                                                                                                        value="{{ $client->contact }}"
                                                                                                                        readonly>
                                                                                                                </div>
                                                                                                            </div>

                                                                                                            <div
                                                                                                                class="form-group row align-items-center">
                                                                                                                <label
                                                                                                                    class="col-md-4">Commune
                                                                                                                    :</label>
                                                                                                                <div
                                                                                                                    class="col-md-8">
                                                                                                                    <input
                                                                                                                        class="form-control-plaintext fw-bold"
                                                                                                                        type="text"
                                                                                                                        value="{{ $client->commune }}"
                                                                                                                        readonly>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            @if (auth()->user()->role == 'super_admin')
                                                                                                                <div
                                                                                                                    class="form-group row align-items-center mt-2">
                                                                                                                    <label
                                                                                                                        class="col-md-4">Signatue
                                                                                                                        :</label>
                                                                                                                    {{-- <div
                                                                                                        class="col-md-8">

                                                                                                        <input
                                                                                                            class="form-control-plaintext fw-bold"
                                                                                                            type="text"
                                                                                                            value="{{ $client->signature }}"
                                                                                                            readonly>
                                                                                                    </div> --}}
                                                                                                                    <img src="{{ asset('storage/' . $client->signature) }}"
                                                                                                                        alt="Photo de signature"
                                                                                                                        class="img-thumbnail">
                                                                                                                </div>
                                                                                                            @endif

                                                                                                        </div>
                                                                                                        <div class="col-md-6">
                                                                                                            <div
                                                                                                                class="form-group row align-items-center">
                                                                                                                <label
                                                                                                                    class="col-md-4">Quartier
                                                                                                                    :</label>
                                                                                                                <div
                                                                                                                    class="col-md-8">
                                                                                                                    <input
                                                                                                                        class="form-control-plaintext fw-bold"
                                                                                                                        type="text"
                                                                                                                        value="{{ $client->quartier }}"
                                                                                                                        readonly>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="form-group row align-items-center">
                                                                                                                <label
                                                                                                                    class="col-md-4">Ville
                                                                                                                    :</label>
                                                                                                                <div
                                                                                                                    class="col-md-8">
                                                                                                                    <input
                                                                                                                        class="form-control-plaintext fw-bold"
                                                                                                                        type="text"
                                                                                                                        value="{{ $client->ville }}"
                                                                                                                        readonly>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="form-group row align-items-center">
                                                                                                                <label
                                                                                                                    class="col-md-4">Sexe
                                                                                                                    :</label>
                                                                                                                <div
                                                                                                                    class="col-md-8">
                                                                                                                    <input
                                                                                                                        class="form-control-plaintext fw-bold"
                                                                                                                        type="text"
                                                                                                                        value="{{ $client->sexe }}"
                                                                                                                        readonly>
                                                                                                                </div>
                                                                                                            </div>

                                                                                                            {{-- <div
                                                                                                    class="form-group row align-items-center">
                                                                                                    <label
                                                                                                        class="col-md-4">N.
                                                                                                        Access
                                                                                                        :</label>
                                                                                                    <div
                                                                                                        class="col-md-8">
                                                                                                        <input
                                                                                                            class="form-control-plaintext fw-bold"
                                                                                                            type="text"
                                                                                                            value="{{ $client->identifiant_credit_acces }}"
                                                                                                            readonly>
                                                                                                    </div>
                                                                                                </div> --}}
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">Fermer</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    @endisset
                                                                </tbody>
                                                            </table>
                                                        </div>
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
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>


@endsection
