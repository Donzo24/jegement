<div class="card-box">
    @include('layouts.info')
    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">{{ __('Modifier une demande') }}</h5>
    <form enctype="multipart/form-data" method="POST" action="{{ route('demandes.update', $update->id_demande) }}">
        <input type="hidden" name="document" value="{{ $document->id_document }}">
        <input type="hidden" name="demande" value="{{ $update->id_demande }}">
        @csrf
        @method("PUT")
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
                                <option {{ (json_decode($update->variables, true)[$v[0]] == "Monsieur") ? 'selected':'' }} value="Monsieur">{{ __('Monsieur') }}</option>
                                <option {{ (json_decode($update->variables, true)[$v[0]] == "Madame") ? 'selected':'' }} value="Madame">{{ __('Madame') }}</option>
                            </select>
                        @else
                            <input placeholder="{{ ($v[0] == "requerant") ? 'Youssouf Donzo/Eleve/Yimbaya,Matoto,Conakry':"" }}" type="text" class="form-control" name="{{ $v[0] }}" value="{{ old($v[0]) ?? json_decode($update->variables, true)[$v[0]] }}">
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