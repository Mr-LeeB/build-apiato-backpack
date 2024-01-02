@extends('customcontainer::layout.app_admin_nova')

@section('title')
    {{ __('Detail Release') }}
@endsection

@php
    $view_load_theme = 'base';
@endphp

@section('header_sub')
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <h2>{{ __('Detail Release') }}</h2>
            </div>
        </div>
    </div>
@endsection

@once
    @push('after_header')
        <link href="{{ asset('theme/' . $view_load_theme . '/css/admin_show_detail_css.css') }}" rel="stylesheet" type="text/css">
    @endpush
@endonce

@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('.image').click(function() {
                var src = $(this).attr('src');
                $('.image').removeClass('active-img');
                $(this).addClass('active-img');
                $('#image').attr('src', src);
            });

            var src = $('.image').attr('src');
            $('#image').attr('src', src);

            document.getElementsByClassName('image')[0].classList.add('active-img');
        });
    </script>
@endsection


@section('php')
    @php
        
    @endphp
@endsection

@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-4 align-items-center image-container">
                <div class="image-title">
                    <h1>Images</h1>
                </div>

                <img class="mb-4 mt-4" src="" alt="name" id="image" width="300px">

                <div class="scroll-container">
                    @if ($release->images != null)
                        @foreach ($release->images as $image)
                            <img src="{{ asset($image) }}" alt="name" class="image" width="80px">
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-8 content-container">
                <div class="content-name">
                    <h1>{{ $release->name }}</h1>
                </div>
                <div class="content-title-description">
                    <p> <strong>Title: </strong> {!! $release->title_description !!}</p>
                    <p><strong>Description: </strong><br />{!! $release->detail_description !!}</p>
                </div>
                <div class="content-date">
                    <p> <strong>Date Created: </strong> {{ substr($release->created_at, 0, 10) }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
