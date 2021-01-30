<div class="card">
    <div class="card-body">
        @include('layouts.info')
        <h4 class="header-title text-center">{{ __('Creer une utilisateur') }}</h4>
        <form action="{{ route('utilisateurs.store') }}" method="POST">
            <input type="hidden" name="operation" value="1">
            @csrf                       
            <div class="form-group">
                <label>{{ __('Nom') }}</label>
                <input name="nom" type="text" value="{{ old('nom') }}" class="form-control">
            </div>
            <div class="form-group">
                <label>{{ __('Login') }}</label>
                <input name="login" type="text" value="{{ old('login') }}" class="form-control">
            </div>
            <div class="form-group">
                <label>{{ __('Password') }}</label>
                <input name="password" type="text" value="{{ old('password') }}" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary waves-effect waves-light">
                {{ __('Enregistrer') }}
            </button>
        </form>
    </div> <!-- end card-body-->
</div>