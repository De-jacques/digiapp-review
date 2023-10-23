@extends('pages.back.admin.master', ['titre' => 'GESTION DES ENTREPOTS'])
@section('admin-content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css" />
<div class="tab-content" id="nav-tabContent">
    <div>
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
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
        <div class="tables">
            <div>
                <div class="row gy-4">
                    <div class="col-md-12">
                        <div class="card mb-0">
                            <div class="text-center">
                                <div class="col-md-12 d-flex justify-content-start px-2 py-3">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#static">
                                        <i class="fa fa-plus"></i> Ajouter un entrepot
                                    </button>
                                    <!-- Creation Modal -->
                                    <div class="modal fade" id="static" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticLabel">ENREGISTREMENT D'UN NOUVEL
                                                        ENTREPOT</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal"
                                                        action="{{ route('entrepots.store') }}" id="" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-control-group mb-4">
                                                            <div class="form-control-group col-auto mb-3">
                                                                <input class="form-control" id="name" type="text"
                                                                    name="name" placeholder="Nom *" required
                                                                    autocomplete>
                                                            </div>
                                                            <div class="form-control-group col-auto mb-3">
                                                                <input class="form-control" id="localisation"
                                                                    type="text" name="localisation"
                                                                    placeholder="Localisation *" required autocomplete>
                                                            </div>
                                                            <div class="form-control-group col-auto mb-3">
                                                                <input class="form-control" id="gerant" type="text"
                                                                    name="gerant" placeholder="gerant *" required
                                                                    autocomplete>
                                                            </div>
                                                            <div class="form-control-group col-auto mb-3">
                                                                <input class="form-control" id="contact" type="text"
                                                                    name="contact" placeholder="contact *" required
                                                                    autocomplete>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <input class="btn btn-danger" type="reset"
                                                            value="Réinitialiser" />
                                                        <input class="btn btn-success" type="submit"
                                                            value="Enregistrer" />
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End of creation modal --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0  table-hover display" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>Localisation</th>
                                                <th>Nom</th>
                                                <th>Gerant</th>
                                                <th>Contact</th>
                                                <th>Inscrit le</th>
                                                @if (Auth::user()->role === 'admin' || Auth::user()->role ===
                                                'super_admin')
                                                <th>
                                                    Actions
                                                </th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($entrepots)
                                            @foreach ($entrepots as $key => $entrepot)
                                            <tr>
                                                <td>{{ $entrepot->localisation }}</td>
                                                <td>{{ $entrepot->name }}</td>
                                                <td>{{ $entrepot->gerant }}</td>
                                                <td>{{ $entrepot->contact }}</td>
                                                <td>{{ date('d-m-y H:i', strtotime($entrepot->created_at)) }}</td>
                                                @if (Auth::user()->role === 'admin' || Auth::user()->role ===
                                                'super_admin')
                                                <td>
                                                    <form action="{{ route('entrepots.destroy', $entrepot->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="btn btn-outline-primary"
                                                            href="{{ route('entrepots.edit', $entrepot->id) }}">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <button type="submit" class="btn btn-outline-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                @endif
                                            </tr>
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
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

@endsection
@section('script')
@endsection