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
            <!-- Default box -->
            <div class="" style="width: 80%">
                <div class="card no-padding no-border">
                    <table class="table table-striped mb-0">
                        <tbody>
                            @foreach ($crud->columns as $column)
                                <tr>
                                    <td>
                                        <strong>{!! $column['label'] !!}:</strong>
                                    </td>
                                    <td>
                                        @if (!isset($column['type']))
                                            @include('customcontainer::crud.columns.text')
                                        @else
                                            @if (view()->exists('vendor.backpack.crud.columns.' . $column['type']))
                                                @include('vendor.backpack.crud.columns.' . $column['type'])
                                            @else
                                                @if (view()->exists('customcontainer::crud.columns.' . $column['type']))
                                                    @include('customcontainer::crud.columns.' . $column['type'])
                                                @else
                                                    @include('customcontainer::crud.columns.text')
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div>
    </div>
@endsection
