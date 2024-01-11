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
            <div class="py-2">
                <div v-if="error" v-html="error"></div>
                <div v-if="success" v-html="success"></div>
            </div>

            <div class="card card-custom card-fit">
                <div class="card-header">
                    <div class="card-title">
                        <h3>{{ __('Danh sách ') . $crud->title }} </h3>
                    </div>
                    <div class="card-toolbar">
                        <i class="flaticon2-reload cursor-pointer reset_params" data-toggle="tooltip" title="Reset">
                        </i>
                    </div>
                </div>

                <div class="card-body py-0 overlay-parent">
                    <div class="table-responsive">
                        <table id="tableproduct" class="table table-striped table-row-bordered gy-5 gs-7">
                            <thead>
                                <tr class="fw-semibold fs-6 text-gray-800">
                                    <th class="w-10px pe-2 align-items-center">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                data-kt-check-target="#kt_datatable_example_1 .form-check-input"
                                                value="0" />
                                        </div>
                                    </th>
                                    @foreach ($crud->columns as $column)
                                        <th class="min-w-200px">
                                            {{ $column['label'] }}
                                        </th>
                                    @endforeach
                                    <th class="text-end min-w-100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
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
    <script>
        var KTDatatableHtmlTableDemo = (function() {
            var setup = function() {
                var datatable = $('#tableproduct').DataTable({
                    data: @json($items->items()),
                    select: {
                        style: 'multi',
                        selector: 'td:first-child input[type="checkbox"]',
                        className: 'row-selected'
                    },
                    columns: [{
                            data: 'RecordID'
                        },
                        @foreach ($crud->columns as $column)
                            {
                                data: '{{ $column['name'] }}',
                            },
                        @endforeach {
                            data: null
                        },
                    ],
                    columnDefs: [{
                            targets: 0,
                            orderable: false,
                            render: function(_, _, data) {
                                return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="${data.id}" />
                            </div>`;
                            }
                        },
                        {
                            targets: -1,
                            data: null,
                            orderable: false,
                            className: 'text-end',
                            render: function(data, type, row) {
                                return `
                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                        Actions
                                        <span class="svg-icon fs-5 m-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                    <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                                </g>
                                            </svg>
                                        </span>
                                    </a>
                                `;
                            },
                        },
                    ],
                    searching: true,
                    paging: true,
                    scrollX: true,
                    processing: true,
                    info: true,

                });
            }
            return {
                init: function() {
                    setup();
                }
            };
        })();
        $(document).ready(function() {
            KTDatatableHtmlTableDemo.init();
        });
    </script>
@endsection
