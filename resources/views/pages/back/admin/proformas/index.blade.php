@extends('pages.back.admin.master', ['titre' => 'GESTION DES PROFORMAS'])
@section('admin-content')
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
            <div class="tables">
                <div>
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="text-center">
                                    <div class="col-md-12 d-flex justify-content-start px-2 py-3">
                                        <!-- Button trigger modal -->
                                        <a type="button" class="btn btn-outline-primary"
                                            href="{{ route('proformas.create') }}">
                                            <i class="fa fa-plus"></i> proforma
                                        </a>
                                    </div>
                                </div>
                                <div>
                                    @if (Session::has('message'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ Session::get('message') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif

                                    @if (Session::has('probleme'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ Session::get('probleme') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (Session::has('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ Session::get('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0  table-hover display" id="proTable">
                                            <thead>
                                                <tr class="">
                                                    <th style="display: none">Id</th>
                                                    <th>Référence</th>
                                                    <th>Client</th>
                                                    <th>Total HT</th>
                                                    <th>Total TTC</th>
                                                    <th>Fait le</th>
                                                    <th class="text-center">
                                                        Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @isset($proformas)
                                                    @foreach ($proformas as $proforma)
                                                        <tr>
                                                            <td style="display: none">{{ $proforma->id }}</td>
                                                            @if ($proforma->ref_proforma == null)
                                                                <td>...</td>
                                                            @else
                                                                <td>{{ $proforma->ref_proforma }}</td>
                                                            @endif
                                                            <td>{{ $proforma->getClient($proforma->customer_id) }}</td>
                                                            <td>
                                                                {{ number_format($proforma->total_ht, 0, ',', ' ') }}

                                                            </td>
                                                            <td>
                                                                {{ number_format($proforma->total, 0, ',', ' ') }}

                                                            <td>{{ date('d-m-y H:i', strtotime($proforma->created_at)) }}</td>
                                                            <td class="text-center">
                                                                <a href="{{ route('imprimer', $proforma->ref_proforma) }}"
                                                                    target="_blank" type="button"
                                                                    class="btn btn-outline-primary">
                                                                    <i class="fa fa-print"></i>
                                                                </a>
                                                                {{-- <a href="#
                                                 {{ route('regenerer', $proforma->ref_proforma) }} 
                                                    " type="button" class="btn btn-outline-success">
                                                        <i class="fa fa-repeat"></i>
                                                    </a> --}}
                                                                @if (Auth::user()->role == 'commercial' || Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin')
                                                                    <a href="{{ route('proformas.edit', $proforma->ref_proforma) }}"
                                                                        type="button" class="btn btn-outline-warning">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>
                                                                @endif
                                                                <a href="{{ route('sendMail', $proforma->ref_proforma) }}"
                                                                    type="button" class="btn btn-outline-dark">
                                                                    <i class="fa fa-envelope"></i>
                                                                </a>
                                                                @if (Auth::user()->role == 'commercial' || Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin')
                                                                    <a href="" type="button"
                                                                        class="btn btn-outline-danger" data-bs-toggle="modal"
                                                                        data-bs-target="#delete{{ $proforma->id }}">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>

                                                        <!-- EDITION Modal -->
                                                        <div class="modal fade" id="edition{{ $proforma->id }}"
                                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editionLabel">
                                                                            Edition de proforma {{ $proforma->id }}
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <a type="button" href="" data-bs-toggle="modal"
                                                                            data-bs-target="#informations{{ $proforma->id }}"
                                                                            class="btn btn-secondary col-md-12"
                                                                            data-bs-dismiss="modal">
                                                                            Editer les informations de la proforma
                                                                        </a>
                                                                        <a type="submit" class="btn btn-primary col-md-12 mt-3"
                                                                            href="{{ route('proformas.edit', [$proforma->ref_proforma]) }}">
                                                                            Editer les produits de la proforma
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- End of sufssion modal --}}


                                                        <!-- Suppression Modal -->
                                                        <div class="modal fade" id="delete{{ $proforma->id }}"
                                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="deleteLabel">Demande de
                                                                            confirmation</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Voulez-vous vraiment supprimer le proforma de <strong
                                                                            class="text-danger">{{ $proforma->getClient($proforma->customer_id) }}</strong>
                                                                        du <strong
                                                                            class="text-danger">{{ date('d-m-y H:i', strtotime($proforma->created_at)) }}</strong>
                                                                        ?

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Annuler</button>
                                                                        <form
                                                                            action="{{ route('proformas.destroy', $proforma->id) }}"
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
                                                        {{-- End of supression modal --}}
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
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

@endsection
@section('script')
@endsection
