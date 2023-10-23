@extends('pages.back.admin.master',['titre'=>'EDITION DE CONTACT'])
@section('style')

@endsection
@section('admin-content')
<link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/choices.js/choices.min.css') }}" />

<div class="forms container-fluid">
  <div class="row">

    <!-- Form Elements -->
    <div class="col-lg-12">
      <section id="basic-vertical-layouts">

        <div class="card">
          <div class="p-3">
            <a class="btn btn-outline-primary" href="{{ route('contacts.index') }}">
              <i class="fa fa-arrow-left"></i>
              Liste des contacts </a>
          </div>
          <div class="card-content">
            <div class="card-body">
              <form class="form form-vertical" method="POST" action="{{ route('contacts.update',$contact->id) }}">
                @csrf
                @method('PUT')
                <div class="row match-height">

                  <div class="col-md-6 col-12">
                    <div class="form-body">
                      
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="status_client">Status du contact : </label>
                            <div class="form-group">
                              <select class="form-select-fournisseur form-control" name="status" id="status_client">
                                <option value="Customer" {{ $contact->status == 'Client' ? 'selected' : '' }}>Client</option>
                                <option value="Supplier" {{ $contact->status == 'Founisseur' ? 'selected' : '' }}>Fournisseur</option>
                                <option value="Provider"  {{ $contact->status == 'Prestataire' ? 'selected' : '' }}>Prestataire</option>
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
                                      @foreach ($suppliers as $supplier)
                                        <option value="{{$supplier->id}}" {{$contact->supplier_id == $supplier->id ? 'selected' : ''}}>{{ $supplier->name }}</option>
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
                                      @foreach ($customers as $customer)
                                      <option value="{{$customer->id}}" {{$contact->customer_id == $customer->id ? 'selected' : ''}}>{{ $customer->nom }}</option>
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
                                      @foreach ($providers as $provider)
                                      <option value="{{$provider->id}}" {{$contact->provider_id == $provider->id ? 'selected' : ''}}>{{ $provider->name }}</option>
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
                              placeholder="Nom complet du contact"  value="{{$contact->nom_du_contact}}">
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
                            <input type="email" id="email-id-vertical" class="form-control" name="email"
                              placeholder="Email" value="{{$contact->adresse_email}}">
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
                            <input type="text" id="poste" class="form-control" name="poste"
                              placeholder="Poste du contact"  value="{{$contact->poste}}">
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
                              placeholder="Numéro de téléphone"  value="{{$contact->numero_telephone}}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-between mt-4 mb-5 px-3" style="">
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

<script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
{{-- <script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script> --}}
<script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
{{-- <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script> --}}
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