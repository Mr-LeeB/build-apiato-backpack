@extends('clients::layout.layout_cloud')

@section('title')
    {{ 'CHI CẬP NHẬT' }}
    {!! '<i class="far fa-eye text-success"></i> <i class="far fa-eye text-warning"></i>' !!}
    {!! '<button id="clickme">Click Me</button>' !!}
@endsection

@section('css')
    <style>
        @include('clients::css.custom');
    </style>

    <style>
        .five-lines {
            display: -webkit-box;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .d-none {
            display: none !important;
        }

        .form-check-custom {
            display: flex;
            align-items: center;
            margin: 0;
        }
    </style>
@endsection

@section('php')
    @php
        // dd(get_defined_vars()['__data']);
        // dd($crud);

        //Get max created_at
        // $latest_entry = DB::table('clients')->max('created_at');
    @endphp
@endsection

@section('header_sub')
    {{-- Header/Title --}}
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <h2>{{ __('Show Releases - Cliént') }}</h2>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div name="contentDisplay" class="container-fluid">
        <div class="card card-custom gutter-b" id="resizeElement">

            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label"></h3>
                </div>

                <div class="card-toolbar">
                    <div id="datatable_info_stack" class="mr-2"> </div>

                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end ml-2" data-kt-docs-table-toolbar="base">
                        <!--begin::Add customer-->
                        <button type="button" class="btn btn-primary" data-bs-toggle="tooltip"
                            data-action-create-item='{{ $crud->route . '/create' }}' title="Add new {{ $crud->title }}">
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
                    <table id="tableproduct" class="table table-striped table-row-bordered gy-5 gs-7" style="width: 100%">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800">
                                <th class="w-10px pe-2 align-items-center">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#tableproduct .form-check-input" value="1" />
                                    </div>
                                </th>
                                @foreach ($crud->columns as $column)
                                    <th class="font-weight-bold font-size-lg">
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


        </div>
    </div>
@endsection

@section('javascript')
    @include('customcontainer::crud.inc.datatable')
@endsection


@section('footer')
    Footer placeholder nhưng mà hình như không có set attribute 'yield' hoặc em 'yield' sai chỗ
@endsection
