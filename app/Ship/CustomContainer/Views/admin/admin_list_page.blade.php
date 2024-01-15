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
    <script>
        var DatatableHtmlTableDemo = (function() {
            var setup = function() {
                var datatable = $('#tableproduct').DataTable({
                    data: @json($items->items()),
                    select: {
                        style: 'multi',
                        selector: 'td:first-child input[type="checkbox"]',
                        className: 'row-selected'
                    },
                    columns: [{
                            data: null
                        },
                        @foreach ($crud->columns as $column)
                            {
                                data: '{{ $column['name'] }}'
                            },
                        @endforeach {
                            data: null
                        },
                    ],
                    columnDefs: [{
                            targets: 0,
                            orderable: false,
                            data: null,
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
                                console.log(data, type, row)
                                return `
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-active-light-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{!! url($crud->route) !!}/${data.id}/show">Show</a>
                                            <a class="dropdown-item" href="{!! url($crud->route) !!}/${data.id}/edit">Edit</a>
                                            <div class="dropdown-item btn btn-danger" click='onDelete'>Delete</div>
                                        </div>
                                    </div>
                                `;
                            },
                        },
                    ],
                    searching: true,
                    paging: true,
                    scrollX: true,
                    processing: true,
                    info: true,
                    order: [
                        [1, 'none']
                    ],
                });
            }
            return {
                init: function() {
                    setup();
                }
            };
        })();
        $(document).ready(function() {
            DatatableHtmlTableDemo.init();
        });
    </script>
@endsection
