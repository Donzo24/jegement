@extends('layouts.master')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('Evil Technologies') }}</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('Document generator') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Tableau de bord') }}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ __('Tableau de bord') }}</h4>
                </div>
            </div>
        </div><!-- end page title -->

        @include('layouts.info')
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0 table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Nom') }}</th>
                                    <th class="text-right">{{ __('Nombre') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documents as $key => $document)
                                    <tr>
                                        <th scope="row">{{ $documents->firstItem()+$key }}</th>
                                        <td>{{ $document->nom }}</td>
                                        <td class="text-right">{{ $document->demandes->count() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end .table-responsive-->
                    {{ $documents->links() }}
                </div> <!-- end card-box -->
            </div>
        </div>
@endsection