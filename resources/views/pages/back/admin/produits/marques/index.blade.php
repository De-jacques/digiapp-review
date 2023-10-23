@extends('pages.back.admin.master', ['titre' => 'GESTION DES MARQUES'])
@section('style')
<style>
</style>
@endsection
@section('admin-content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css" />
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
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#static">
                                        <i class="fa fa-plus"></i> Ajouter un marque
                                    </button>
                                    <!-- Creation Modal -->
                                    <div class="modal fade" id="static" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticLabel">ENREGISTREMENT D'UNE
                                                        NOUVELLE MARQUE</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" action="{{ route('marques.store') }}"
                                                        id="" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-control-group mb-4">
                                                            <div class="form-control-group col-auto mb-3">
                                                                <input class="form-control" id="name" type="text"
                                                                    name="name" placeholder="Nom *" required
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
                                <div>
                                    @if (Session::has('message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{Session::get('message')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    @endif
                                    @if (Session::has('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{Session::get('error')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    @endif
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-0  table-hover display" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nom</th>
                                                <th>Inscrit le</th>
                                                @if (Auth::user()->role == "admin" ||
                                                Auth::user()->role == "super_admin")
                                                <th>
                                                    Actions
                                                </th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($marques)
                                            @php
                                            $i = 1;
                                            @endphp
                                            @foreach ($marques as $key => $marque)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $marque->name }}</td>
                                                <td>{{ date('d-m-y H:i', strtotime($marque->created_at)) }}</td>
                                                @if (Auth::user()->role == "admin" ||
                                                Auth::user()->role == "super_admin")
                                                <td>
                                                    <a href="" type="button" class="btn btn-outline-primary"
                                                        data-bs-toggle="modal" data-bs-target="#edit{{$marque->id}}">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="" type="button" class="btn btn-outline-danger"
                                                        data-bs-toggle="modal" data-bs-target="#delete{{$marque->id}}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>


                                                </td>
                                                @endif
                                            </tr>
                                            <!-- Modif Modal -->
                                            <div class="modal fade" id="edit{{$marque->id}}" data-bs-backdrop="static"
                                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticLabel">MODIFICATION
                                                                D'UNE MARQUE</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal"
                                                                action="{{ route('marques.update',$marque->id) }}" id=""
                                                                method="POST" enctype="multipart/form-data">
                                                                @method('PUT')
                                                                @csrf
                                                                <div class="form-control-group mb-4">
                                                                    <div class="form-control-group col-auto mb-3">
                                                                        <input class="form-control" id="name"
                                                                            type="text" name="name"
                                                                            value="{{$marque->name}}">
                                                                    </div>
                                                                </div>

                                                                <input class="btn btn-danger" type="reset"
                                                                    value="Réinitialiser" />
                                                                <input class="btn btn-success" type="submit"
                                                                    value="Enregistrer" />
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End of Modif modal --}}
                                            <!-- Suppression Modal -->
                                            <div class="modal fade" id="delete{{$marque->id}}" data-bs-backdrop="static"
                                                data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteLabel">Demande de
                                                                confirmation</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Voulez-vous vraiment supprimer la catégorie <strong
                                                                class="text-danger">{{$marque->name}}</strong>?

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>

                                                            <form action="{{route('marques.destroy',$marque->id) }}"
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
                                            @php
                                            $i++
                                            @endphp
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