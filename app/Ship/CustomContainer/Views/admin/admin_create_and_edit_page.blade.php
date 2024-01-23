@extends('customcontainer::layout.app_admin_nova')

@section('title')
    {{ __('Create ') . $crud->title }}
@endsection

@php
    // dd($errors);
    // dd(get_defined_vars()['__data']);

    $view_load_theme = 'base';
@endphp

@section('header_sub')
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <h2>{{ __('Create New ') . $crud->title }}</h2>
            </div>
        </div>
    </div>
@endsection

@once
    @push('after_header')
        {{-- <link href="{{ asset('theme/' . $view_load_theme . '/css/admin_create_release_css.css') }}" rel="stylesheet"
            type="text/css"> --}}
    @endpush
@endonce


@section('content')
    <div class="col-12">
        <div class="row">
            <!-- Default box -->

            {{-- @include('customcontainer::crud.inc.grouped_errors') --}}

            <form method="post" action="{{ url($crud->route) }}{{ isset($item) ? '/' . $item->id . '/update' : '/store' }}">
                {!! csrf_field() !!}
                @if (isset($item))
                    {{ method_field('PUT') }}
                @endif
                <!-- load the view from the application if it exists, otherwise load the one in the package -->

                @include('customcontainer::crud.form_content', [
                    'fields' => $crud->fields,
                    'action' => $crud->currentOperation,
                ])

                @include('customcontainer::crud.inc.form_save_buttons')

            </form>
        </div>

    </div>
    <div class="template hidden"></div>
@endsection


@section('javascript')
    @yield('after_scripts')
@endsection
