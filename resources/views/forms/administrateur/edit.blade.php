<div class="card">
    <div class="card-body">
        @include('layouts.info')
        <h4 class="header-title text-center">{{ __('Modifier un utilisateur') }}</h4>
        <form action="{{ route('utilisateurs.update', $update->id_utilisateur) }}" method="POST">
            <input type="hidden" name="operation" value="0">
            <input type="hidden" name="utilisateur" value="{{ $update->id_utilisateur }}">
            @csrf
            @method('PUT')                    
            <div class="form-group">
                <label>{{ __('Nom') }}</label>
                <input name="nom" type="text" value="{{ old('nom') ?? $update->nom }}" class="form-control">
            </div>
            <div class="form-group">
                <label>{{ __('Login') }}</label>
                <input name="login" type="text" value="{{ old('login') ?? $update->login }}" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary waves-effect waves-light">
                {{ __('Modifier') }}
            </button>
        </form>
    </div> <!-- end card-body-->
</div>