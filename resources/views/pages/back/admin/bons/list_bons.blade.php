@extends('pages.back.admin.master', ['titre' => 'GESTION DES BONS'])
@section('admin-content')
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
            <div class="tables">
                <div>
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="text-center">
                                    {{-- <div class="col-md-12 d-flex justify-content-start px-2 py-3">
                                        <a type="button" class="btn btn-outline-primary"
                                            href="{{ route('proformas.create') }}">
                                            <i class="fa fa-plus"></i> proforma
                                        </a>
                                    </div> --}}
                                </div>
                                <div>
                                    @if (Session::has('success-bon'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ Session::get('success-bon') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif

                                    {{-- @if (Session::has('probleme'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ Session::get('probleme') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (Session::has('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ Session::get('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif --}}
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0  table-hover display" id="proTable">
                                            <thead>
                                                <tr class="">
                                                    <th>Référence</th>
                                                    <th>Type Bon</th>
                                                    <th>Fait le</th>
                                                    <th>Réference Proforma</th>
                                                    <th>Client</th>
                                                    <th>Montant</th>
                                                    <th>Visualiser</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @isset($bons)
                                                    @foreach ($bons as $bon)
                                                        <tr>
                                                            <td>
                                                                {{$bon->bon_ref}}
                                                            </td>
                                                            <td>
                                                                {{$bon->typeBon->title}}
                                                            </td>
                                                            <td>{{$bon->created_at}}</td>
                                                            <td>{{$bon->proforma->ref_proforma}}</td>
                                                            <td>{{$bon->proforma->customer->nom}}</td>
                                                            <td>{{$bon->proforma->total}}</td>
                                                            <td><a href="" type="button" data-bs-toggle="modal" data-bs-target="#viewBon{{ $bon->id }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i></a></td>
                                                        </tr>
                                                        <!-- Start View Bon -->
                                                        <div class="modal fade" id="viewBon{{ $bon->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Bon <span class="text-danger">- {{$bon->bon_ref}}</span></h1>
                                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                  {{-- <img src="{{asset($bon->path.''.$bon->file_bon)}}" width="300px" alt="" srcset=""> --}}
                                                                  <iframe src="{{asset($bon->path.''.$bon->file_bon)}}" width="463px" height="500px" frameborder="0">

                                                                  </iframe>
                                                                </div>
                                                                <div class="modal-footer">
                                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Quitter</button>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        {{-- Start View Bon--}}
                                                     @endforeach
                                                @endisset 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

@endsection
@section('script')
@endsection
