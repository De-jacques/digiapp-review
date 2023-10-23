@extends('pages.back.admin.master', ['titre' => "ENREGISTREMENT DES S/N "])

@section('admin-content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css" />

{{-- <section class="section"> --}}
    <div class="card">
        {{-- {!! getReturnedMessage($errors, session('error'), session('success')) !!} --}}
        <div class="card-body">
            <div class="d-flex justify-content-between">

                <div class="mb-5 mt-1">
                    <a class="btn btn-outline-secondary" href="{{ route('stocks.entre') }}"> Liste des bons d'entrée
                    </a>
                </div>

            </div>
            
            <div class="container mt-5">
                <form class="form form-vertical" method="POST" action="{{ route('serial-number.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="ref_entree" value="{{ $ref_entree }}">

                    <table id="productTable" class="table table-bordered mt-5">
                        <thead class="text-center text-uppercase">
                            <tr>
                                <th>Produit</th>
                                <th>Numéros de série</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($snIterms as $num)
                            <tr>
                                <td>
                                    <input type="hidden" name="productId[]" value="{{ $num->product->id }}">
                                    <input type="text" class="form-control product-input"
                                        value="{{ $num->product->designation }}" readonly>
                                </td>
                                <td class="serial-number-cell">
                                    <input type="text" class="form-control product-input" value="{{ $num->snIterms }}"
                                        readonly>
                                </td>
                            </tr>
                            @endforeach
                            @foreach ($entreeIterms as $item)

                            @for ($i = 0; $i < $item->qte_livre; $i++)
                                <tr>
                                    <td>
                                        <input type="hidden" name="productId[]" value="{{ $item->produit->id }}">
                                        <input type="text" class="form-control product-input"
                                            value="{{ $item->produit->designation }}" readonly>
                                    </td>
                                    <td class="serial-number-cell">
                                        <input type="text" class="form-control product-input" name="sn[]">
                                    </td>
                                </tr>
                                @endfor
                                @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-danger" href="{{ route('stocks.entre') }}">Retourner</a>
                        <button class="btn btn-success" type="submit">Enregistrer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

{{-- </section> --}}
<style>

</style>
<script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script>
<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

<script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

<script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>

@endsection