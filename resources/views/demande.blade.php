@extends('layouts.master')
@section('css')
    <link href="{{ asset('assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $document->nom }}</a></li>
                            <li class="breadcrumb-item active">{{ __('documents') }}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ __('Demandes de :doc', ['doc' => $document->nom]) }}</h4>
                </div>
            </div>
        </div><!-- end page title -->

        <div class="row">
            <div class="col-12">
                @include($form)
            </div>
            <div class="col-12">
                <div class="row">
                    @foreach ($demandes as $key => $demande)
                        <div class="col-6">
                            @include('partials.demande', ['demande' => $demande])
                        </div>
                    @endforeach
                </div>
            </div>
            
        </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/dropify/js/dropify.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function (e) {
            $('[data-plugins="dropify"]').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong appended.'
                },
                error: {
                    'fileSize': 'The file size is too big (1M max).'
                }
            });
        });
    </script>
@endsection