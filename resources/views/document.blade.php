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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('Gestion') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('documents') }}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ __('Gestion des documents') }}</h4>
                </div>
            </div>
        </div><!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    {{-- <p class="sub-header">
                        Add <code>.table-bordered</code> for borders on all sides of the table and cells.
                    </p> --}}
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0 table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Nom') }}</th>
                                    <th class="text-right">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documents as $key => $document)
                                    <tr>
                                        <th scope="row">{{ $documents->firstItem()+$key }}</th>
                                        <td>{{ $document->nom }}</td>
                                        <td class="text-right">
                                            <a class="btn btn-primary btn-xs" href="{{ route('documents.edit', $document->slug) }}">
                                                {{ __('Modifier') }}
                                            </a>
                                            <a href="javascript: void(0);" class="btn btn-danger btn-xs btn-delete" data-href="{{ route('documents.destroy', $document->id_document) }}">
                                                {{ __('Supprimer') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end .table-responsive-->
                    {{ $documents->links() }}
                </div> <!-- end card-box -->
            </div>
            <div class="col-12">
                @include($form)
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