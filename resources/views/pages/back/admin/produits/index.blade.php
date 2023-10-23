@extends('pages.back.admin.master', ['titre' => 'GESTION DES PRODUITS'])

@section('admin-content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css" />
    <section class="py-0">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                tabindex="0">
                <div class="tables">
                    <div class="">
                        <div class="row gy-4">
                            <div class="col-md-12">
                                <div class="card mb-0">

                                    <div>
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

                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                            aria-labelledby="pills-home-tab">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('produits.create') }}">
                                                        <button type="button"
                                                            class="btn btn-outline-primary newProduct mb-3 ">
                                                            <i class="fa fa-plus"></i> Produit
                                                        </button>
                                                    </a>
                                                    {{--
                                                <a href="{{route('produits.importer')}}">
                                                    <button type="button" class="btn btn-outline-success  mb-3 ">
                                                        <i class="fa fa-upload"></i>
                                                    </button>
                                                </a> --}}
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table mb-0  table-hover display" id="produitTable">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Ref</th>
                                                                <th>Désignation</th>
                                                                <th>Quantite</th>
                                                                <th>Prix public</th>
                                                                <th>Prix Goov</th>
                                                                <th>Catégorie</th>

                                                                <th>
                                                                    <select class="form-select-entrepot form-select"
                                                                        id="entrepot_id">
                                                                        <option value="" selected disabled>
                                                                            Entrepot
                                                                        </option>
                                                                        <!-- Vos options d'entrepôt ici -->
                                                                    </select>
                                                                </th>

                                                                <th>
                                                                    Actions
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @isset($produits)
                                                                @php
                                                                    $i = 01;
                                                                @endphp
                                                                @foreach ($produits as $produit)
                                                                    <tr data-produit-id="{{ $produit->id }}">

                                                                        <td>{{ $i }}</td>
                                                                        <td>{{ $produit->ref }}</td>
                                                                        <td>{{ $produit->designation }}</td>
                                                                        <td>
                                                                            {{ $produit->getQte($produit->id) }}
                                                                        </td>
                                                                        {{-- <td>{{ $stock->getQte($produit->id) }}</td> --}}
                                                                        <td>{{ number_format($produit->prix_vente, 0, ',', ' ') }}
                                                                        </td>
                                                                        <td>{{ number_format($produit->prix_goov, 0, ',', ' ') }}
                                                                        </td>
                                                                        <td>{{ $produit->sous_categorie($produit->sub_category_id) }}
                                                                        </td>

                                                                        <td id="quantite_entrepot_{{ $loop->index }}">
                                                                            <!-- Cellule de quantité -->
                                                                        </td>

                                                                        <td>
                                                                            <a href="" type="button"
                                                                                class="btn btn-outline-warning"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#info{{ $produit->id }}">
                                                                                <i class="fa fa-eye"></i>
                                                                            </a>
                                                                            {{-- <a href="{{route('produits.edit', $produit->id)}}"
                                                                    type="button" class="btn btn-outline-primary">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                                <a href="" type="button" class="btn btn-outline-danger"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete{{$produit->id}}">
                                                                    <i class="fa fa-trash"></i>
                                                                </a> --}}

                                                                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin')
                                                                                <a href="{{ route('produits.edit', $produit->id) }}"
                                                                                    type="button"
                                                                                    class="btn btn-outline-primary">
                                                                                    <i class="fa fa-pencil"></i>
                                                                                </a>
                                                                            @endif

                                                                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin')
                                                                                <a href="" type="button"
                                                                                    class="btn btn-outline-danger"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#delete{{ $produit->id }}">
                                                                                    <i class="fa fa-trash"></i>
                                                                                </a>
                                                                            @endif

                                                                        </td>
                                                                        @php
                                                                            $i++;
                                                                        @endphp
                                                                    </tr>

                                                                    {{-- {{$i++}} --}}
                                                                    {{-- Show produit --}}
                                                                    <div class="modal-info me-1 mb-1 d-inline-block">
                                                                        <!--warning theme Modal -->
                                                                        <div class="modal fade text-left"
                                                                            id="info{{ $produit->id }}" tabindex="-1"
                                                                            role="dialog" aria-labelledby="myModalLabel140"
                                                                            aria-hidden="true" data-bs-backdrop="static">
                                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                                                                                role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header bg-warning">
                                                                                        <h5 class="modal-title white"
                                                                                            id="myModalLabel140">
                                                                                            <i class="bi bi-border-width"></i>
                                                                                            Détails
                                                                                            sur le produit
                                                                                        </h5>
                                                                                        <button type="button" class="close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                            <i data-feather="x"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body"
                                                                                        style="font-weight:bold">
                                                                                        <form class="form-horizontal">
                                                                                            @csrf
                                                                                            @method('PATCH')
                                                                                            <div
                                                                                                class="form-control-group mt-5 mb-4">
                                                                                                <div class="row">
                                                                                                    <div
                                                                                                        class="form-control-group col-md-4 mb-3">
                                                                                                        <label>Designation</label>
                                                                                                        <input
                                                                                                            class="form-control"
                                                                                                            type="text"
                                                                                                            value="{{ old('designation') ?? $produit->designation }}"
                                                                                                            readonly />
                                                                                                    </div>

                                                                                                </div>

                                                                                                <div class="row">
                                                                                                    <div
                                                                                                        class="form-control-group col-md-4 mb-3">
                                                                                                        <label
                                                                                                            for="email">Prix
                                                                                                            de
                                                                                                            revient</label>
                                                                                                        <input
                                                                                                            class="form-control"
                                                                                                            type="text"
                                                                                                            value="{{ old('prix_revient') ?? $produit->prix_revient }}"
                                                                                                            readonly />
                                                                                                    </div>
                                                                                                    @if (isset($produit->marge))
                                                                                                        <div
                                                                                                            class="form-control-group col-md-4 mb-3">
                                                                                                            <label>Marge</label>
                                                                                                            <input
                                                                                                                class="form-control"
                                                                                                                type="text"
                                                                                                                value="{{ old('marge') ?? $produit->marge }}"
                                                                                                                readonly />
                                                                                                        </div>
                                                                                                    @endif
                                                                                                    <div
                                                                                                        class="form-control-group col-md-4 mb-3">
                                                                                                        <label>Prix de
                                                                                                            vente</label>
                                                                                                        <input
                                                                                                            class="form-control"
                                                                                                            type="text"
                                                                                                            value="{{ old('prix_vente') ?? $produit->prix_vente }}"
                                                                                                            readonly />
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div
                                                                                                        class="form-control-group col-md-4 mb-3">
                                                                                                        <label
                                                                                                            for="type">Categorie</label>
                                                                                                        <input
                                                                                                            class="form-control"
                                                                                                            id="type"
                                                                                                            type="text"
                                                                                                            name="type"
                                                                                                            value="{{ old('sub_category_id') ?? $produit->sous_categorie($produit->sub_category_id) }}"
                                                                                                            readonly />
                                                                                                    </div>
                                                                                                    @if (isset($produit->marque_id))
                                                                                                        <div
                                                                                                            class="form-control-group col-md-4 mb-3">
                                                                                                            <label
                                                                                                                for="type">Marque</label>
                                                                                                            <input
                                                                                                                class="form-control"
                                                                                                                id="type"
                                                                                                                type="text"
                                                                                                                name="type"
                                                                                                                value="{{ old('marque_id') ?? $produit->marque($produit->marque_id) }}"
                                                                                                                readonly />
                                                                                                        </div>
                                                                                                    @endif

                                                                                                </div>
                                                                                                <div
                                                                                                    class="form-control-group col-md-12 mb-3 ">
                                                                                                    <label
                                                                                                        for="description">Description</label>
                                                                                                    <textarea class="form-control ckeditor" id="description{{ $produit->id }}" rows="30" readonly>
                                                                                                {{ old('description') ?? $produit->description }}
                                                                                            </textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>

                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-bs-dismiss="modal">
                                                                                            <i
                                                                                                class="bx bx-x d-block d-sm-none"></i>
                                                                                            <span
                                                                                                class="d-none d-sm-block">Fermer</span>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Suppression Modal -->
                                                                    <div class="modal fade" id="delete{{ $produit->id }}"
                                                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                                                        tabindex="-1" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="deleteLabel">
                                                                                        Demande
                                                                                        de
                                                                                        confirmation</h5>
                                                                                    <button type="button" class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    Voulez-vous vraiment supprimer la catégorie
                                                                                    <strong
                                                                                        class="text-danger">{{ $produit->designation }}</strong>?

                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">Annuler</button>

                                                                                    <form
                                                                                        action="{{ route('produits.destroy', $produit->id) }}"
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
                                        {{-- Produit end --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--
<script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('jquery.js') }}"></script>
    {{-- <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script> --}}

    <script>
        getEntrepots();

        $(".newProduct").click(function() {
            resetCategoryForm();
            resetMarqueForm();

            getCategories();
            getMarques();


        });
        // function to getcategories
        function getCategories() {
            @foreach ($sousCat as $category)
                $('#category').append(
                    '<option value="{{ $category->id }}">{{ $category->name }}</option>');
            @endforeach

            var choices = new Choices('.form-select-categorie', {
                searchEnabled: true,
                itemSelectText: '',
            });
        }


        // function to marques
        function getEntrepots() {
            @foreach ($entrepots as $category)
                $('#entrepot_id').append(
                    '<option value="{{ $category->id }}">{{ $category->name }}</option>');
            @endforeach

            var choices = new Choices('#entrepot_id', {
                searchEnabled: true,
                itemSelectText: '',
            });

        }

        function getMarques() {
            @foreach ($marques as $category)
                $('#marque').append(
                    '<option value="{{ $category->id }}">{{ $category->name }}</option>');
            @endforeach

            var choices = new Choices('.form-select-marque', {
                searchEnabled: true,
                itemSelectText: '',
            });

        }

        // function to getcategorie
        function getCategory() {
            @foreach ($categories as $category)
                $('#categoryUpdate').append(
                    '<option value="{{ $category->id }}">{{ $category->libelle }}</option>');
            @endforeach
        }

        function resetCategory() {
            $('#categoryUpdateForm').empty();
            $("#categoryUpdateForm").html(
                '<select class="form-select-categorie-update" name="categorie" id="categoryUpdate"> </select>'
            );

        }

        function resetMarque() {
            $('#marqueUpdateForm').empty();
            $("#marqueUpdateForm").html(
                '<select class="form-select-marque-update" name="marque" id="marqueUpdate"> <option value="">~~Sélectionner marque~~</option> </select>'
            );
        }


        function resetCategoryForm() {
            $('#category').empty();
            $("#category").html(
                '<select class="form-select-categorie" name="categorie" id="category"> <option value="">~~Sélectionner categorie~~</option> </select>'
            );

        }

        function resetMarqueForm() {
            $('#marque').empty();
            $("#marque").html(
                '<select class="form-select-marque" name="marque" id="marque"> <option value="">~~Sélectionner marque~~</option> </select>'
            );
        }


        // function to getcategory
        function getMarque() {
            @foreach ($marques as $category)
                $('#marqueUpdate').append(
                    '<option value="{{ $category->id }}">{{ $category->libelle }}</option>');
            @endforeach
        }
        let text = $("#categoryUpdate").find('option:selected').text();

        // if text lowercase is equal to 'service'
        if ($.trim(text.toLowerCase()) === 'service') {
            console.log('service ..... ');
            $("#marque-element").val('').hide();
            $("#prix_revient").val(0).attr('readonly', true);
            $("#prix_vente").val(0).attr('readonly', true);
            // $("#quantite").val(1).attr('readonly', true);
        }
        // on change category
        $(document).on("change", '#category', function() {

            let text = $(this).find('option:selected').text();

            // if text lowercase is equal to 'service'
            if ($.trim(text.toLowerCase()) === 'service') {
                console.log('service ..... ');
                $("#marque-element").val('').hide();
                $("#prix_revient").val('').hide();
                $("#prix_vente").val('').hide();
                // $("#quantite_section").val('').hide();
                $("#marge-section").val('').hide();
                // $("#entrepot").val('').hide();
                $("#prix_achat").val('').hide();
                // $("#prix_revient").val(0).attr('readonly', true);
                // $("#prix_vente").val(0).attr('readonly', true);
                // $("#quantite").val(1).attr('readonly', true);
            } else {
                $("#marque-element").show();
                $("#prix_revient").show();
                $("#prix_vente").show();
                // $("#quantite_section").show();
                $("#marge-section").show();
                // $("#entrepot").show();
                $("#prix_achat").show();
                // $("#prix_revient").val(0).attr('readonly', false);
                // $("#prix_vente").val(0).attr('readonly', false);
                // $("#quantite").val(1).attr('readonly', false);
            }

        });
    </script>
    {{-- var produit_id = $("#produit_id").val(); --}}

    <script>
        $(document).ready(function() {
            $('#entrepot_id').on('change', function() {
                var entrepot_id = $(this).val();
                var rowCount = $('tbody tr').length;

                $('tbody tr').each(function() {
                    var produitId = $(this).data('produit-id');
                    var quantiteCell = $(this).find('td[id^="quantite_entrepot_"]');

                    $.ajax({
                        url: '/quantite-entrepot/' + entrepot_id + '/' + produitId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            quantiteCell.text(response.quantite);
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                });
            });
        });
    </script>
    {{-- <script src="{{ asset('js/datatable-jquery.js') }}"></script> --}}
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Initialisation de CKEditor pour tous les champs ayant la classe ckeditor
            $('.ckeditor').ckeditor();

            // Extraction du texte brut du champ de texte CKEditor
            var descriptionContent = CKEDITOR.instances['description{{ $produit->id }}'].getData();
            var descriptionPlainText = extractPlainText(descriptionContent);
            console.log(descriptionPlainText);
        });
    </script>
    {{--
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();

    });

</script> --}}
@endsection
