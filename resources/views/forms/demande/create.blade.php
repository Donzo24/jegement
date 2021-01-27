<div class="card-box">
    @include('layouts.info')
    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">{{ __('Nouvelle demande') }}</h5>
    <form enctype="multipart/form-data" method="POST" action="{{ route('demandes.store') }}">
        <input type="hidden" name="document" value="{{ $document->id_document }}">
        @csrf
        <div class="row">
            @foreach ($document->variables() as $variable)
                @php
                    $v = explode(":", $variable);
                @endphp
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="product-meta-title">{{ $v[1] }}:</label>
                        @if ($v[0] == "sexe" OR $v[0] == "sexe_requerant")
                            <select class="form-control" name="{{ $v[0] }}">
                                <option value="Monsieur">{{ __('Monsieur') }}</option>
                                <option value="Madame">{{ __('Madame') }}</option>
                            </select>
                        @elseif($v[0] == "date_jour")
                            <input placeholder="JJ/MM/AAAA" type="text" class="form-control" name="{{ $v[0] }}" value="{{ old($v[0]) }}">
                        @else
                            <input placeholder="{{ ($v[0] == "requerant") ? 'Youssouf Donzo/Eleve/Yimbaya,Matoto,Conakry':"" }}" type="text" class="form-control" name="{{ $v[0] }}" value="{{ old($v[0]) }}">
                        @endif
                    </div>
                </div>
                @if ($v[0] == "etat_civil")
                    <div class="w-100"></div>
                @endif
                
            @endforeach
        </div>

        <button class="btn btn-primary mt-2" type="submit">
            {{ __('Enregistrer') }}
        </button>
    </form>
</div> <!-- end card-box -->