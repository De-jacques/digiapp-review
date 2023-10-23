@extends('pages.back.admin.master',['titre' => 'LISTE DES CONTACTS'])
@section('style')

@endsection
@section('admin-content')

<div class="row">
  <div class="col-md-12">
    <div class="card mb-0">
      <div class="mx-3">
        <div class="row">

          <div class="col-md-3 d-flex justify-content-start py-3">
            <a href="{{route('customers.index')}}" class="btn btn-primary"><i class="fa fa-user"></i> Clients</a>
          </div>
          <div class="col-md-3 d-flex justify-content-start py-3">
            <a href="{{route('providers.index')}}" class="btn btn-primary"><i class="fa fa-user"></i>
              Prestataires</a>
          </div>
          <div class="col-md-3 d-flex justify-content-start py-3">
            <a href="{{route('suppliers.index')}}" class="btn btn-primary"><i class="fa fa-user"></i>
              Fournisseurs</a>
          </div>

          <div class="col-md-3 d-flex justify-content-end py-3">
            <a href="{{ route('contacts.create') }}" class="btn btn-outline-primary"><i class="fa fa-plus"></i>
              Ajouter un contact</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="col-md-12">
          @if (Session::has('message'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
        </div>
        <div class="table-responsive">
          <table class="table mb-0  table-hover" id="datatable">
            <thead>
              <tr>
                <th>Nom</th>
                <th>Entreprise</th>
                <th>Relation</th>
                <th>Poste</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @isset($contacts)
              @foreach($contacts as $key => $contact)
              <tr>
                <td>{{ $contact->nom_du_contact }}</td>
                <td>

                  @if ($contact->relation == "Client")
                  {{$contact->getCustomer($contact->customer_id)}}
                  @endif

                  @if ($contact->relation == "Fournisseur")
                  {{$contact->supplier($contact->supplier_id)}}
                  @endif

                  @if ($contact->relation == "Prestataire")
                  {{$contact->provider($contact->provider_id)}}
                  @endif

                </td>
                <td>{{ $contact->relation }}</td>
                <td>{{ $contact->poste }}</td>
                <td>
                  <form action="{{ route('contacts.destroy',$contact->id) }}" method="Post">
                    <a class="btn btn-primary" href="{{ route('contacts.edit',$contact->id) }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path
                          d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                          d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                      </svg>
                    </a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-trash3" viewBox="0 0 16 16">
                        <path
                          d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                      </svg>
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
              @endisset
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"
  integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="{{asset('js/datatable-jquery.js')}}"><script>
@endsection
@section('script')

@endsection
