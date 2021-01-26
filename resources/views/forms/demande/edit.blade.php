<div class="card-box">
    @include('layouts.info')
    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">{{ __('Modifier un article') }}</h5>
    <form enctype="multipart/form-data" method="POST" action="{{ route('articles.update', $article->id_article) }}">
        <input type="hidden" name="operation" value="0">
        <input type="hidden" name="article" value="{{ $article->id_article }}">
        @csrf
        @method('PUT')
        <div class="mt-1">
            <input type="file" name="image" data-plugins="dropify" data-default-file="{{ Storage::url($article->image) }}"  />
            <p class="text-muted text-center mt-2 mb-0">{{ __('Logo') }}</p>
        </div>
        <div class="form-group mb-3">
            <label for="product-meta-title">{{ __('Titre') }}:</label>
            <input type="text" class="form-control" name="titre" value="{{ old('titre') ?? $article->titre }}">
        </div>

        <div class="form-group mb-3">
            <label for="product-meta-title">{{ __('Lien externe') }}:</label>
            <input type="text" class="form-control" name="url" value="{{ old('url') ?? $article->url }}">
        </div>

        <div class="form-group mb-0">
            <label for="product-meta-description">{{ __('Description') }}:</label>
            <textarea class="form-control" rows="5" name="description" placeholder="Please enter description">{{ old('description') ?? $article->description }}</textarea>
        </div>
        <button class="btn btn-primary mt-2" type="submit">
            {{ __('Enregistrer') }}
        </button>
    </form>
</div> <!-- end card-box -->