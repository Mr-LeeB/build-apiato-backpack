@extends('clients::layout.layout_cloud')

@section('title')
    {{ 'CHI CẬP NHẬT' }}
    {!! '<i class="far fa-eye text-success"></i> <i class="far fa-eye text-warning"></i>' !!}
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

        input[type="checkbox"] {
            vertical-align: middle;
            display: -webkit-inline-flex;
        }
    </style>
@endsection

@section('php')
    @php
        $releases[] = $items;
        $releases = [];

        //Get max created_at
        $latest_entry = DB::table('clients')->max('created_at');

    @endphp
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
                    columns: [
                        @foreach ($crud->columns as $column)
                            {
                                className: @if ($column['type'] == 'text')
                                    'dt-right'
                                @else
                                    'dt-left'
                                @endif ,
                                data: '{{ $column['name'] }}',
                            },
                        @endforeach {
                            data: null
                        },
                    ],
                    columnDefs: [{
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
                    }, ],
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
            DatatableHtmlTableDemo.init();
        });
    </script>
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
        <div class="card card-custom gutter-b">

            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label"></h3>
                </div>
            </div>

            <div class="card-body">
              <table id="tableproduct" class="table table-striped table-row-bordered table-hover gy-5 gs-7">
                <thead>
                    <tr>

                        @foreach ($crud->columns as $column)
                            <th
                                class="min-w-200px
                  @switch($column['type'])
                    @case('number')
                      {{ 'dt-right' }}
                      @break
                    @case('text')
                      {{ 'dt-left' }}
                    @break
                    @case('date')
                      {{ 'dt-center' }}
                    @break
                    @default

                  @endswitch">
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


        </div>
    </div>
@endsection


@section('footer')
    Footer placeholder nhưng mà hình như không có set attribute 'yield' hoặc em 'yield' sai chỗ
@endsection
