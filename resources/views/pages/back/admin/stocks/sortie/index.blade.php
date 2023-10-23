@extends('pages.back.admin.master', ['titre' => 'BON DE LIVRAISON'])


@section('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css" />
<style>
    .incomplete-sn-button {
        color: orangered;
        cursor: pointer;
        position: relative;
    }

    .incomplete-sn-button:hover::after {
        content: "S/N incomplet";
        visibility: visible;
        background-color: orangered;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        transform: translateX(-50%);
        opacity: 1;
        transition: opacity 0.3s;
    }
</style>
@endsection

@section('admin-content')
{{-- <section class="pb-0"> --}}
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
            tabindex="0">
            <div class="tables">
                <div class="">
                    <div class="col-md-12">
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
                    <div class="row gy-4">

                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">
                                        <div class="card-body">
                                            <a href="{{ route('sorties.create') }}">
                                                <button type="button" class="btn btn-outline-primary newProduct mb-3 ">
                                                    <i class="fa fa-plus"></i> Bon de livraison
                                                </button>
                                            </a>
                                            <div class="table-responsive">
                                                <table class="table mb-0  table-hover display" id="bonTable">
                                                    <thead>
                                                        <tr>
                                                            <th style="display:none">Id</th>
                                                            <th>Reférence sortie</th>
                                                            <th>Client</th>
                                                            {{-- <th>N° Facture</th> --}}
                                                            <th>Entrepot</th>
                                                            <th>Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($sorties as $item)
                                                        <tr>
                                                            <td style="display: none">
                                                                {{$item->id}}
                                                            </td>
                                                            <td>
                                                                {{$item->ref_sortie}}
                                                            </td>
                                                            <td>
                                                                {{$item->getCustomer($item->customer_id)}}
                                                            </td>
                                                            {{-- <td>
                                                                {{"Numéro facture"}}
                                                            </td> --}}
                                                            <td>
                                                                {{ $item->getEntrepotNom($item->entrepot_id)}}
                                                            </td>
                                                            <td>
                                                                {{ $item->date}}
                                                            </td>
                                                            <td>
                                                                {{-- <a
                                                                    href="{{ route('serial-number.edit', $item->ref_entree) }}"
                                                                    class="btn btn-outline-default {{ $item->isSnComplete($item->ref_entree) ? '' : 'incomplete-sn-button' }}">
                                                                    <i class="fa fa-chain"></i>
                                                                </a> --}}

                                                                <a href="{{ route('sortie.imprimer',$item->ref_sortie) }}"
                                                                    target="_blank" class="btn btn-outline-warning">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                                @if (Auth::user()->role == "admin" ||
                                                                Auth::user()->role == "super_admin")
                                                                <a href="" type="button" class="btn btn-outline-danger"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete{{$item->id}}">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                @endif

                                                                <!-- Modal -->
                                                                <div class="modal fade" id="delete{{$item->id}}"
                                                                    tabindex="-1"
                                                                    aria-labelledby="delete{{$item->id}}Label"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="delete{{$item->id}}Label">
                                                                                    Confirmation de suppression</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Êtes-vous sûr de vouloir supprimer cet
                                                                                élément ?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Annuler</button>
                                                                                <form
                                                                                    action="{{ route('sorties.destroy', $item->id) }}"
                                                                                    method="Post">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit"
                                                                                        class="btn btn-danger">Supprimer</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        {{-- @empty
                                                        <div class="pt-5">
                                                            <p colspan="8">Aucun bon d'entrée trouvé</p>
                                                        </div> --}}
                                                        {{-- @endforelse --}}
                                                        @endforeach
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
        </div>
    </div>
    {{--
</section> --}}

<script src="{{asset('jquery.js')}}"></script>
@endsection

@section('sccript')
<script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
{{-- <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script> --}}
@endsection