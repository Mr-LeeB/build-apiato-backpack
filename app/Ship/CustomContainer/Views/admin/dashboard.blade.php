@extends('customcontainer::layout.app_admin_nova')

@section('title')
    {{ __('Detail ') . $crud->title }}
@endsection

@php
    // dd(get_defined_vars()['__data']);

    $view_load_theme = 'base';
@endphp

@section('header_sub')
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <h2>{{ __('Detail ') . $crud->title }}</h2>
            </div>
        </div>
    </div>
@endsection

@once
    @push('after_header')
        {{-- <link href="{{ asset('theme/' . $view_load_theme . '/css/admin_show_detail_css.css') }}" rel="stylesheet" type="text/css"> --}}
    @endpush
@endonce

@section('javascript')
@endsection



@section('content')
    <div class="col-12">
        <div class="row">
            Dashboard
        </div>
    </div>
@endsection
