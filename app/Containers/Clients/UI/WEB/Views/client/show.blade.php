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
    <script type="text/javascript">

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
    <div id="kt_datatable" class="datatable datatable-bordered datatable-head-custom datatable-default datatable-select datatable-rowgroup datatable-rowgroup-selected">

    </div>
@endsection


@section('footer')
    Footer placeholder nhưng mà hình như không có set attribute 'yield' hoặc em 'yield' sai chỗ
@endsection
