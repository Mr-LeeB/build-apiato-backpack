@extends('customcontainer::layout.app_admin_nova')

@section('title')
    {{ __($crud->title) }}
@endsection

@php
    // dd($customs);
    // dd(get_defined_vars()['__data']);

    $view_load_theme = 'base';
    session()->put('url.back', url()->current());
@endphp

@section('header_sub')
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <h2>{{ __('Show items') }}</h2>
            </div>
        </div>
    </div>
@endsection

@once
    @push('after_header')
        {{-- <link href="{{ asset('theme/' . $view_load_theme . '/css/admin_show_release_css.css') }}" rel="stylesheet" type="text/css"> --}}
        <style>
            .d-none {
                display: none !important;
            }

            .form-check-custom {
                display: flex;
                align-items: center;
                margin: 0;
            }
        </style>
    @endpush
@endonce

@section('header_sub')
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <h2>{{ __('Danh sách Release') }}</h2>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-12" id="manage_item">
        <div class="table-list-all-release">
            <div class="card card-custom card-fit">
                <div class="card-header">
                    <div class="card-title">
                        <h3>{{ __('Danh sách ') . $crud->title }} </h3>

                    </div>
                    <div class="card-toolbar">
                        <div id="datatable_info_stack" class="mr-2"> </div>

                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end ml-2" data-kt-docs-table-toolbar="base">
                            <!--begin::Add customer-->
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip"
                                data-action-create-item='{{ $crud->route . '/create' }}'
                                title="Add new {{ $crud->title }}">
                                <i class="flaticon2-plus icon-nm"></i>
                                Add {{ $crud->title }}
                            </button>
                            <!--end::Add customer-->
                        </div>
                        <!--end::Toolbar-->

                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none ml-2"
                            data-kt-docs-table-toolbar="selected">
                            <div class="fw-bold me-5">
                                <span class="mr-1" data-kt-docs-table-select="selected_count"></span> Selected
                            </div>

                            <button type="button" class="btn btn-danger ml-2" data-kt-docs-table-select="delete_selected"
                                data-bs-toggle="tooltip" title="Delete Selections">
                                Selection Action
                            </button>
                        </div>
                        <!--end::Group actions-->
                    </div>
                </div>
                <div class="card-body py-0 overlay-parent">
                    <div class="table-responsive">
                        <table id="tableproduct" class="table table-striped table-row-bordered gy-5 gs-7"
                            style="width: 100%">
                            <thead>
                                <tr class="fw-semibold fs-6 text-gray-800">
                                    <th class="w-10px pe-2 align-items-center">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                data-kt-check-target="#tableproduct .form-check-input" value="1" />
                                        </div>
                                    </th>
                                    @foreach ($crud->columns as $column)
                                        <th class="font-weight-bold font-size-lg" data-visible-in-modal="true">
                                            {{ $column['label'] }}
                                        </th>
                                    @endforeach
                                    <th class="text-end min-w-100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                            </tbody>
                        </table>
                    </div>
                    <div class="overlay-child" v-if="isLoading"></div>
                </div>

                <div class="card-footer pt-0">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    @include('customcontainer::crud.inc.datatable')
@endsection
