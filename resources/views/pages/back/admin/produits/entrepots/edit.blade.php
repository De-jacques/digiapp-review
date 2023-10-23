@extends('pages.back.admin.master', ['titre' => 'EDITION D\'ENTREPOT'])
@section('style')
<style>
</style>
@endsection
@section('admin-content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css" />
<div class="forms container-fluid mt-5">
    <div class="row">
        <!-- Form Elements -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 d-flex justify-content-start py-3">

                        </div>
                        <div class="col-md-4 d-flex justify-content-center py-3">

                        </div>

                    </div>
                    @if(\Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-all me-2"></i>
                        {!! \Session::get('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if(\Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-block-helper me-2"></i>
                        {!! \Session::get('error') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <form class="form-horizontal" action="{{ route('entrepots.update',$entrepot->id) }}" method="POST">
                        @csrf
                        @method("PATCH")
                        <div class="form-control-group row mb-4">
                            <div class="form-control-group col-md-3 mb-3">
                                <input class="form-control" id="name" type="text" name="name" placeholder="Nom *"
                                    value="{{old('name') ?? $entrepot->name }}" required autocomplete>
                            </div>
                            <div class="form-control-group col-md-3 mb-3">
                                <input class="form-control" id="localisation" type="text" name="localisation"
                                    placeholder="Localisation *"
                                    value="{{old('localisation') ?? $entrepot->localisation }}" required autocomplete>
                            </div>
                            <div class="form-control-group col-md-3 mb-3">
                                <input class="form-control" id="gerant" type="text" name="gerant"
                                    placeholder="Nom complet du gérant *"
                                    value="{{old('gerant') ?? $entrepot->gerant }}" required autocomplete>
                            </div>
                            <div class="form-control-group col-md-3 mb-3">
                                <input class="form-control" id="contact" type="text" name="contact"
                                    placeholder="contact *" value="{{old('contact') ?? $entrepot->contact }}" required
                                    autocomplete>
                            </div>
                        </div>
                        <input class="btn btn-success" type="submit" value="Enregistrer" />
                    </form>

                    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
                        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous">
                    </script>
                    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
                    <script>
                        $(document).ready(function() {
    $('#tableproduits').DataTable();
});
                    </script>
                    <script>
                        $('#tableproduits').DataTable({
    language: {
        processing: "Traitement en cours...",
        search: "Rechercher&nbsp;:",
        lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
        info: "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        infoEmpty: "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
        infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix: "",
        loadingRecords: "Chargement en cours...",
        zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable: "Aucune donnée disponible dans le tableau",
        paginate: {
            first: "Premier",
            previous: "Pr&eacute;c&eacute;dent",
            next: "Suivant",
            last: "Dernier"
        },
        aria: {
            sortAscending: ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }
    }
});
                    </script>


                </div>
            </div>
        </div>
        @endsection
        @section('script')
        @endsection