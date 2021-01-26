@if (\Session::has('msg'))
    <h5 class="alert alert-danger mt-0">{{ Session::get('msg') }}</h5>
@endif
@if (\Session::has('info'))
    <h5 class="alert alert-info">{{ Session::get('info') }}</h5>
@endif
@if ($errors->any())
    <h5 class="alert alert-danger">{{ $errors->first() }}</h5>
@endif