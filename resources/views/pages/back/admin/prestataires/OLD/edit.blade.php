@extends('pages.back.admin.master',['titre'=>'EDITION DE PRESTATAIRE'])
@section('style')

@endsection
@section('admin-content')
<link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/tooltip.js/1.3.0/tooltip.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/tooltip.js/1.3.0/tooltip.min.js"></script>


<div class="card">
  <div class="p-3">
    <a class="btn btn-outline-primary" href="{{ route('providers.index') }}">
      <i class="fa fa-arrow-left"></i>
      prestataires </a>
  </div>
  <div class="card-content">
    <div class="card-body">
      <form class="form form-vertical" method="POST" action="{{ route('providers.update',$provider->id) }}"
        enctype="multipart/form-data">
        @method('PUT')

        @csrf
        <div class="row match-height">
          <div class="col-md-4 col-12">
            <div class="form-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="status_client">Status du prestataire (
                                        <span class="text-danger"> *</span>
                                        ) </label>
                    <div class="form-group">
                      <select class="form-select-fournisseur form-control" name="status" id="status_client">
                        <option value="Entreprise" {{ $provider->status == 'entreprise' ? 'selected' : '' }}
                          selected>Entreprise</option>
                        <option value="Particulier" {{ $provider->status == 'particulier' ? 'selected' : ''
                          }}>Particulier</option>
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
                  <label for="taxe">Taxe TVA (
                                        <span class="text-danger"> *</span>
                                        ) </label>
                  <div class="form-group">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="tva_status" id="rad1" value="Oui"
                        onchange="statusChange()" {{ $provider->taxe_tva == 'Oui' ? 'checked' : '' }}>
                      <label class="form-check-label" for="rad1">
                        Oui
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="tva_status" id="rad2" value="Non"
                        onchange="statusChange()" {{ $provider->taxe_tva == 'Non' ? 'checked' : '' }}>
                      <label class="form-check-label" for="rad2">
                        Non
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="docsTva" class="col-md-4">
            <div class="form-group text-center">
              @if ($provider->taxe_tva == 'Oui')
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="file" onchange="updateIcon(this)" name="file" hidden>
                <label class="custom-file-label" for="file" data-toggle="tooltip" title="Veuillez charger le fichier">
                  <i class="fas fa-cloud-upload-alt"></i>
                </label>
              </div>
              <br>
              <label for="first-name-vertical">Veuillez uploader le fichier
                d'exonération</label>
              @else
              <div class="custom-file row">
                <div class="col-md-6">
                  <a href="{{ Storage::url('app'.'/'.$exo) }}" target="_blank">
                    <i class="fa fa-file"></i>
                  </a>
                </div>
                <div class="col-md-6">
                  <input type="file" class="custom-file-input" id="file" onchange="updateIcon(this)" name="file" hidden>
                  <label class="custom-file-label" for="file" data-toggle="tooltip"
                    title="Veuillez charger le nouveau fichier">
                    <i class="fas fa-cloud-upload-alt"></i>
                  </label>
                </div>
              </div>
              @endif
            </div>
          </div>
        </div>


        <div class="col-md-12 col-12 mt-5">
          <div class="form-body">
            <div class="row">
              <div class="form-group col-md-12">
                <div class="form-group" id="fname">
                  <label for="first-name-vertical">Nom et Prénoms (
                                        <span class="text-danger"> *</span>
                                        )</label>
                  <input type="text" id="first-name-vertical" class="form-control" name="particular_name"
                    placeholder="Nom complet" value="{{$provider->name}}">
                </div>

                <div class="row form-group justify-content-between" id="entreprise">
                  <div class="col-md-4">
                    <label for="first-name-vertical">Raison sociale (
                                        <span class="text-danger"> *</span>
                                        )</label>
                    <input type="text" id="first-name-vertical" class="form-control" name="enterprise_name"
                      placeholder="Raison sociale" value="{{$provider->name}}">
                  </div>
                  <div class="col-md-4 row">
                    <label for="first-name-vertical">NCC (
                                        <span class="text-danger"> *</span>
                                        )</label>
                    <div class="col-md-8">
                      <input type="text" id="rcc" class="form-control" name="rcc_number" placeholder="Numero NCC"
                        oninput="convertToUppercase(this)" value="{{$provider->rcc_number}}">
                    </div>
                    <div class="col-md-2">

                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="rcc_file" onchange="updateIcon(this)"
                          name="rcc_file" hidden>
                        <label class="custom-file-label" for="rcc_file" data-toggle="tooltip"
                          title="Veuillez charger le fichier">
                          @if (isset($rcc))
                          <i class="text-success fa fa-check"></i>
                          @else
                          <i class="fas fa-cloud-upload-alt"></i>
                          @endif
                        </label>
                      </div>

                    </div>

                    @if (isset($rcc))
                    <div class="col-md-2">
                      <a href="{{ Storage::url('app'.'/'.$rcc) }}" target="_blank">
                        <i class="fa fa-file"></i>
                      </a>
                    </div>
                    @endif
                  </div>
                  <div class="col-md-4 row">
                    <label for="first-name-vertical">RCCM (
                                        <span class="text-danger"> *</span>
                                        )</label>
                    <div class="ml-2 col-md-8">
                      <input type="text" id="first-name-vertical" class="form-control" name="rcm_number"
                        placeholder="Numero RCCM" oninput="convertToUppercase(this)" value="{{$provider->rcm_number}}">
                    </div>
                    <div class="col-md-2">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="rcm_file" onchange="updateIcon(this)"
                          name="rcm_file" hidden>
                        <label class="custom-file-label" for="rcm_file" data-toggle="tooltip"
                          title="Veuillez charger le fichier">

                          @if (isset($rcm))
                          <i class="text-success fa fa-check"></i>
                          @else
                          <i class="fas fa-cloud-upload-alt"></i>
                          @endif

                        </label>
                      </div>
                    </div>
                    @if (isset($rcm))
                    <div class="col-md-2">
                      <a href="{{ Storage::url('app'.'/'.$rcm) }}" target="_blank">
                        <i class="fa fa-file"></i>
                      </a>
                    </div>
                    @endif
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-3 row">
          <div class="col-md-4 col-12">
            <div class="form-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="email-id-vertical">Email (
                                        <span class="text-danger"> *</span>
                                        )</label>
                    <input type="email" id="email-id-vertical" class="form-control" name="email" placeholder="Email"
                      required value="{{$provider->email}}">
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
                    <label for="solde">Solde (
                                        <span class="text-danger"> *</span>
                                        )</label>
                    <input type="number" id="solde" class="form-control" name="solde" placeholder="Solde"
                      value={{$provider->balance}} required>
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
                    <label for="first-name-vertical">Téléphone (
                                        <span class="text-danger"> *</span>
                                        )</label>
                    <input type="tel" id="first-name-vertical" class="form-control" name="telephone"
                      placeholder="Numéro de téléphone" required value="{{$provider->contact}}">
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
                    <label for="first-name-vertical">Pays (
                                        <span class="text-danger"> *</span>
                                        )</label>
                    <input type="text" id="first-name-vertical" class="form-control" name="pays" placeholder="Pays"
                      required value="{{$provider->country}}">
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
                    <label for="first-name-vertical">Ville (
                                        <span class="text-danger"> *</span>
                                        )</label>
                    <input type="text" id="first-name-vertical" class="form-control" name="ville" placeholder="Ville"
                      required value="{{$provider->city}}">
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
                    <label for="first-name-vertical">Commune (
                                        <span class="text-danger"> *</span>
                                        )</label>
                    <input type="text" id="first-name-vertical" class="form-control" name="commune"
                      placeholder="Commune" value="{{$provider->municipality}}">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- @if ($contact !== null ) --}}

        <div class="row mt-3" id="persContact">
          <legend>Personne à contacter</legend>
          <div class="col-md-3 col-12">
            <div class="form-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="contact-name">Nom du contact (
                                        <span class="text-danger"> *</span>
                                        )</label>
                    <input type="text" id="contact-name" class="form-control" name="contact_name"
                      placeholder="Nom du contact" value="{{$contact->nom_du_contact}}">
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
                    <label for="contact-email">Email du contact (
                                        <span class="text-danger"> *</span>
                                        )</label>
                    <input type="email" id="contact-email" class="form-control" name="contact_email"
                      placeholder="Email du contact" value="{{$contact->adresse_email}}">
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
                    <label for="contact-telephone">Téléphone du contact (
                                        <span class="text-danger"> *</span>
                                        )</label>
                    <input type="tel" id="contact-telephone" class="form-control" name="contact_telephone"
                      placeholder="Téléphone du contact" value="{{$contact->numero_telephone}}">
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
                    <label for="contact-poste">Poste du contact (
                                        <span class="text-danger"> *</span>
                                        )</label>
                    <input type="text" id="contact-poste" class="form-control" name="contact_poste"
                      placeholder="Poste du contact" value="{{$contact->poste}}">
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        {{-- @endif --}}
        <div class="col-12 d-flex justify-content-between mt-4" style="">
          {{-- <button type="reset" class="btn btn-danger me-1 mb-1"
            style="padding-left: 5%; padding-right: 5%;">Annuler</button> --}}
          <button type="submit" class="btn btn-success me-1 mb-1 "
            style="padding-left: 5%; padding-right: 5%;">Enregistrer</button>

        </div>
      </form>
    </div>
  </div>
</div>
<style>
  .custom-file-label {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    cursor: pointer;
  }
</style>
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
        $('#docsTva').hide();
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
        
        // $("tva_status").change(function(){
        //   var status_tva = $(this).val();
        //   if(status_tva == 'Oui'){
        //     console.log('Oui');
        // }else{
        //   console.log('Error');
        // }
      // });
    
    })


</script>
<script>
  function statusChange() {
      const radioButtons = document.getElementsByName('tva_status');
      let selectedValue;

      for (let i = 0; i < radioButtons.length; i++) {
        if (radioButtons[i].checked) {
          selectedValue = radioButtons[i].value;
          break;
        }
      }
      console.log(selectedValue);

      if(selectedValue == 'Oui'){
        $('#docsTva').hide();
      }else{
        $('#docsTva').show();
      }
    }
</script>
<script>
  function updateIcon(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function(e) {
        var icon = input.parentElement.querySelector('.custom-file-label i');
        icon.classList.remove('fas', 'fa-cloud-upload-alt');
        icon.classList.add('fas', 'fa-check');
        input.parentElement.querySelector('.custom-file-label').classList.add('uploaded');
        input.parentElement.querySelector('.custom-file-label').style.color = '#28a745'; // changer la couleur de fond en vert
      }
  
      reader.readAsDataURL(input.files[0]); // lecture du fichier et appel de la fonction onload
    }
  }
</script>
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
<script>
  function convertToUppercase(input) {
  input.value = input.value.toUpperCase();
}

</script>

@endsection
@section('script')



@endsection