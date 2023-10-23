@extends('pages.back.admin.master',['titre'=>'EDITION DE CLIENT'])
@section('style')

@endsection
@section('admin-content')
<link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">

<div class="forms container-fluid">
  <div class="row">

    <!-- Form Elements -->
    <div class="col-lg-12">
      <section id="basic-vertical-layouts">

        <div class="card">
          <div class="p-3">
            <a class="btn btn-outline-primary" href="{{ route('customers.index') }}">
              <i class="fa fa-arrow-left"></i>
              Liste des clients </a>
          </div>
          <div class="card-content">
            <div class="card-body">
              <form class="form form-vertical" method="POST" action="{{ route('customers.update',$client->id) }}">
                @method('PUT')
                @csrf
                <div class="row match-height">
                  <div class="col-md-4 col-12">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="status_client">Status du client : </label>
                            <div class="form-group">
                              <select class="form-select-fournisseur form-control" name="status" id="status_client">
                                <option value="Entreprise" {{ $client->status == 'Entreprise' ? 'selected' : '' }}>
                                  Entreprise
                                </option>
                                <option value="Particulier" {{ $client->status == 'Particulier' ? 'selected' : '' }}>
                                  Particulier
                                </option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-12">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="type">Type de fournisseur : </label>
                            <div class="form-group">
                              <select class="form-select-fournisseur form-control select2" name="type" id="type">
                                <option value="Normal" {{ $client->type == 'Normal' ? 'selected' : '' }}>
                                  Normal
                                </option>
                                <option value="Distributeur" {{ $client->type == 'Distributeur' ? 'selected' : '' }}>
                                  Distributeur
                                </option>
                                <option value="Revendeur" {{ $client->type == 'Revendeur' ? 'selected' : '' }}>
                                  Revendeur
                                </option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-12">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group" id="fname">
                            <label for="first-name-vertical">Nom et Prénoms</label>
                            <input type="text" id="first-name-vertical" class="form-control" name="particular_name"
                              placeholder="Nom complet" value="{{$client->nom}}">
                          </div>
                          <div class="form-group" id="entreprise">
                            <label for="first-name-vertical">Raison sociale</label>
                            <input type="text" id="first-name-vertical" class="form-control" name="enterprise_name"
                              placeholder="Raison sociale" value="{{$client->nom}}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mt-5 row">
                  <div class="col-md-4 col-12">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="email-id-vertical">Email</label>
                            <input type="email" id="email-id-vertical" class="form-control" name="email"
                              placeholder="Email" value="{{$client->email}}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-12">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="solde">Solde départ</label>
                            <input type="number" id="solde" class="form-control" name="solde" placeholder="Solde départ"
                              value="{{$client->solde}}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-12">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="first-name-vertical">Téléphone</label>
                            <input type="tel" id="first-name-vertical" class="form-control" name="telephone"
                              placeholder="Numéro de téléphone" value="{{$client->contact}}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-4 col-12">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="first-name-vertical">Pays</label>
                            <input type="text" id="first-name-vertical" class="form-control" name="pays"
                              placeholder="Pays" value="{{$client->pays}}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-12">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="first-name-vertical">Ville</label>
                            <input type="text" id="first-name-vertical" class="form-control" name="ville"
                              placeholder="Ville" value="{{$client->ville}}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-12">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="first-name-vertical">Commune</label>
                            <input type="text" id="first-name-vertical" class="form-control" name="commune"
                              placeholder="Commune" value="{{$client->commune}}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @if ($contact !== null )
                <div class="row mt-3" id="persContact">
                  <legend>Personne à contacter</legend>
                  <div class="col-md-3 col-12">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="contact-name">Nom de la personne à contacter</label>
                            <input type="text" id="contact-name" class="form-control" name="contact_name"
                              placeholder="Nom de la personne à contacter" value="{{$contact->nom_du_contact}}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="contact-email">Email de la personne à contacter</label>
                            <input type="email" id="contact-email" class="form-control" name="contact_email"
                              placeholder="Email de la personne à contacter" value="{{$contact->adresse_email}}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="contact-telephone">Téléphone de la personne à contacter</label>
                            <input type="tel" id="contact-telephone" class="form-control" name="contact_telephone"
                              placeholder="Téléphone de la personne à contacter" value="{{$contact->numero_telephone}}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="contact-poste">Poste de la personne à contacter</label>
                            <input type="text" id="contact-poste" class="form-control" name="contact_poste"
                              placeholder="Poste de la personne à contacter" value="{{$contact->poste}}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif

                </div>
                <div class="col-12 d-flex justify-content-between mt-4" style="">
                  <button type="reset" class="btn btn-danger me-1 mb-1"
                    style="padding-left: 5%; padding-right: 5%;">Annuler</button>
                  <button type="submit" class="btn btn-success me-1 mb-1 "
                    style="padding-left: 5%; padding-right: 5%;">Enregistrer</button>

                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script>
  $(document).ready(function() {
      // Show particulier form on particulier button click
      $("#particulierRadio").click(function() {
          $("#formulaire").html($("#particulierForm").html());
      });

      // Show entreprise form on entreprise button click
      $("#entreprise-radio").click(function() {
          $("#formulaire").html($("#entreprise-form").html());
      });
  });
</script>
<script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script>
<script>

</script>
<script>
  $(function() {
         // init choices
         var choices = new Choices('.form-select-fournisseur', {
                    searchEnabled: true,
                    itemSelectText: '',
                });

        $("#fname").hide();
        $("#entreprise").show();
        $("#persContact").show();

        $("#status_client").change(function() {
            var select = $(this).val();
            if (select == 'Entreprise') {
                $("#fname").hide();
                $("#entreprise").show();
                $("#persContact").show();
            } else {
                $("#fname").show();
                $("#entreprise").hide();
                $("#persContact").hide();
            }
        });

    })
</script>
@endsection
@section('script')



@endsection