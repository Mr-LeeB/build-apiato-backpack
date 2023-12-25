@extends('releasevuejs::layout.app_admin_nova')

@section('title')
    {{ __('Release') }}
@endsection

@php
    $view_load_theme = 'base';
@endphp

@section('header_sub')
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <h2>{{ __('Show Releases') }}</h2>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-custom">
                    <!-- begin:Header -->
                    <div class="card-header border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h2 class="card-label ">Timeline</h2>
                        </div>
                    </div>
                    <!-- end:header -->
                    <!-- begin:body -->
                    <div class="card-body">
                        <!-- begin:TimeLine -->
                        <!-- begin:Search Form -->
                        <!-- begin::Search Form -->
                        <!-- <div class="mb-7">
                                <div class="row align-items-center">
                                    <div class="col-lg-9 col-xl-8">
                                        <div class="row algin-items-center">
                                            <div class="col-md-4 my-2 my-md-0">
                                                <div class="input-icon">
                                                    <input type="text" class="form-control"
                                                        placeholder="Search..." id="kt_datatimeline">
                                                    <span>
                                                        <i class="flaticon2-search-1 text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-5 mt-lg-0">
                                                <a href="#"
                                                    class="btn btn-light-primary px-6 font-weight-bold">Search</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        <!-- end:Search Form -->
                        <!-- end:Search Form -->
                        <!-- begin:timeline -->
                        <div class="example example-basic">
                            <div class="example-preview">
                                <div class="timeline timeline-4">
                                    <div class="timeline-bar"></div>
                                    <div class="timeline-items">
                                        <div class="timeline-item timeline-item-left">
                                            <div class="timeline-badge">
                                                <div class="bg-success"></div>
                                            </div>

                                            <div class="timeline-label">
                                                <span class="text-dark-50 font-weight-bold">12/7/2023</span>
                                            </div>

                                            <div class="timeline-content max-h-150px overflow-auto">
                                                <span class="text-dark-75">
                                                    Cập Nhập Phiên Bản Mới Version
                                                    <a href="#" class="text-hover-dark">1.0.1</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="timeline-item timeline-item-right">
                                            <div class="timeline-badge">
                                                <div class="bg-primary"></div>
                                            </div>
                                            <div class="timeline-label text-primary">
                                                <span class="text-primary font-weight-bold">15/8/2023</span>
                                            </div>
                                            <div class="timeline-content max-h-150px overflow-auto">
                                                <span class="text-dark-75">
                                                    Chinhr sửa cấu hình nâng cấp

                                                    <a href="#" class="text-hover-dark">1.0.1</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="timeline-item timeline-item-left">
                                            <div class="timeline-badge">
                                                <div class="bg-success"></div>
                                            </div>

                                            <div class="timeline-label text-primary">
                                                <span class="text-primary font-weight-bold">29/9/2023</span>
                                            </div>


                                            <div class="timeline-content max-h-150px overflow-auto">
                                                <span class="text-dark-75">
                                                    Cập Nhập Phiên Bản Mới Version
                                                    đậldlajdljaldjoqwelqjweoijqwlendashdahsdkahdahsdashdkhoiwhekfohkhqowehkhdasdoahskdhiwqehkhdiywiqhekhdiuashdkiwqhekhdiuasdhkhwqeykadhaykqwhe8qwyekhdaydhkahdaydqhweuykdbakuydiqwheka
                                                    <a href="#" class="text-hover-dark">2.0.1</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="timeline-item timeline-item-right">
                                            <div class="timeline-badge">
                                                <div class="bg-primary"></div>
                                            </div>
                                            <div class="timeline-label text-primary">
                                                <span class="text-primary font-weight-bold">15/8/2023</span>
                                            </div>
                                            <div class="timeline-content max-h-150px overflow-auto">
                                                <span class="text-dark-75">
                                                    Chinhr sửa cấu hình nâng cấp

                                                    <a href="#" class="text-hover-dark">1.0.1</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:timeline -->
                        <!-- begin:pagination-->
                        <!-- <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-center flex-wrap"
                                    id="pagination">
                                    <div class=" d-flex flex-wrap py-1 mr-2">
                                        <a href="#" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i
                                                class="ki ki-bold-double-arrow-back icon-xs"></i></a>
                                        <a href="#" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i
                                                class="ki ki-bold-arrow-back icon-xs"></i></a>

                                        <a href="#"
                                            class="btn btn-icon btn-sm border-0 btn-light btn-hover-primary active mr-2 my-1">1</a>
                                        <a href="#"
                                            class="btn btn-icon btn-sm border-0 btn-light mr-2 my-1">2</a>
                                        <a href="#"
                                            class="btn btn-icon btn-sm border-0 btn-light mr-2 my-1">3</a>
                                        <a href="#"
                                            class="btn btn-icon btn-sm border-0 btn-light mr-2 my-1">...</a>

                                        <a href="#" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i
                                                class="ki ki-bold-arrow-next icon-xs"></i></a>
                                        <a href="#" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i
                                                class="ki ki-bold-double-arrow-next icon-xs"></i></a>
                                    </div>


                                    <div class="d-flex align-items-center py-3">
                                        <select
                                            class="form-control form-control-sm font-weight-bold mr-4 border-0 bg-light"
                                            style="width: 75px;">
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="30">30</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                        <span class="text-muted">Displaying 10 of 230 records</span>
                                    </div>

                                </div>
                            </div> -->
                        <!-- begin:pagination-->


                        <!-- end:TimeLine -->
                        <!-- end:Minh -->
                    </div>
                    <!--end::Content-->
                    <!--begin::Footer-->
                    <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
                        <!--begin::Container-->
                        <div
                            class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <!--begin::Copyright-->
                            <div class="text-dark order-2 order-md-1">
                                <span class="text-muted font-weight-bold mr-2">2020©</span>
                                <a href="http://keenthemes.com/metronic" target="_blank"
                                    class="text-dark-75 text-hover-primary">Keenthemes</a>
                            </div>
                            <!--end::Copyright-->
                            <!--begin::Nav-->
                            <div class="nav nav-dark">
                                <a href="http://keenthemes.com/metronic" target="_blank"
                                    class="nav-link pl-0 pr-5">About</a>
                                <a href="http://keenthemes.com/metronic" target="_blank"
                                    class="nav-link pl-0 pr-5">Team</a>
                                <a href="http://keenthemes.com/metronic" target="_blank"
                                    class="nav-link pl-0 pr-0">Contact</a>
                            </div>
                            <!--end::Nav-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Footer-->
                </div>
            </div>
        </div>
    </div>
@endsection
