@extends('pages.back.admin.master', ['titre' => 'EDITION DE CLIENT'])
@section('admin-content')
    @livewire('part-cust-edit', ['client' => $client], key($client->id))

    <style>
        .custom-file-label {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
        }

        label {
            font-weight: bold;
            text-transform: uppercase;

        }

        input {
            text-align: center;
        }
    </style>
    <script src="{{ asset('assets/js/jquery-3.6.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('form').submit(function(event) {
                var requiredFields = ['type', 'particular_name', 'email', 'solde', 'telephone',
                    'code_postale', 'pays', 'ville', 'commune', 'localisation'
                ];
                var formIsValid = true;

                requiredFields.forEach(function(fieldName) {
                    var field = $('#' + fieldName);
                    if (field.val() === '') {
                        formIsValid = false;
                        field.addClass('is-invalid');
                    } else {
                        field.removeClass('is-invalid');
                    }
                });

                if (!formIsValid) {
                    event.preventDefault(); // Empêche la soumission du formulaire si des champs sont vides.
                    alert('Veuillez remplir tous les champs obligatoires.');
                }
            });
        });
    </script>
    <script>
        $(function() {
            // init choices
            var choices = new Choices('.form-select-type', {
                searchEnabled: true,
                itemSelectText: '',
            });

        });
    </script>
@endsection
