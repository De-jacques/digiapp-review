@extends('pages.back.admin.master',['titre'=>'CREATION DE CONTACT'])
@section('style')

@endsection
@section('admin-content')
<link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/choices.js/choices.min.css') }}" />


<div class="card">
  <div class="p-3">
    <a class="btn btn-outline-primary" href="{{ route('contacts.index') }}">
      <i class="fa fa-arrow-left"></i>
      Liste des contacts </a>
  </div>
  <div class="card-content">
    <div class="card-body">
      <form class="form form-vertical" method="POST" action="{{ route('contacts.store') }}">
        @csrf
        <div class="row match-height">
          <div class="col-md-6 col-12">
            <div class="form-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="status_client">Status du contact : </label>
                    <div class="form-group">
                      <select class="form-select-fournisseur form-control" name="status" id="status_client">
                        <option value="Customer" selected>Client</option>
                        <option value="Supplier">Fournisseur</option>
                        <option value="Provider">Prestataire</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-12">
            <div class="form-body">
              <div class="row">
                <div class="col-12">

                  <div class="form-body" id="supplier">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="type_client">Fournisseur </label>
                          <div class="form-group" id="form-select-group">
                            <select class="choices form-select-client" name="supplier_id" id="group">
                              <option value="" selected disabled>Veuillez selectionner le fournisseur</option>
                              @foreach ($suppliers as $supplier)
                              <option value="{{$supplier->id}}">{{ $supplier->name }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-body" id="customer">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="type_client">Client </label>
                          <div class="form-group" id="form-select-group">
                            <select class="choices form-select-client" name="customer_id" id="group">
                              <option value="" selected disabled>Veuillez selectionner le client</option>
                              @foreach ($customers as $customer)
                              <option value="{{$customer->id}}">{{ $customer->nom }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-body" id="provider">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="type_client">Prestataire </label>
                          <div class="form-group" id="form-select-group">
                            <select class="choices form-select-client" name="provider_id" id="group">
                              <option value="" selected disabled>Veuillez selectionner le prestataire</option>
                              @foreach ($providers as $provider)
                              <option value="{{$provider->id}}">{{ $provider->name }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="mt-5 row">
          <div class="col-md-3 col-12">
            <div class="form-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="first-name-vertical">Nom & Prénoms</label>
                    <input type="text" id="first-name-vertical" class="form-control" name="name"
                      placeholder="Nom complet du contact">
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
                    <label for="email-id-vertical">Email</label>
                    <input type="email" id="email-id-vertical" class="form-control" name="email" placeholder="Email">
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
                    <label for="poste">Poste</label>
                    <input type="text" id="poste" class="form-control" name="poste" placeholder="Poste du contact">
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
                    <label for="first-name-vertical">Téléphone</label>
                    <input type="tel" id="first-name-vertical" class="form-control" name="telephone"
                      placeholder="Numéro de téléphone">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-12 d-flex justify-content-end my-4" style="">
      <button type="submit" class="btn btn-success me-1 mb-1 "
        style="padding-left: 5%; padding-right: 5%;">Enregistrer</button>

    </div>
    </form>
  </div>
</div>
</div>



{{-- <script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script> --}}
<script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
{{-- <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script> --}}
<script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script>
<script>
  $(function() {
         // init choices
         var choices = new Choices('.form-select-fournisseur', {
                    searchEnabled: true,
                    itemSelectText: '',
                });

        $("#supplier").hide();
        $("#provider").hide();
        $("#customer").show();

        $("#status_client").change(function() {
            var select = $(this).val();
            if (select == 'Customer') {
                $("#supplier").hide();
                $("#provider").hide();
                $("#customer").show();
            } else if(select == 'Supplier'){
                $("#supplier").show();
                $("#customer").hide();
                $("#provider").hide();
            }else{
                $("#supplier").hide();
                $("#customer").hide();
                $("#provider").show();
            }
        });

    })
</script>
@endsection