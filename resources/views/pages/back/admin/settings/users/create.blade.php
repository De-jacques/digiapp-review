@extends('pages.back.admin.master', ['titre' => 'GESTION DES UTILISATEURS'])

@section('admin-content')
    <div class="card">
        <section id="basic-vertical-layouts">
            <div class="tab-content" id="nav-tabContent">
                <div class="m-3 mt-1">
                    <a class="btn btn-outline-secondary" href="{{ route('users.index') }}">
                        <i class="fa fa-arrow-left"> </i>
                        utilisateurs
                    </a>
                </div>
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                    tabindex="0">
                    <div class="tables">
                        <div>
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <div class="mb-0">
                                        <div class="">
                                            <div class="col-md-12">
                                                @if (Session::has('message'))
                                                    <div class="alert alert-success alert-dismissible fade show"
                                                        role="alert">
                                                        {{ Session::get('message') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <form class="form form-vertical" method="POST"
                                                action="{{ route('users.store') }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-md-12 col-12 mt-2">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="form-group col-md-4 mt-3">
                                                                <label for="name">Nom :</label>
                                                                <input type="text" id="name" class="form-control"
                                                                    name="name" placeholder="Nom" required>
                                                            </div>
                                                            <div class="form-group col-md-4 mt-3">
                                                                <label for="first_name">Prénom :</label>
                                                                <input type="text" id="first_name" class="form-control"
                                                                    name="first_name" placeholder="Prénom" required>
                                                            </div>
                                                            <div class="form-group col-md-4 mt-3">
                                                                <label for="email">Email :</label>
                                                                <input type="email" id="email" class="form-control"
                                                                    name="email" placeholder="Email" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-4 mt-3">
                                                                <label for="poste">Poste :</label>
                                                                <input type="text" id="poste" class="form-control"
                                                                    name="poste" placeholder="Poste">
                                                            </div>
                                                            <div class="form-group col-md-4 mt-3">
                                                                <label for="departement">Département :</label>
                                                                <input type="text" id="departement" class="form-control"
                                                                    name="departement" placeholder="Département">
                                                            </div>
                                                            <div class="form-group col-md-4 mt-3">
                                                                <label for="matricule">Matricule :</label>
                                                                <input type="text" id="matricule" class="form-control"
                                                                    name="matricule" placeholder="Matricule">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-4 mt-3">
                                                                <label for="date_naissance">Date de naissance :</label>
                                                                <input type="date" id="date_naissance"
                                                                    class="form-control" name="date_naissance"
                                                                    placeholder="Date de naissance">
                                                            </div>
                                                            <div class="form-group col-md-4 mt-3">
                                                                <label for="lieu_naissance">Lieu de naissance :</label>
                                                                <input type="text" id="lieu_naissance"
                                                                    class="form-control" name="lieu_naissance"
                                                                    placeholder="Lieu de naissance">
                                                            </div>
                                                            <div class="form-group col-md-4 mt-3">
                                                                <label for="contact">Contact :</label>
                                                                <input type="tel" id="contact" class="form-control"
                                                                    name="contact" placeholder="Contact">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-4 mt-3">
                                                                <label for="photo">Photo :</label>
                                                                <input type="file" id="photo" class="form-control"
                                                                    name="photo">
                                                            </div>
                                                            <div class="form-group col-md-4 mt-3">
                                                                <label for="commune">Commune :</label>
                                                                <input type="text" id="commune" class="form-control"
                                                                    name="commune" placeholder="Commune">
                                                            </div>
                                                            <div class="form-group col-md-4 mt-3">
                                                                <label for="quartier">Quartier :</label>
                                                                <input type="text" id="quartier" class="form-control"
                                                                    name="quartier" placeholder="Quartier">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            {{-- <div class="form-group col-md-4 mt-3">
                                                                <label for="ville">Ville :</label>
                                                                <input type="text" id="ville" class="form-control"
                                                                    name="ville" placeholder="Ville">
                                                            </div> --}}

                                                            <div class="form-group col-md-4 mt-3">
                                                                <label for="ville">Ville :</label>
                                                                <select id="ville"
                                                                    class="form-control text-capitalize form-select-ville"
                                                                    name="ville">
                                                                    <option value="">Sélectionnez une ville</option>
                                                                    <option value="Abengourou">Abengourou</option>
                                                                    <option value="Abidjan">Abidjan</option>
                                                                    <option value="Aboisso">Aboisso</option>
                                                                    <option value="Adiaké">Adiaké</option>
                                                                    <option value="Adzopé">Adzopé</option>
                                                                    <option value="Agboville">Agboville</option>
                                                                    <option value="Akoupé">Akoupé</option>
                                                                    <option value="Anyama">Anyama</option>
                                                                    <option value="Bangolo">Bangolo</option>
                                                                    <option value="Beoumi">Beoumi</option>
                                                                    <option value="Biankouma">Biankouma</option>
                                                                    <option value="Bingerville">Bingerville</option>
                                                                    <option value="Bondoukou">Bondoukou</option>
                                                                    <option value="Bongouanou">Bongouanou</option>
                                                                    <option value="Bouaflé">Bouaflé</option>
                                                                    <option value="Bouaké">Bouaké</option>
                                                                    <option value="Boundiali">Boundiali</option>
                                                                    <option value="Dabou">Dabou</option>
                                                                    <option value="Daloa">Daloa</option>
                                                                    <option value="Danané">Danané</option>
                                                                    <option value="Daoukro">Daoukro</option>
                                                                    <option value="Dimbokro">Dimbokro</option>
                                                                    <option value="Divo">Divo</option>
                                                                    <option value="Duékoué">Duékoué</option>
                                                                    <option value="Ferkessédougou">Ferkessédougou</option>
                                                                    <option value="Gagnoa">Gagnoa</option>
                                                                    <option value="Grand-Bassam">Grand-Bassam</option>
                                                                    <option value="Grand-Lahou">Grand-Lahou</option>
                                                                    <option value="Guiglo">Guiglo</option>
                                                                    <option value="Issia">Issia</option>
                                                                    <option value="Jacqueville">Jacqueville</option>
                                                                    <option value="Katiola">Katiola</option>
                                                                    <option value="Korhogo">Korhogo</option>
                                                                    <option value="Lakota">Lakota</option>
                                                                    <option value="Man">Man</option>
                                                                    <option value="Mankono">Mankono</option>
                                                                    <option value="Minignan">Minignan</option>
                                                                    <option value="Odienné">Odienné</option>
                                                                    <option value="Oumé">Oumé</option>
                                                                    <option value="Sakassou">Sakassou</option>
                                                                    <option value="San-Pédro">San-Pédro</option>
                                                                    <option value="Sassandra">Sassandra</option>
                                                                    <option value="Séguéla">Séguéla</option>
                                                                    <option value="Sinfra">Sinfra</option>
                                                                    <option value="Soubré">Soubré</option>
                                                                    <option value="Taabo">Taabo</option>
                                                                    <option value="Tanda">Tanda</option>
                                                                    <option value="Tiassalé">Tiassalé</option>
                                                                    <option value="Tingréla">Tingréla</option>
                                                                    <option value="Touba">Touba</option>
                                                                    <option value="Toumodi">Toumodi</option>
                                                                    <option value="Vavoua">Vavoua</option>
                                                                    <option value="Yamoussoukro">Yamoussoukro</option>
                                                                    <option value="Zuénoula">Zuénoula</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4 mt-3 ">
                                                                <label for="sexe">Sexe :</label>
                                                                <select id="sexe"
                                                                    class="form-control form-select-sexe" name="sexe">
                                                                    <option value="masculin">Masculin</option>
                                                                    <option value="feminin">Féminin</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4 mt-3">
                                                                <label for="role">Rôle :</label>
                                                                <select id="role"
                                                                    class="form-control text-capitalize form-select-role"
                                                                    name="role">
                                                                    <option value="commercial">Commercial</option>
                                                                    <option value="stock">Stock</option>
                                                                    <option value="comptabilite">Comptabilite</option>
                                                                    <option value="reseau">Reseau</option>
                                                                    <option value="programmation">Programmation</option>
                                                                    <option value="secretariat">Secretariat</option>
                                                                    <option value="rh">Rh</option>
                                                                    <option value="admin">Admin</option>
                                                                    <option value="super_admin">Super
                                                                        Admin</option>
                                                                </select>
                                                            </div>
                                                            {{-- <div {{-- <div class="form-group col-md-4 mt-3">
                                                            <label for="identifiant_credit_acces">Identifiant crédit
                                                                accès :</label>
                                                            <input type="text" id="identifiant_credit_acces"
                                                                class="form-control" name="identifiant_credit_acces"
                                                                placeholder="Identifiant crédit accès">
                                                        </div> --}}
                                                        </div>
                                                        <div class="mt-5 row">
                                                            <div class="form-group col-md-6 mt-3">
                                                                <label for="signature">Signature :</label>
                                                                <input type="file" id="signature" class="form-control"
                                                                    name="signature">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-between mt-4">
                                                    <button type="reset" class="btn btn-danger me-1 mb-1"
                                                        style="padding-left: 5%; padding-right: 5%;">Annuler</button>
                                                    <button type="submit" class="btn btn-success me-1 mb-1"
                                                        style="padding-left: 5%; padding-right: 5%;">Enregistrer</button>
                                                </div>
                                            </form>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
    <script>
        $(function() {
            var choices = new Choices('.form-select-role', {
                searchEnabled: true,
                itemSelectText: '',
            });
            var choices = new Choices('.form-select-sexe', {
                searchEnabled: true,
                itemSelectText: '',
            });

            var choices = new Choices('.form-select-ville', {
                searchEnabled: true,
                itemSelectText: '',
            });
        })
    </script>
@endsection
