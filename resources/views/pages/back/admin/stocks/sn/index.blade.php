@extends('pages.back.admin.master', ['titre' => 'GESTION DES SN'])


@section('admin-content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css" />

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
            <div class="tables">
                <div class="">
                    <div class="col-md-12">
                        @if (Session::has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('message') }}
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
                    <div class="row gy-4">

                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">
                                        <div class="card-body">
                                            <a href="{{ route('stocks.entre') }}">
                                                <button type="button" class="btn btn-outline-primary newProduct mb-3 ">
                                                    <i class="fa fa-file"></i> Bons de reception
                                                </button>
                                            </a>
                                            <div class="table-responsive">
                                                <table class="table mb-0  table-hover display" id="tableData">
                                                    <thead>
                                                        <tr>
                                                            {{-- <th style="display: none">Id</th> --}}
                                                            <th>#</th>
                                                            <th>SN</th>
                                                            <th>Ref</th>
                                                            <th>Produit</th>
                                                            <th>Status</th>
                                                            <th>Fournisseur</th>
                                                            <th>Date entrée</th>
                                                            <th>N° BR</th>
                                                            <th>Date sortie</th>
                                                            <th>N° BL</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        @foreach ($snIterms as $item)
                                                            <tr>
                                                                <td>
                                                                    {{ $i }}
                                                                </td>
                                                                <td>
                                                                    {{ $item->serial_number }}
                                                                </td>
                                                                <td>
                                                                    {{ $item->ref($item->product_id) }}

                                                                </td>
                                                                <td>
                                                                    {{ $item->product->designation }}
                                                                </td>

                                                                <td>

                                                                    @if ($item->status == 'stock')
                                                                        <i class="fas fa-box-open text-success"
                                                                            title="En stock"></i>
                                                                        <span class="badge bg-success">En stock</span>
                                                                    @else
                                                                        <i class="fas fa-times-circle text-danger"
                                                                            title="Vendu"></i>
                                                                        <span class="badge bg-danger">Vendu</span>
                                                                    @endif
                                                                </td>

                                                                <td>
                                                                    @if ($item->supplier_id)
                                                                        {{ $item->supplier($item->supplier_id) }}
                                                                    @endif

                                                                </td>

                                                                <td>
                                                                    @if ($item->entree_id)
                                                                        {{ $item->entre_date($item->entree_id) }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->entree_id)
                                                                        {{ $item->num_facture($item->entree_id) }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->sortie_id)
                                                                        {{ $item->sortie_date($item->sortie_id) }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->sortie_id)
                                                                        {{ $item->num_bl($item->sortie_id) }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <?php $i++; ?>
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
    <style>
        .incomplete-sn-button {
            color: orangered;
            cursor: pointer;
            position: relative;
        }

        .incomplete-sn-button:hover::after {
            content: "incomplet";
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

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="{{ asset('jquery.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
@endsection
