@extends('pages.back.admin.master', ['titre' => 'ÉDITION DE PRODUIT'])
@section('admin-content')
    <!-- Form Elements -->
    <div class="card">
        <div class="p-3">
            <a class="btn btn-outline-primary" href="{{ route('produits.index') }}">
                <i class="fa fa-arrow-left"></i>
                Liste des produits </a>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" method="POST" action="{{ route('produits.update', $produit->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row match-height">
                        <div class="col-md-2">
                            <label for="reference">Reference</label>
                            <input type="text" id="reference" class="form-control" placeholder="Reference" name="ref"
                                value="{{ $produit->ref }}">
                        </div>
                        <div class="col-md-3" id="designation-section">
                            <label for="designation">Désignation(
                                <span class="text-danger"> *</span>
                                )</label>
                            <input type="text" id="designation" class="form-control" name="designation"
                                placeholder="Designation" value="{{ $produit->designation }}">
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="categorie">Catégories </label>
                                            <div class="form-group">
                                                <select class="form-select-categorie form-control" name="sub_category_id"
                                                    id="categorie">
                                                    <option selected disabled>votre catégorie</option>
                                                    @foreach ($sousCat as $category)
                                                        <option value="{{ $category->id }}"
                                                            @if ($produit->sub_category_id == $category->id) selected @endif>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="marques">Marques </label>
                                            <div class="form-group">
                                                <select class="form-select-marque form-control" name="marque_id"
                                                    id="marque">
                                                    <option selected disabled>votre marque</option>
                                                    @foreach ($marques as $marque)
                                                        <option value="{{ $marque->id }}"
                                                            @if ($produit->marque_id == $marque->id) selected @endif>
                                                            {{ $marque->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 row">
                            <label for="first-name-vertical">Prix de revient</label>
                            <input type="number" id="first-name-vertical" class="form-control" name="prix_revient"
                                placeholder="Nombre à saisir" value="{{ $produit->prix_revient }}">
                        </div>
                        <div class="row mt-5">
                            <div class="form-floating">
                                <textarea class="form-control ckeditor" name="description" placeholder="Description du produit" style="height: 250px">{{ $produit->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-5">
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script>
    <script>
        $(function() {
            var test = $('#categorie').find('option:selected').text();
            console.log(test);

            // init choices
            getMarques();
            getCategories();

            // on change category
            $(document).on("change", '#categorie', function() {
                let text = $(this).find('option:selected').text();
                if ($.trim(text.toLowerCase()) === 'service') {
                    $("#not-service-section").hide();
                    $('#categorie-section').removeClass("col-md-5");
                    $('#categorie-section').addClass("col-md-12");
                } else {
                    $("#not-service-section").show();
                    $('#categorie-section').removeClass("col-md-12");
                    $('#categorie-section').addClass("col-md-5");
                }
            });
        })

        function getMarques() {
            @foreach ($marques as $category)
                $('#marque').append('<option value="{{ $category->id }}">{{ $category->name }}</option>');
            @endforeach
            var choices = new Choices('.form-select-marque', {
                searchEnabled: true,
                itemSelectText: '',
            });
        }

        function getCategories() {
            var choices = new Choices('.form-select-categorie', {
                searchEnabled: true,
                itemSelectText: '',
            });
        }
    </script>
@endsection
