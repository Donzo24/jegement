<div class="card-box">
    @include('layouts.info')
    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">{{ __('Publier un article') }}</h5>
    <form enctype="multipart/form-data" method="POST" action="{{ route('documents.store') }}">
        <input type="hidden" name="operation" value="1">
        @csrf
        <div class="mt-1">
            <input type="file" name="template" data-plugins="dropify" data-default-file=""  />
            <p class="text-muted text-center mt-2 mb-0">{{ __('Template') }}</p>
        </div>
        <div class="form-group mb-3">
            <label for="product-meta-title">{{ __('Nom') }}:</label>
            <input type="text" class="form-control" name="nom" value="{{ old('nom') }}">
        </div>

        <div class="form-group mb-0">
            <label for="product-meta-description">{{ __('Variables') }}: (name:label)</label>
            <textarea class="form-control" rows="5" name="variables" placeholder="name:label">{{ old('variables') }}</textarea>
        </div>

        <div class="form-group mb-0">
            <label for="product-meta-description">{{ __('Donnees') }}: (marqueur:valeur)</label>
            <textarea class="form-control" rows="5" name="datas" placeholder="marqueur:valeur">{{ old('datas') }}</textarea>
        </div>
        <button class="btn btn-primary mt-2" type="submit">
            {{ __('Enregistrer') }}
        </button>
    </form>
</div> <!-- end card-box -->