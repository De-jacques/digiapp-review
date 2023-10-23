@extends('pages.back.admin.master', ['titre' => 'ENREGISTRER UN PRODUIT'])

@section('style')
@endsection

@section('admin-content')
    <div class="card">
        <div class="p-3">
            <a class="btn btn-outline-primary" href="{{ route('produits.index') }}">
                <i class="fa fa-arrow-left"></i>
                produits </a>
        </div>
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
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" method="POST" action="{{ route('produits.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row match-height">
                        <div class="row  mt-4">
                            <div class="col-md-2">
                                <label for="reference">Reference:</label>

                                <input type="text" id="reference" class="form-control" placeholder="Reference"
                                    name="ref">
                            </div>
                            <div class="col-md-3" id="designation-section">
                                <label for="designation">Désignation(
                                    <span class="text-danger"> *</span>
                                    )</label>
                                <input type="text" id="designation" class="form-control" name="designation"
                                    placeholder="Designation" value="{{ old('designation') }}" required>
                            </div>
                            <div class="col-md-2 col-12" {{-- id="categorie-section" --}}>
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="categorie">Catégories : </label>
                                                <div class="form-group">
                                                    <select class="form-select-categorie form-control"
                                                        name="sub_category_id" id="categorie">
                                                        <option selected disabled>
                                                            votre catégorie
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-12" id="marque-section">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="marques">Marques : </label>
                                                <div class="form-group">
                                                    <select class="form-select-marque form-control" name="marque_id"
                                                        id="marque">
                                                        <option selected disabled>
                                                            votre marque
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 row" id="not-service-section">

                                <label for="first-name-vertical">Prix de revient:</label>
                                <input type="number" id="first-name-vertical" class="form-control" name="prix_revient"
                                    placeholder="Nombre à saisir" value="{{ old('prix_revient') }}">
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <div class="form-floating">

                                <textarea class="form-control ckeditor" name="description" placeholder="Description du produit" style="height: 250px"
                                    value="{{ old('description') }}"></textarea>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="col-12 d-flex justify-content-end mt-4" style="">
                <button type="submit" class="btn btn-success mb-5"
                    style="margin-left: 5%; margin-right: 5%;">Enregistrer</button>

            </div>
            </form>
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
                $('#marque').append(
                    '<option value="{{ $category->id }}">{{ $category->name }}</option>');
            @endforeach
            var choices = new Choices('.form-select-marque', {
                searchEnabled: true,
                itemSelectText: '',
            });
        }

        function getCategories() {
            @foreach ($sousCat as $category)
                $('#categorie').append(
                    '<option value="{{ $category->id }}">{{ $category->name }}</option>');
            @endforeach
            var choices = new Choices('.form-select-categorie', {
                searchEnabled: true,
                itemSelectText: '',
            });
        }
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection
