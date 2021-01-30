@extends('layouts.master')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
         <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('Profil') }}</a></li>
                            <li class="breadcrumb-item active">{{ Auth::user()->nom }}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ __('Mon compte') }}</h4>
                </div>
            </div>
        </div><!-- end page title -->
        
        <div class="row">
            <div class="col-4">
                <div class="card-box text-center">
                    <img src="{{ asset('assets/images/users/user-1.jpg') }}" class="rounded-circle avatar-lg img-thumbnail">

                    <h4 class="mb-0">{{ Auth::user()->nom }}</h4>
                    <p class="text-muted">{{ Auth::user()->login }}</p>

                    <div class="text-left mt-3">

                        <p class="text-muted mb-2 font-13">
                            <strong>{{ __('Nom') }} :</strong> 
                            <span class="ml-2">{{ Auth::user()->nom }}</span>
                        </p>

                        <p class="text-muted mb-2 font-13">
                            <strong>{{ __('Login') }} :</strong> 
                            <span class="ml-2">{{ Auth::user()->login }}</span>
                        </p>

                    </div>

                </div> <!-- end card-box -->
            </div>

            <div class="col-8">
                @include('layouts.info')
                <div class="card-box">
                    <h5 class="text-center">{{ __('Modifier mes informations') }}</h5>
                    <form method="POST" action="{{ route('compte.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Nom complet') }}</label>
                                    <input type="text" name="nom" class="form-control" value="{{ Auth::user()->nom }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Email') }}</label>
                                    <input type="text" name="login" class="form-control" value="{{ Auth::user()->login }}">
                                </div>
                            </div>
                        </div> <!-- end row -->

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary waves-effect waves-light mt-2">
                                <i class="mdi mdi-content-save"></i> 
                                {{ __('Enregistrer') }}
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-box">
                    <h5 class="text-center">{{ __('Changer votre mot de passe') }}</h5>
                    <form method="POST" action="{{ route('compte.update', true) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Nouveau mot de passe') }}</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Confirmer le nouveau mot de passe') }}</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>
                        </div> <!-- end row -->

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary waves-effect waves-light mt-2">
                                <i class="mdi mdi-content-save"></i> 
                                {{ __('Enregistrer') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection