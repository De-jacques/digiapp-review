@extends('pages.back.admin.master', ['titre' => 'GESTION DES CATEGORIES'])

@section('admin-content')
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
        <div class="tables">
            <div>
                <div class="row gy-4">
                    <div class="col-md-12">
                        <div class="card mb-0">
                            <div class="text-center">
                                <div class="col-md-12 px-2 py-3">
                                    <!-- Button trigger modal -->
                                    <div class="d-flex justify-content-between">

                                        <a href="{{route('sub_categories.index')}}" class="btn btn-outline-primary">
                                            <i class="fa fa-list"> </i> Sous catégories
                                        </a>

                                        <button type="button" class="btn btn-outline-primary mx-2"
                                            data-bs-toggle="modal" data-bs-target="#static">
                                            <i class="fa fa-plus"></i> Catégorie
                                        </button>

                                    </div>
                                    <!-- Creation Modal -->
                                    <div class="modal fade" id="static" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog  modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticLabel">ENREGISTREMENT D'UNE
                                                        NOUVELLE CATEGORIE</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal"
                                                        action="{{ route('categories.store') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-control-group mb-4">
                                                            <div class="form-control-group col-md-12 mb-3">
                                                                <input class="form-control" id="name" type="text"
                                                                    name="name" placeholder="Nom *" required
                                                                    autocomplete />
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
                                </div>
                            </div>
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
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0  table-hover display" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Inscrit le</th>
                                                <th>
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($categories)
                                            @foreach ($categories as $categorie)
                                            <tr>
                                                <td>{{ $categorie->name }}</td>
                                                <td>{{ date('d-m-y H:i', strtotime($categorie->created_at)) }}</td>
                                                <td>
                                                    <a href="" type="button" class="btn btn-outline-warning"
                                                        data-bs-toggle="modal" data-bs-target="#view{{$categorie->id}}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    @if (Auth::user()->role == "admin" ||
                                                    Auth::user()->role == "super_admin")
                                                    <a href="" type="button" class="btn btn-outline-primary"
                                                        data-bs-toggle="modal" data-bs-target="#edit{{$categorie->id}}">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="" type="button" class="btn btn-outline-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{$categorie->id}}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <!-- Viewer Modal -->
                                            <div class="modal fade" id="view{{$categorie->id}}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-hidden="true">
                                                <div
                                                    class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editLabel">Visualisation de
                                                                {{$categorie->name}}</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal">
                                                                <p class="description">Catégorie</p>
                                                                <div class="form-control-group mb-4">
                                                                    <div class="form-control-group col-auto mb-3">
                                                                        <input class="form-control" id="name"
                                                                            type="text" name="name" placeholder="Nom *"
                                                                            required autocomplete
                                                                            value="{{old('name') ?? $categorie->name }}"
                                                                            readonly />
                                                                    </div>
                                                                </div>

                                                                <div class="form-control-group mb-4">
                                                                    <p class="description text-success">Sous Catégories associées</p>
                                                                    @foreach ($categorie->sous_categories($categorie->id) as $sub)
                                                                        <div class="form-control-group col-auto mb-3">
                                                                            <input class="form-control" id="name" type="text" name="name" placeholder="Nom *"
                                                                                required autocomplete value="{{ $sub->name }}" readonly />
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                

                                                                <button type="button"
                                                                    class="btn btn-secondary d-flex justify-content-center"
                                                                    data-bs-dismiss="modal">Fermer</button>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End of viewer modal --}}
                                            <!-- Edition Modal -->
                                            <div class="modal fade" id="edit{{$categorie->id}}" data-bs-backdrop="edit"
                                                data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editLabel">Modification de
                                                                {{$categorie->name}}</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal"
                                                                action="{{route('categories.update', $categorie->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <div class="form-control-group mb-4">
                                                                    <div class="form-control-group col-auto mb-3">
                                                                        <input class="form-control" id="name"
                                                                            type="text" name="name" placeholder="Nom *"
                                                                            required autocomplete
                                                                            value="{{old('name') ?? $categorie->name }}" />
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Fermer</button>
                                                                <button class="btn btn-success" type="submit">
                                                                    Enregistrer</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End of creation modal --}}
                                            <!-- Suppression Modal -->
                                            <div class="modal fade" id="delete{{$categorie->id}}"
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
                                                            Voulez-vous vraiment supprimer la catégorie <strong
                                                                class="text-danger">{{$categorie->name}}</strong>?

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>

                                                            <form
                                                                action="{{route('categories.destroy',$categorie->id) }}"
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

<script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script>

<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
@endsection