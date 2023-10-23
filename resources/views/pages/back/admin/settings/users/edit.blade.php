@extends('pages.back.admin.master', ['titre' => 'EDITION DES UTILISATEURS'])

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
                                                action="{{ route('users.update', $user->id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="col-md-12 col-12 mt-2">
                                                    <div class="form-body container">
                                                        <div class="row">
                                                            <div class="col-md-4 pt-5">
                                                                <div class="text-center">
                                                                    <div class="rounded-circle overflow-hidden"
                                                                        style="width: 250px; height: 250px;">
                                                                        <img src="{{ asset('storage/' . $user->photo) }}"
                                                                            alt="Photo de l'utilisateur" class="img-fluid"
                                                                            style="width: 100%; height: 100%; object-fit: cover;">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-8">

                                                                <div class="row">
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="name">Nom :</label>
                                                                        <input type="text" id="name"
                                                                            class="form-control" name="name"
                                                                            placeholder="Nom" value="{{ $user->name }}"
                                                                            required>
                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="first_name">Prénom :</label>
                                                                        <input type="text" id="first_name"
                                                                            class="form-control" name="first_name"
                                                                            placeholder="Prénom"
                                                                            value="{{ $user->first_name }}" required>
                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="email">Email :</label>
                                                                        <input type="email" id="email"
                                                                            class="form-control" name="email"
                                                                            placeholder="Email" value="{{ $user->email }}"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="poste">Poste :</label>
                                                                        <input type="text" id="poste"
                                                                            class="form-control" name="poste"
                                                                            placeholder="Poste" value="{{ $user->poste }}">
                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="departement">Département :</label>
                                                                        <input type="text" id="departement"
                                                                            class="form-control" name="departement"
                                                                            placeholder="Département"
                                                                            value="{{ $user->departement }}">
                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="matricule">Matricule :</label>
                                                                        <input type="text" id="matricule"
                                                                            class="form-control" name="matricule"
                                                                            placeholder="Matricule"
                                                                            value="{{ $user->matricule }}">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="date_naissance">Date de naissance
                                                                            :</label>
                                                                        <input type="date" id="date_naissance"
                                                                            class="form-control" name="date_naissance"
                                                                            placeholder="Date de naissance"
                                                                            value="{{ $user->date_naissance }}">
                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="lieu_naissance">Lieu de naissance
                                                                            :</label>
                                                                        <input type="text" id="lieu_naissance"
                                                                            class="form-control" name="lieu_naissance"
                                                                            placeholder="Lieu de naissance"
                                                                            value="{{ $user->lieu_naissance }}">
                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="contact">Contact :</label>
                                                                        <input type="tel" id="contact"
                                                                            class="form-control" name="contact"
                                                                            placeholder="Contact"
                                                                            value="{{ $user->contact }}">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="photo">Photo :</label>
                                                                        <input type="file" id="photo"
                                                                            class="form-control" name="photo">
                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="commune">Commune :</label>
                                                                        <input type="text" id="commune"
                                                                            class="form-control" name="commune"
                                                                            placeholder="Commune"
                                                                            value="{{ $user->commune }}">
                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="quartier">Quartier :</label>
                                                                        <input type="text" id="quartier"
                                                                            class="form-control" name="quartier"
                                                                            placeholder="Quartier"
                                                                            value="{{ $user->quartier }}">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="ville">Ville :</label>
                                                                        <select id="ville"
                                                                            class="form-control text-capitalize form-select-ville"
                                                                            name="ville">
                                                                            <option value="">Sélectionnez une ville
                                                                            </option>
                                                                            <option
                                                                                value="Abengourou"{{ $user->ville === 'Abengourou' ? 'selected' : '' }}>
                                                                                Abengourou</option>
                                                                            <option
                                                                                value="Abidjan"{{ $user->ville === 'Abidjan' ? 'selected' : '' }}>
                                                                                Abidjan</option>
                                                                            <option
                                                                                value="Aboisso"{{ $user->ville === 'Aboisso' ? 'selected' : '' }}>
                                                                                Aboisso</option>
                                                                            <option
                                                                                value="Adiaké"{{ $user->ville === 'Adiaké' ? 'selected' : '' }}>
                                                                                Adiaké</option>
                                                                            <option
                                                                                value="Adzopé"{{ $user->ville === 'Adzopé' ? 'selected' : '' }}>
                                                                                Adzopé</option>
                                                                            <option
                                                                                value="Agboville"{{ $user->ville === 'Agboville' ? 'selected' : '' }}>
                                                                                Agboville</option>
                                                                            <option
                                                                                value="Akoupé"{{ $user->ville === 'Akoupé' ? 'selected' : '' }}>
                                                                                Akoupé</option>
                                                                            <option
                                                                                value="Anyama"{{ $user->ville === 'Anyama' ? 'selected' : '' }}>
                                                                                Anyama</option>
                                                                            <option
                                                                                value="Bangolo"{{ $user->ville === 'Bangolo' ? 'selected' : '' }}>
                                                                                Bangolo</option>
                                                                            <option
                                                                                value="Beoumi"{{ $user->ville === 'Beoumi' ? 'selected' : '' }}>
                                                                                Beoumi</option>
                                                                            <option
                                                                                value="Biankouma"{{ $user->ville === 'Biankouma' ? 'selected' : '' }}>
                                                                                Biankouma</option>
                                                                            <option
                                                                                value="Bingerville"{{ $user->ville === 'Bingerville' ? 'selected' : '' }}>
                                                                                Bingerville</option>
                                                                            <option
                                                                                value="Bondoukou"{{ $user->ville === 'Bondoukou' ? 'selected' : '' }}>
                                                                                Bondoukou</option>
                                                                            <option
                                                                                value="Bongouanou"{{ $user->ville === 'Bongouanou' ? 'selected' : '' }}>
                                                                                Bongouanou</option>
                                                                            <option
                                                                                value="Bouaflé"{{ $user->ville === 'Bouaflé' ? 'selected' : '' }}>
                                                                                Bouaflé</option>
                                                                            <option
                                                                                value="Bouaké"{{ $user->ville === 'Bouaké' ? 'selected' : '' }}>
                                                                                Bouaké</option>
                                                                            <option
                                                                                value="Boundiali"{{ $user->ville === 'Boundiali' ? 'selected' : '' }}>
                                                                                Boundiali</option>
                                                                            <option
                                                                                value="Dabou"{{ $user->ville === 'Dabou' ? 'selected' : '' }}>
                                                                                Dabou</option>
                                                                            <option
                                                                                value="Daloa"{{ $user->ville === 'Daloa' ? 'selected' : '' }}>
                                                                                Daloa</option>
                                                                            <option
                                                                                value="Danané"{{ $user->ville === 'Danané' ? 'selected' : '' }}>
                                                                                Danané</option>
                                                                            <option
                                                                                value="Daoukro"{{ $user->ville === 'Daoukro' ? 'selected' : '' }}>
                                                                                Daoukro</option>
                                                                            <option
                                                                                value="Dimbokro"{{ $user->ville === 'Dimbokro' ? 'selected' : '' }}>
                                                                                Dimbokro</option>
                                                                            <option
                                                                                value="Divo"{{ $user->ville === 'Divo' ? 'selected' : '' }}>
                                                                                Divo</option>
                                                                            <option
                                                                                value="Duékoué"{{ $user->ville === 'Duékoué' ? 'selected' : '' }}>
                                                                                Duékoué</option>
                                                                            <option
                                                                                value="Ferkessédougou"{{ $user->ville === 'Ferkessédougou' ? 'selected' : '' }}>
                                                                                Ferkessédougou</option>
                                                                            <option
                                                                                value="Gagnoa"{{ $user->ville === 'Gagnoa' ? 'selected' : '' }}>
                                                                                Gagnoa</option>
                                                                            <option
                                                                                value="Grand-Bassam"{{ $user->ville === 'Grand-Bassam' ? 'selected' : '' }}>
                                                                                Grand-Bassam</option>
                                                                            <option
                                                                                value="Grand-Lahou"{{ $user->ville === 'Grand-Lahou' ? 'selected' : '' }}>
                                                                                Grand-Lahou</option>
                                                                            <option
                                                                                value="Guiglo"{{ $user->ville === 'Guiglo' ? 'selected' : '' }}>
                                                                                Guiglo</option>
                                                                            <option
                                                                                value="Issia"{{ $user->ville === 'Issia' ? 'selected' : '' }}>
                                                                                Issia</option>
                                                                            <option
                                                                                value="Jacqueville"{{ $user->ville === 'Jacqueville' ? 'selected' : '' }}>
                                                                                Jacqueville</option>
                                                                            <option
                                                                                value="Katiola"{{ $user->ville === 'Katiola' ? 'selected' : '' }}>
                                                                                Katiola</option>
                                                                            <option
                                                                                value="Korhogo"{{ $user->ville === 'Korhogo' ? 'selected' : '' }}>
                                                                                Korhogo</option>
                                                                            <option
                                                                                value="Lakota"{{ $user->ville === 'Lakota' ? 'selected' : '' }}>
                                                                                Lakota</option>
                                                                            <option
                                                                                value="Man"{{ $user->ville === 'Man' ? 'selected' : '' }}>
                                                                                Man</option>
                                                                            <option
                                                                                value="Mankono"{{ $user->ville === 'Mankono' ? 'selected' : '' }}>
                                                                                Mankono</option>
                                                                            <option
                                                                                value="Minignan"{{ $user->ville === 'Minignan' ? 'selected' : '' }}>
                                                                                Minignan</option>
                                                                            <option
                                                                                value="Odienné"{{ $user->ville === 'Odienné' ? 'selected' : '' }}>
                                                                                Odienné</option>
                                                                            <option
                                                                                value="Oumé"{{ $user->ville === 'Oumé' ? 'selected' : '' }}>
                                                                                Oumé</option>
                                                                            <option
                                                                                value="Sakassou"{{ $user->ville === 'Sakassou' ? 'selected' : '' }}>
                                                                                Sakassou</option>
                                                                            <option
                                                                                value="San-Pédro"{{ $user->ville === 'San-Pédro' ? 'selected' : '' }}>
                                                                                San-Pédro</option>
                                                                            <option
                                                                                value="Sassandra"{{ $user->ville === 'Sassandra' ? 'selected' : '' }}>
                                                                                Sassandra</option>
                                                                            <option
                                                                                value="Séguéla"{{ $user->ville === 'Séguéla' ? 'selected' : '' }}>
                                                                                Séguéla</option>
                                                                            <option
                                                                                value="Sinfra"{{ $user->ville === 'Sinfra' ? 'selected' : '' }}>
                                                                                Sinfra</option>
                                                                            <option
                                                                                value="Soubré"{{ $user->ville === 'Soubré' ? 'selected' : '' }}>
                                                                                Soubré</option>
                                                                            <option
                                                                                value="Taabo"{{ $user->ville === 'Taabo' ? 'selected' : '' }}>
                                                                                Taabo</option>
                                                                            <option
                                                                                value="Tanda"{{ $user->ville === 'Tanda' ? 'selected' : '' }}>
                                                                                Tanda</option>
                                                                            <option
                                                                                value="Tiassalé"{{ $user->ville === 'Tiassalé' ? 'selected' : '' }}>
                                                                                Tiassalé</option>
                                                                            <option
                                                                                value="Tingréla"{{ $user->ville === 'Tingréla' ? 'selected' : '' }}>
                                                                                Tingréla</option>
                                                                            <option
                                                                                value="Touba"{{ $user->ville === 'Touba' ? 'selected' : '' }}>
                                                                                Touba</option>
                                                                            <option
                                                                                value="Toumodi"{{ $user->ville === 'Toumodi' ? 'selected' : '' }}>
                                                                                Toumodi</option>
                                                                            <option
                                                                                value="Vavoua"{{ $user->ville === 'Vavoua' ? 'selected' : '' }}>
                                                                                Vavoua</option>
                                                                            <option
                                                                                value="Yamoussoukro"{{ $user->ville === 'Yamoussoukro' ? 'selected' : '' }}>
                                                                                Yamoussoukro</option>
                                                                            <option
                                                                                value="Zuénoula"{{ $user->ville === 'Zuénoula' ? 'selected' : '' }}>
                                                                                Zuénoula</option>
                                                                        </select>

                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="sexe">Sexe :</label>
                                                                        <select id="sexe"
                                                                            class="form-control form-select-sexe"
                                                                            name="sexe">
                                                                            <option value="masculin"
                                                                                {{ $user->sexe === 'masculin' ? 'selected' : '' }}>
                                                                                Masculin
                                                                            </option>
                                                                            <option value="feminin"
                                                                                {{ $user->sexe === 'feminin' ? 'selected' : '' }}>
                                                                                Féminin
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4 mt-3">
                                                                        <label for="role">Rôle :</label>
                                                                        <select id="role"
                                                                            class="form-control text-capitalize form-select-role"
                                                                            name="role">
                                                                            <option
                                                                                value="commercial"{{ $user->role === 'commercial' ? 'selected' : '' }}>
                                                                                Commercial</option>
                                                                            <option
                                                                                value="stock"{{ $user->role === 'stock' ? 'selected' : '' }}>
                                                                                Stock</option>
                                                                            <option
                                                                                value="comptabilite"{{ $user->role === 'comptabilite' ? 'selected' : '' }}>
                                                                                Comptabilite</option>
                                                                            <option
                                                                                value="reseau"{{ $user->role === 'reseau' ? 'selected' : '' }}>
                                                                                Reseau</option>
                                                                            <option
                                                                                value="programmation"{{ $user->role === 'programmation' ? 'selected' : '' }}>
                                                                                Programmation</option>
                                                                            <option
                                                                                value="secretariat"{{ $user->role === 'secretariat' ? 'selected' : '' }}>
                                                                                Secretariat</option>
                                                                            <option
                                                                                value="rh"{{ $user->role === 'rh' ? 'selected' : '' }}>
                                                                                Rh</option>
                                                                            <option
                                                                                value="admin"{{ $user->role === 'admin' ? 'selected' : '' }}>
                                                                                Admin</option>
                                                                            <option
                                                                                value="super_admin"{{ $user->role === 'super_admin' ? 'selected' : '' }}>
                                                                                Super Admin</option>
                                                                        </select>

                                                                    </div>
                                                                    {{-- <div class="form-group col-md-4 mt-3">
                                                                    <label for="identifiant_credit_acces">Identifiant
                                                                        crédit
                                                                        accès :</label>
                                                                    <input type="text" id="identifiant_credit_acces"
                                                                        class="form-control"
                                                                        name="identifiant_credit_acces"
                                                                        placeholder="Identifiant crédit accès"
                                                                        value="{{ $user->identifiant_credit_acces }}">
                                                                </div> --}}
                                                                </div>
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
            var choicesRole = new Choices('.form-select-role', {
                searchEnabled: true,
                itemSelectText: '',
            });
            var choicesSexe = new Choices('.form-select-sexe', {
                searchEnabled: true,
                itemSelectText: '',
            });
            var choicesVille = new Choices('.form-select-ville', {
                searchEnabled: true,
                itemSelectText: '',
            });
        })
    </script>
@endsection
