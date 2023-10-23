@extends('pages.back.admin.master', ['titre' => 'GESTION DES SOUS-CATEGORIES'])
@section('admin-content')

<div class="card mb-0">
    <div class="m-5 text-center">
        <div class="col-md-12 d-flex justify-content-between">
            <!-- Button trigger modal -->

            <a href="{{route('categories.index')}}" class="btn btn-outline-primary">
                <i class="fa fa-list"> </i> Catégories
            </a>

            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                data-bs-target="#create_sub_categorie">
                <i class="fa fa-plus"></i> Sous-catégorie
            </button>

            <!-- Creation Modal -->
            <div class="modal fade" id="create_sub_categorie" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticLabel">ENREGISTREMENT D'UNE
                                NOUVELLE SOUS CATEGORIE</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" action="{{ route('sub_categories.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-control-group col-md-6 mb-3">
                                            <input class="form-control" id="name" type="text" name="name"
                                                placeholder="Nom *" required autocomplete />
                                        </div>
                                        <div class="form-control-group col-md-6 mb-3">
                                            <select name="category_id" class="form-select-categorie form-control"
                                                id="categorie">
                                                <option selected disabled>
                                                    Selectionner votre catégorie
                                                </option>
                                                {{-- <option disabled selected> Veuillez
                                                    selectionner la catégorie</option>
                                                @foreach ($categories as $item)
                                                <option value="{{$item->id}}">{{$item->name}}
                                                </option>
                                                @endforeach --}}
                                            </select>
                                        </div>

                                        {{-- <select class="form-select-marque form-control" name="marque_id"
                                            id="marque">
                                            <option selected disabled>
                                                Selectionner votre marque
                                            </option>


                                        </select>

                                        function getMarques() {
                                        @foreach ($marques as $category)
                                        $('#marque').append(
                                        '<option value="{{ $category->id }}">{{ $category->name
                                            }}</option>');
                                        @endforeach

                                        var choices = new Choices('.form-select-marque', {
                                        searchEnabled: true,
                                        itemSelectText: '',
                                        });

                                        } --}}

                                    </div>
                                </div>
                                <div class="form-control-group mb-4">
                                    <input class="btn btn-danger" type="reset" value="Réinitialiser" />
                                    <button class="btn btn-success" type="submit">Enregistrer </button>
                                </div>
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
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{Session::get('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table mb-0  table-hover display" id="datatable">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Categorie</th>
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
                    {{-- {{dd($sub_categories[0]->getCategory($sub_categories[0]->category_id)
                    )}} --}}
                    @isset($sub_categories)
                    @foreach ($sub_categories as $sub_cat)
                    <tr>
                        <td>{{ $sub_cat->name }}</td>
                        <td>{{ $sub_cat->getCategoryName($sub_cat->category_id)}}</td>
                        <td>{{ date('d-m-y H:i', strtotime($sub_cat->created_at)) }}</td>
                        @if (Auth::user()->role == "admin" ||
                        Auth::user()->role == "super_admin")
                        <td>
                            <a href="" type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#edit{{$sub_cat->id}}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="" type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#delete{{$sub_cat->id}}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                        @endif
                    </tr>

                    <!-- Edition Modal -->
                    <div class="modal fade" id="edit{{$sub_cat->id}}" data-bs-backdrop="edit" data-bs-keyboard="false"
                        tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editLabel">Modification de
                                        {{$sub_cat->name}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal"
                                        action="{{route('sub_categories.update', $sub_cat->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-control-group mb-4">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="form-control-group col-md-6 mb-3">
                                                        <input class="form-control" id="name" type="text" name="name"
                                                            placeholder="Nom *" required autocomplete
                                                            value="{{old('name') ?? $sub_cat->name }}" />
                                                    </div>
                                                    <div class="form-control-group col-md-6 mb-3">
                                                        <select name="category_id" class="form-select" id="">
                                                            <option disabled>Veuillez
                                                                selectionner la catégorie
                                                            </option>
                                                            @foreach ($categories as $iter)

                                                            <option value="{{$iter->id}}" {{ $iter->id ==
                                                                $sub_cat->category_id ?
                                                                'selected' : ''
                                                                }}>{{$iter->name}}</option>

                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
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
                    <div class="modal fade" id="delete{{$sub_cat->id}}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteLabel">Demande de
                                        confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous vraiment supprimer la catégorie <strong
                                        class="text-danger">{{$sub_cat->name}}</strong>?

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Annuler</button>

                                    <form
                                        action="{{route('sub_categories.destroy', ['sub_category' => $sub_cat->id]) }}"
                                        method="Post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary">Confirmer</button>
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
<script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script>
    $(function() {
        
         // init choices
         getCategories();



    })
    function getCategories() {
        @foreach ($categories as $category)
            $('#categorie').append(
                '<option value="{{ $category->id }}">{{ $category->name }}</option>');
        @endforeach

                var choices = new Choices('.form-select-categorie', {
                    searchEnabled: true,
                    itemSelectText: '',
                });

    }
</script>
@endsection