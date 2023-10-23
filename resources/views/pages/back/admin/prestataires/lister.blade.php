@extends('pages.back.admin.master', ['titre' => 'GESTION DES PRESTATAIRES'])

@section('admin-content')
{{--
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
{{--
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css" /> --}}
<link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
        <div class="tables">
            <div>
                <div class="row gy-4">
                    <div class="col-md-12">
                        <div class="card mb-0">
                            <div class="">
                                <div class="col-md-12 d-flex justify-content-start px-2 py-3">
                                    <a href="{{ route('providers.create') }}" class="btn btn-outline-primary"><i
                                            class="fa fa-plus"></i> prestataire</a>
                                </div>
                                <div class="col-md-12">
                                    @if (Session::has('message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ Session::get('message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0  table-hover display" id="datatable" id="table1">
                                        <thead>
                                            <tr>
                                                <th class="d-none">Id</th>
                                                <th>Nom</th>
                                                <th>Status</th>
                                                <th>Email</th>
                                                <th>Solde</th>
                                                <th>
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($providers)
                                            @foreach ($providers as $key => $client)
                                            <tr>
                                                <td class="d-none">{{$client->id}}</td>
                                                <td>{{ $client->name }}</td>
                                                <td>{{ $client->status }}</td>
                                                <td>{{ $client->email }}</td>
                                                <td>{{ $client->balance }}</td>
                                                <td class="">
                                                    <a href="" type="button" class="btn btn-outline-info"
                                                        data-bs-toggle="modal" data-bs-target="#show{{ $client->id }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    <a type="button" class="btn btn-outline-warning"
                                                        href="{{ route('providers.edit',$client->id) }}">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    @if (Auth::user()->role === 'admin' || Auth::user()->role
                                                    ==='super_admin')

                                                    <a href="" type="button" class="btn btn-outline-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $client->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    @endif

                                                </td>
                                            </tr>

                                            <!-- Show Modal -->


                                            <div class="modal fade" id="show{{$client->id}}" data-bs-backdrop="show"
                                                data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title" id="editLabel">Informations de
                                                                {{$client->name}}</h5>
                                                            <button type="button" class="btn-close btn-danger"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal">
                                                                @csrf
                                                                @method('PATCH')
                                                                <div class="form-control-group mb-4">
                                                                    <div class="row">
                                                                        <div class="form-control-group col-md-4 mb-3">
                                                                            <label for="nom">
                                                                                @if ($client->status == 'Entreprise')
                                                                                Raison sociale
                                                                                @else
                                                                                Nom
                                                                                @endif
                                                                            </label>
                                                                            <input class="text-center form-control"
                                                                                id="nom" type="text" name="nom"
                                                                                value="{{old('nom') ?? $client->name }}"
                                                                                readonly />
                                                                        </div>
                                                                        <div class="form-control-group col-md-3 mb-3">
                                                                            <label for="status">Status</label>
                                                                            <input
                                                                                class="text-center form-control text-capitalize"
                                                                                id="status" type="text" name="status"
                                                                                value="{{old('status') ?? $client->status }}"
                                                                                readonly />
                                                                        </div>
                                                                        <div class="form-control-group col-md-4 mb-3">
                                                                            <label for="tva_status">Exonération</label>
                                                                            <div class="input-group">
                                                                                @if ($client->taxe_tva == 'Non')
                                                                                <input class="text-center form-control"
                                                                                    id="tva_status" type="text"
                                                                                    name="tva_status" value="Oui"
                                                                                    readonly />

                                                                                @else

                                                                                <input class="text-center form-control"
                                                                                    id="tva_status" type="text"
                                                                                    name="tva_status" value="Non"
                                                                                    readonly />
                                                                                @endif
                                                                                @if ($client->exo_path)
                                                                                <a class="btn btn-primary"
                                                                                    href="{{ asset('storage/'.$client->exo_path) }}"
                                                                                    download>
                                                                                    <i class="fa fa-download"></i>
                                                                                </a>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="form-control-group col-md-6 mb-3">
                                                                            <label for="email">Email</label>
                                                                            <input class="text-center form-control"
                                                                                id="type" type="text" name="email"
                                                                                value="{{old('email') ?? $client->email }}"
                                                                                readonly />
                                                                        </div>

                                                                        <div class="form-control-group col-md-3 mb-3">
                                                                            <label for="balance">Solde</label>
                                                                            <input class="text-center form-control"
                                                                                id="balance" type="text" name="balance"
                                                                                value="{{old('balance') ?? $client->balance }}"
                                                                                readonly />
                                                                        </div>
                                                                        <div class="form-control-group col-md-3 mb-3">
                                                                            <label for="contact">Contact</label>
                                                                            <input class="text-center form-control"
                                                                                id="contact" type="text" name="contact"
                                                                                value="{{old('contact') ?? $client->contact }}"
                                                                                readonly />
                                                                        </div>
                                                                    </div>
                                                                    @if (isset($client->rcc_number) ||
                                                                    isset($client->rcm_number))

                                                                    <div class="row">

                                                                        <div class="form-control-group col-md-6 mb-3">
                                                                            <label for="rcc_number">RCC</label>
                                                                            <div class="input-group">
                                                                                <input class="text-center form-control"
                                                                                    id="rcc_number" type="text"
                                                                                    name="rcc_number"
                                                                                    value="{{old('rcc_number') ?? $client->rcc_number }}"
                                                                                    readonly />
                                                                                @if ($client->rcc_path)
                                                                                <a class="btn btn-primary"
                                                                                    href="{{ asset('storage/'.$client->rcc_path) }}"
                                                                                    download>
                                                                                    <i class="fa fa-download"></i>
                                                                                </a>
                                                                                @endif
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-control-group col-md-6 mb-3">
                                                                            <label for="rcm_number">RCM</label>
                                                                            <div class="input-group">
                                                                                <input class="text-center form-control"
                                                                                    id="rcm_number" type="text"
                                                                                    name="rcm_number"
                                                                                    value="{{old('rcm_number') ?? $client->rcm_number }}"
                                                                                    readonly />
                                                                                @if ($client->rcm_path)
                                                                                <a class="btn btn-primary"
                                                                                    href="{{ asset('storage/'.$client->rcm_path) }}"
                                                                                    download>
                                                                                    <i class="fa fa-download"></i>
                                                                                </a>
                                                                                @endif
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    @endif

                                                                    <div class="row">
                                                                        <div class="form-control-group col-md-3 mb-3">
                                                                            <label for="country">Pays</label>
                                                                            <input class="text-center form-control"
                                                                                id="country" type="text" name="country"
                                                                                value="{{old('country') ?? $client->country }}"
                                                                                readonly />
                                                                        </div>
                                                                        <div class="form-control-group col-md-3 mb-3">
                                                                            <label for="city">Ville</label>
                                                                            <input class="text-center form-control"
                                                                                id="city" type="text" name="date"
                                                                                value="{{ $client->city }}" readonly />
                                                                        </div>
                                                                        <div class="form-control-group col-md-3 mb-3">
                                                                            <label for="municipality">Commune</label>
                                                                            <input class="text-center form-control"
                                                                                id="municipality" type="text"
                                                                                name="date"
                                                                                value="{{ $client->municipality }}"
                                                                                readonly />
                                                                        </div>
                                                                        <div class="form-control-group col-md-3 mb-3">
                                                                            <label for="date">Inscrit le</label>
                                                                            <input class="text-center form-control"
                                                                                id="date" type="text" name="date"
                                                                                value="{{ date('d-m-y H:i', strtotime($client->created_at)) }}"
                                                                                readonly />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- End of show modal --}}
                                            {{-- Edit Modal --}}
                                            <div class="modal-info me-1 mb-1 d-inline-block">
                                                <!--warning theme Modal -->
                                                <div class="modal fade text-left" id="edit{{$client->id}}" tabindex="-1"
                                                    role="dialog" aria-labelledby="myModalLabel140" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-warning">
                                                                <h5 class="modal-title white" id="myModalLabel140">
                                                                    <i class="bi bi-border-width"></i> Édition de client
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('providers.update',$client->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="id" id="id">
                                                                <div class="modal-body" style="font-weight:bold">

                                                                    <div class="row match-height">
                                                                        <div class="col-md-4 col-12">
                                                                            <div class="form-body">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="status_client">Status
                                                                                                du client : </label>
                                                                                            <div class="form-group">
                                                                                                <select
                                                                                                    class="form-select-fournisseur form-control"
                                                                                                    name="status"
                                                                                                    id="status_client">
                                                                                                    <option
                                                                                                        value="Entreprise"
                                                                                                        selected>
                                                                                                        Entreprise
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Particulier">
                                                                                                        Particulier
                                                                                                    </option>
                                                                                                </select>
                                                                                            </div>
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
                                                                                            <label for="type">Type de
                                                                                                fournisseur : </label>
                                                                                            <div class="form-group">
                                                                                                <select
                                                                                                    class="form-select-fournisseur form-control select2"
                                                                                                    name="type"
                                                                                                    id="type">
                                                                                                    <option
                                                                                                        value="Normal"
                                                                                                        selected>Normal
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Distributeur">
                                                                                                        Distributeur
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="Revendeur">
                                                                                                        Revendeur
                                                                                                    </option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 col-12">
                                                                            <div class="form-body">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <div class="form-group"
                                                                                            id="fname">
                                                                                            <label
                                                                                                for="first-name-vertical">Nom
                                                                                                et Prénoms</label>
                                                                                            <input type="text"
                                                                                                id="first-name-vertical"
                                                                                                class="form-control"
                                                                                                name="particular_name"
                                                                                                placeholder="Nom complet">
                                                                                        </div>
                                                                                        <div class="form-group"
                                                                                            id="entreprise">
                                                                                            <label
                                                                                                for="first-name-vertical">Raison
                                                                                                sociale</label>
                                                                                            <input type="text"
                                                                                                id="first-name-vertical"
                                                                                                class="form-control"
                                                                                                name="enterprise_name"
                                                                                                placeholder="Raison sociale">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-5 row">
                                                                        <div class="col-md-4 col-12">
                                                                            <div class="form-body">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="email-id-vertical">Email</label>
                                                                                            <input type="email"
                                                                                                id="email-id-vertical"
                                                                                                class="form-control"
                                                                                                name="email"
                                                                                                placeholder="Email">
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
                                                                                            <label for="solde">Solde
                                                                                                départ</label>
                                                                                            <input type="number"
                                                                                                id="solde"
                                                                                                class="form-control"
                                                                                                name="solde"
                                                                                                placeholder="Solde départ"
                                                                                                value=0>
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
                                                                                            <label
                                                                                                for="first-name-vertical">Téléphone</label>
                                                                                            <input type="tel"
                                                                                                id="first-name-vertical"
                                                                                                class="form-control"
                                                                                                name="telephone"
                                                                                                placeholder="Numéro de téléphone">
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
                                                                                            <label
                                                                                                for="first-name-vertical">Pays</label>
                                                                                            <input type="text"
                                                                                                id="first-name-vertical"
                                                                                                class="form-control"
                                                                                                name="pays"
                                                                                                placeholder="Pays">
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
                                                                                            <label
                                                                                                for="first-name-vertical">Ville</label>
                                                                                            <input type="text"
                                                                                                id="first-name-vertical"
                                                                                                class="form-control"
                                                                                                name="ville"
                                                                                                placeholder="Ville">
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
                                                                                            <label
                                                                                                for="first-name-vertical">Commune</label>
                                                                                            <input type="text"
                                                                                                id="first-name-vertical"
                                                                                                class="form-control"
                                                                                                name="commune"
                                                                                                placeholder="Commune">
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
                                                                                            <label
                                                                                                for="contact-name">Nom
                                                                                                de la personne à
                                                                                                contacter</label>
                                                                                            <input type="text"
                                                                                                id="contact-name"
                                                                                                class="form-control"
                                                                                                name="contact_name"
                                                                                                placeholder="Nom de la personne à contacter">
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
                                                                                            <label
                                                                                                for="contact-email">Email
                                                                                                de la personne à
                                                                                                contacter</label>
                                                                                            <input type="email"
                                                                                                id="contact-email"
                                                                                                class="form-control"
                                                                                                name="contact_email"
                                                                                                placeholder="Email de la personne à contacter">
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
                                                                                            <label
                                                                                                for="contact-telephone">Téléphone
                                                                                                de la personne à
                                                                                                contacter</label>
                                                                                            <input type="tel"
                                                                                                id="contact-telephone"
                                                                                                class="form-control"
                                                                                                name="contact_telephone"
                                                                                                placeholder="Téléphone de la personne à contacter">
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
                                                                                            <label
                                                                                                for="contact-poste">Poste
                                                                                                de la personne à
                                                                                                contacter</label>
                                                                                            <input type="text"
                                                                                                id="contact-poste"
                                                                                                class="form-control"
                                                                                                name="contact_poste"
                                                                                                placeholder="Poste de la personne à contacter">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-light-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Fermer</span>
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span
                                                                            class="d-none d-sm-block">Enregistrer</span>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End Edit Modal --}}
                                            <!-- Suppression Modal -->
                                            <div class="modal fade" id="delete{{ $client->id }}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteLabel">Demande de
                                                                confirmation</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Voulez-vous vraiment supprimer le client <strong
                                                                class="text-danger">{{ $client->nom }}</strong>?

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>
                                                            <form action="{{ route('providers.destroy', $client->id) }}"
                                                                method="Post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-primary">Confirmer</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End of creation modal --}}
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
<script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script>
<script>
    // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
</script>
<script>
    $(function() {

            $("#fname").hide();
            $("#entreprise").show();

            $(document).on("change", "#type_fournisseur", function() {
                var select = $(this).val();
                if (select == 'Entreprise') {
                    $("#fname").hide();
                    $("#entreprise").show();
                } else {
                    $("#fname").show();
                    $("#entreprise").hide();
                }
            });

            // drop down in responsive table
            $('.table-responsive').on('shown.bs.dropdown', function(e) {
                var $table = $(this).find('table'),
                    $menu = $(e.target).find('.dropdown-menu'),
                    tableOffsetHeight = $table.offset().top + $table.height(),
                    menuOffsetHeight = $menu.offset().top + $menu.outerHeight(true);

                if (menuOffsetHeight > tableOffsetHeight)
                    $table.css("padding-bottom", menuOffsetHeight - tableOffsetHeight);
            });

            $('.table-responsive').on('hide.bs.dropdown', function() {
                $(this).find('table').css("padding-bottom", 0);
            });



            $(document).on("click", ".delete-button", function() {
                var id = $(this).attr("idToDelete");
                $("#idToDel").val(id);
            });



            

        })
</script>
<script>
    $(function() {
           // init choices
           var choices = new Choices('.form-select-fournisseur', {
                      searchEnabled: true,
                      itemSelectText: '',
                  });
  
          $("#fname").hide();
          $("#entreprise").show();
          $("#persContact").show();
  
          $("#status_client").change(function() {
              var select = $(this).val();
              if (select == 'Entreprise') {
                  $("#fname").hide();
                  $("#entreprise").show();
                  $("#persContact").show();
              } else {
                  $("#fname").show();
                  $("#entreprise").hide();
                  $("#persContact").hide();
              }
          });
  
      })
</script>
@endsection
@section('script')
@endsection