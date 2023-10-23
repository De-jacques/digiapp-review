<div>
    <div class="card">
        <div class="p-3">
            <a class="btn btn-outline-primary" href="{{ route('customers.index') }}">
                <i class="fa fa-arrow-left"></i>
                CLIENTS </a>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" method="POST" action="{{ route('customers.update', $client->id) }}"
                    enctype="multipart/form-data" wire:submit.prevent="submit">
                    @method('PUT')
                    @csrf
                    <div class="row match-height">
                        <div class="col-md-4 col-12">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="type">Type de Client (
                                                <span class="text-danger"> *</span>
                                                )</label>
                                            <div class="form-group">
                                                <select class="form-select-type form-control" name="type"
                                                    id="type">
                                                    <option value="Normal"
                                                        {{ $client->type == 'Normal' ? 'selected' : '' }}> Normal
                                                    </option>
                                                    <option value="Partenaire"
                                                        {{ $client->type == 'Partenaire' ? 'selected' : '' }}>Partenaire
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-12 ">
                            <div class="form-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <div class="form-group" id="fname">
                                            <label for="first-name-vertical">Nom et Prénoms (
                                                <span class="text-danger"> *</span>
                                                )</label>
                                            <input type="text" id="first-name-vertical" class="form-control"
                                                name="particular_name" placeholder="Nom complet" wire:model="nom"
                                                required>
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
                                                <input type="email" id="email-id-vertical" class="form-control"
                                                    name="email" placeholder="Email" required {{-- value="{{ $client->email }}" --}}
                                                    wire:model="email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-12">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="solde">Solde départ (
                                                    <span class="text-danger"> *</span>
                                                    )</label>
                                                <input type="number" id="solde" class="form-control" name="solde"
                                                    placeholder="Solde départ" {{-- value={{ $client->solde }} --}} wire:model="solde"
                                                    required>
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
                                                <label for="first-name-vertical">Téléphone (
                                                    <span class="text-danger"> *</span>
                                                    )</label>
                                                <input type="tel" id="first-name-vertical" class="form-control"
                                                    name="telephone" placeholder="Numéro de téléphone" required
                                                    {{-- value="{{ $client->contact }}" --}} wire:model="contact">
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
                                                <label for="first-name-vertical">Code Postal (
                                                    <span class="text-danger"> *</span>
                                                    )</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="code_postale" placeholder="Code postal" {{-- value="{{ $client->code_postale }}" --}}
                                                    wire:model="code_postale">
                                                @error('code_postale')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="pays" placeholder="Pays" required {{-- value="{{ $client->pays }}" --}}
                                                    wire:model="pays">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-12">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Ville (
                                                    <span class="text-danger"> *</span>
                                                    )</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="ville" placeholder="Ville" required {{-- value="{{ $client->ville }}" --}}
                                                    wire:model="ville">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-12">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Commune (
                                                    <span class="text-danger"> *</span>
                                                    )</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="commune" placeholder="Commune" {{-- value="{{ $client->commune }}"  --}}
                                                    wire:model="commune" required>
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
                                                <label for="first-name-vertical">Situation géographique (
                                                    <span class="text-danger"> *</span>
                                                    )</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="localisation" placeholder="Situation géographique"
                                                    wire:model="localisation" {{-- value="{{ $client->localisation }}"  --}} required>
                                                @error('localisation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end mt-5" style="">
                        <button type="submit" class="btn btn-success me-1 mb-1 "
                            style="padding-left: 5%; padding-right: 5%;">Enregistrer</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
