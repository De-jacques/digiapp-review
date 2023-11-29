@extends('pages.back.admin.master', ['titre' => 'GESTION DES FACTURES'])
@section('admin-content')
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
            <div class="tables">
                <div>
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div>
                                    @if (Session::has('success-invoice'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ Session::get('success-invoice') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    @if (Session::has('uploadedInvoice'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ Session::get('uploadedInvoice') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0  table-hover display" id="proTable">
                                            <thead>
                                                <tr class="">
                                                    <th style="display: none">Id</th>
                                                    <th>Référence</th>
                                                    <th>Réf Proforma</th>
                                                    <th>Montant</th>
                                                    <th>Date</th>
                                                    <th>Réf Facture</th>
                                                    <th class="text-center">
                                                        Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @isset($factures)
                                                    @foreach ($factures as $facture)
                                                        <tr>
                                                            <td>{{$facture->id}}</td>
                                                            <td>{{$facture->proforma->ref_proforma}}</td>
                                                            <td>
                                                               {{$facture->montant}}
                                                            </td>
                                                            <td>{{$facture->created_at}}</td>
                                                            <td>
                                                                @if (empty($facture->ref_facture))
                                                                    .......
                                                                @else
                                                                    {{$facture->ref_facture}}
                                                                @endif
                                                                
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="{{route ('regenererFacture' , $facture->proforma->ref_proforma) }}"
                                                                    target="_blank" type="button"
                                                                    class="btn btn-outline-primary">
                                                                    <i class="fa fa-print"></i>
                                                                </a>
                                                                {{-- <a href="" type="button" class="btn btn-outline-dark" target="_blank">
                                                                    <i class="fa fa-share"></i> --}}
                                                               
                                                                {{-- <a href="" type="button" data-bs-toggle="modal" data-bs-target="#viewFacture{{ $facture->id }}" class="btn btn-outline-dark">
                                                                    <i class="fa fa-file-arrow-up"></i>
                                                                </a> --}}
                                                                
                                                                {{-- <a href="" type="button" class="btn btn-outline-dark" target="_blank">
                                                                    <i class="fa fa-share"></i>
                                                                </a> --}}
                                                                {{-- @if (Auth::user()->role == 'commercial' || Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin')
                                                                    <a href="{{ route('proformas.edit', $proforma->ref_proforma) }}"
                                                                        type="button" class="btn btn-outline-warning">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>
                                                                @endif
                                                                <a href="{{ route('sendMail', $proforma->ref_proforma) }}"
                                                                    type="button" class="btn btn-outline-dark">
                                                                    <i class="fa fa-envelope"></i>
                                                                </a>
                                                                @if (Auth::user()->role == 'commercial' || Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin')
                                                                    <a href="" type="button"
                                                                        class="btn btn-outline-danger" data-bs-toggle="modal"
                                                                        data-bs-target="#delete{{ $proforma->id }}">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                @endif --}}
                                                               
                                                                @if ($facture->status_facture == 1)
                                                                    <a href="" type="button" data-bs-toggle="modal" data-bs-target="#viewInvoice{{$facture->ref_facture}}" target="_blank" class="btn btn-warning">
                                                                        <i class="fas fa-eye"></i>
                                                                    </a>
                                                                    <!-- Start View Invoice -->
                                                                    <div class="modal fade" id="viewInvoice{{$facture->ref_facture}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Facture <span class="text-danger"> </span></h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                            <iframe src="{{asset($facture->path_invoice.''.$facture->file_invoice)}}" width="463px" height="500px" frameborder="0">

                                                                            </iframe>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Quitter</button>
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    {{-- Start View Invoice --}}
                                                                @else
                                                                   <a href="{{ route('uploadFacture' ,$facture->proforma->ref_proforma) }}" target="_blank" class="btn btn-success">
                                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                                </a>  
                                                                @endif
                                                            </td>
                                                            <td>
                                                                
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
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        // function uploadFileInvoice(input) {
        //     let invoiceUpload = input.files[0];
        //     if (invoiceUpload) {
        //         let icon = input.parentElement.querySelector('.custom-file-label i');
        //             icon.classList.add('fas', 'fa-check');
        //             input.parentElement.querySelector('.custom-file-label').classList.add('uploaded');
        //             input.parentElement.querySelector('.custom-file-label').style.color ='#fff';
        //             input.parentElement.querySelector('.custom-file-label').classList.remove('btn-danger');
        //             input.parentElement.querySelector('.custom-file-label').classList.add('btn-success');
        //             document.getElementById("invoice_file").disabled = true;
        //     }
        // }
    </script>
@endsection
@section('script')
@endsection
