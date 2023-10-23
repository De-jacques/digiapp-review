@extends('pages.back.admin.master', ['titre' => "S/N DE SORTIE"])

@section('style')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

@endsection
@section('admin-content')

<section class="pb-0">
    <div class="card">
        {{-- {!! getReturnedMessage($errors, session('error'), session('success')) !!} --}}
        @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="card-body">
            <div class="d-flex justify-content-between">

            </div>
            <div class="container mt-5">
                <form class="form form-vertical" method="POST" action="{{ route('sn.outOf', $ref_sortie) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="ref_sortie" value="{{ $ref_sortie }}">

                    <table id="productTable" class="table table-bordered mt-5">
                        <thead class="text-center text-uppercase">
                            <tr>
                                <th>Produit</th>
                                <th>Numéros de série</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                            $a = 1;
                            @endphp
                            @foreach ($sortie as $item)


                            @for ($i = 0; $i < $item['qte_livre']; $i++) <tr id="row{{ $loop->iteration }}">

                                <td>
                                    <input type="hidden" name="productId[]" value="{{ $item['product_id'] }}"
                                        class="productId">
                                    <input type="text" class="form-control product-input"
                                        value="{{ $item->product->designation}}" readonly>
                                </td>
                                <td class="serial-number-cell">
                                    <select name="sn[]" class="form-control product-input form-select-sn find{{$a}}"
                                        id="serialNumber{{ $loop->iteration }}">
                                        <option value="">Sélectionnez un numéro de série</option>

                                    </select>
                                </td>
                                </tr>

                                @php
                                $a++;
                                @endphp
                                @endfor
                                @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('sorties.create') }}" class="btn btn-danger">Retourner</a>
                        <button class="btn btn-success" type="submit">Enregistrer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>


</section>

@endsection
@section('script')

<script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script>

<script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
<script>
    $(document).ready(function() {
            loadSerialNumbers();
    
            function loadSerialNumbers() {
                $('.productId').each(function() {
                    var productId = $(this).val();
    
                    var rowNumber = $(this).closest('tr').index() + 1;
                    var selectElement = $(this).closest('tr').find('.form-select-sn.find' + rowNumber);
    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
    
                    $.ajax({
                        url: "{{ route('getSerialNumbers') }}",
                        method: "POST",
                        data: {
                            productId: productId
                        },
                        success: function(response) {
                            var choicesData = response.map(function(serialNumber) {
                                return {
                                    value: serialNumber.id,
                                    label: serialNumber.serial_number
                                };
                            });
    
                            if (choicesData.length === 0) {
                                choicesData.push({
                                    value: '',
                                    label: 'Aucun numéro de série disponible pour ce produit'
                                });
                            }
    
                            var choices = new Choices(selectElement[0], {
                                searchEnabled: true,
                                itemSelectText: '',
                            });
                            choices.setChoices(choicesData, 'value', 'label', true);
                        },
    
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                });
            }
        });
</script>

@endsection