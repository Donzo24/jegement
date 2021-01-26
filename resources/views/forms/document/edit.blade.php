<div class="card-box">
    @include('layouts.info')
    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">{{ __('Modifier un document') }}</h5>
    <form enctype="multipart/form-data" method="POST" action="{{ route('documents.update', $document_update->id_document) }}">
        <input type="hidden" name="operation" value="0">
        <input type="hidden" name="document" value="{{ $document_update->id_document }}">
        @csrf
        @method('PUT')
        <div class="mt-1">
            <input type="file" name="template" data-plugins="dropify" data-default-file="{{ Storage::url($document_update->template) }}"  />
            <p class="text-muted text-center mt-2 mb-0">{{ __('Template') }}</p>
        </div>
        <div class="form-group mb-3">
            <label for="product-meta-title">{{ __('Nom') }}:</label>
            <input type="text" class="form-control" name="nom" value="{{ old('nom') ?? $document_update->nom }}">
        </div>

        <div class="form-group mb-0">
            <label for="product-meta-description">{{ __('Variables') }}: (name:value)</label>
            <textarea class="form-control" rows="5" name="variables" placeholder="name:value">{{ old('variables') ?? $document_update->variables }}</textarea>
        </div>

        <div class="form-group mb-0">
            <label for="product-meta-description">{{ __('Donnees') }}: (marqueur:valeur)</label>
            <textarea class="form-control" rows="5" name="datas" placeholder="marqueur:valeur">{{ old('datas') ?? $document_update->datas }}</textarea>
        </div>

        <button class="btn btn-primary mt-2" type="submit">
            {{ __('Enregistrer') }}
        </button>
    </form>
</div> <!-- end card-box -->