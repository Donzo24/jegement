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
                <div class="col-4">
                    <div class="form-group mb-3">
                        <label for="product-meta-title">{{ $v[1] }}:</label>
                        @if ($v[0] == "sexe")
                            <select class="form-control" name="{{ $v[0] }}">
                                <option value="Monsieur">{{ __('Monsieur') }}</option>
                                <option value="Madame">{{ __('Madame') }}</option>
                            </select>
                        @else
                            <input type="text" class="form-control" name="{{ $v[0] }}" value="{{ old($v[0]) }}">
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <button class="btn btn-primary mt-2" type="submit">
            {{ __('Enregistrer') }}
        </button>
    </form>
</div> <!-- end card-box -->