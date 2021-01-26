@extends('backend.layouts.master')
@section('css')
    <link href="{{ asset('backend/assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('Mini Blog') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Articles') }}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ __('Mini blog') }}</h4>
                </div>
            </div>
        </div><!-- end page title -->

        <div class="row">
            <div class="col-8">
                <div class="card-box">
                    <h4 class="header-title mb-2">{{ __('Gestion des articles du mini blog') }}</h4>
                    {{-- <p class="sub-header">
                        Add <code>.table-bordered</code> for borders on all sides of the table and cells.
                    </p> --}}
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0 table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Titre') }}</th>
                                    <th>{{ __('Auteur') }}</th>
                                    <th class="text-right">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $key => $article)
                                    <tr>
                                        <th scope="row">{{ $articles->firstItem()+$key }}</th>
                                        <td>{{ Str::limit($article->titre, 50) }}</td>
                                        <td>{{ $article->utilisateur->nom }}</td>
                                        <td class="text-right">
                                            <a class="btn btn-primary btn-xs" href="{{ route('articles.edit', $article->slug) }}">
                                                {{ __('Modifier') }}
                                            </a>
                                            <a href="javascript: void(0);" class="btn btn-danger btn-xs btn-delete" data-href="{{ route('articles.destroy', $article->id_article) }}">
                                                {{ __('Supprimer') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end .table-responsive-->
                    {{ $articles->links() }}
                </div> <!-- end card-box -->
            </div>
            <div class="col-4">
                @include($form)
            </div>
        </div>
@endsection

@section('script')
    <script src="{{ asset('backend/assets/libs/dropify/js/dropify.min.js') }}"></script>
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