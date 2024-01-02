<!DOCTYPE html>

<head>
    @include('customcontainer::layout.template.head_admin')
    <link href="{{ asset('/theme/base/nova_assets/css/admin-nova.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/theme/base/nova_assets/css/custom.css') }}?version=04082023" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    {{-- import ajax_setting from resource --}}
    <script src="{{ asset('/theme/base/js/utils/ajax_setting.js') }}"></script>
    <script src="{{ asset('/theme/base/js/utils/paginate_setting.js') }}"></script>


</head>
<style>
    .pagination {
        float: right !important;
        margin-bottom: 10px !important;
    }
</style>
<!--end::Head-->
<!--begin::Body-->

<body>
    <div class="nova" id="nova">
        <!-- DashBoard -->
        <div class="nova-dashboards">
            <!-- Menu -->
            <div class="nova-sidebar">
                @include('customcontainer::layout.template.sidebar_admin_nova')
            </div>
            <!-- End Menu -->
            <!-- Content -->
            <div class="contents">
                <div class="content-nova">
                    <!-- <a href="#" class="nova2">Billing</a> -->
                    <span class="nova2">@yield('header_sub', '')</span>
                    <div class="nova-search">
                        <div class="search-icon1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-labelledby="search"
                                role="presentation" class="nova-one">
                                <path fill-rule="nonzero"
                                    d="M14.32 12.906l5.387 5.387a1 1 0 0 1-1.414 1.414l-5.387-5.387a8 8 0 1 1 1.414-1.414zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z">
                                </path>
                            </svg>

                        </div>
                        <!--  -->
                        <!--  -->
                        <!--  -->
                        <input dusk="global-search" type="search" placeholder="Press / to search"
                            class="nova-search-input" />
                    </div>
                    <!-- Release Version 1.2.2 -->
                    <div class="nova-name">
                        <div class="trigger">
                            <div class="dropdown-trigger-group" role="group">
                                <!-- <a href="#" class="button-two"> Release Version 1.2.2 </a> -->
                                <!-- <span class="button-two"> Release Version 1.2.2 </span> -->
                                <a href="#" id="btnUserDropdown" class="dropdown-trigger" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="text-one"> {{ auth()->user()->name ?? '' }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 6" class="svg-one">
                                        <path
                                            d="M8.292893.292893c.390525-.390524 1.023689-.390524 1.414214 0 .390524.390525.390524 1.023689 0 1.414214l-4 4c-.390525.390524-1.023689.390524-1.414214 0l-4-4c-.390524-.390525-.390524-1.023689 0-1.414214.390525-.390524 1.023689-.390524 1.414214 0L5 3.585786 8.292893.292893z">
                                        </path>
                                    </svg>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnUserDropdown"
                                    x-placement="bottom-start">
                                    {{-- <a class="dropdown-item" href="{{ route('nova.logout') }}"> Logout </a> --}}
                                    <a class="dropdown-item" href="/system/nova-password-reset"> Reset My Password </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content2">
                    @if (session('message_success') || session('message_error'))
                        <div class="row">
                            <div class="col-md-12">
                                @if (session('message_success'))
                                    <div class="d-flex align-items-center bg-light-success rounded p-5 mb-9">
                                        <div class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">
                                            {!! session('message_success') !!}</div>
                                    </div>
                                @endif
                                @if (session('message_error'))
                                    <div class="d-flex align-items-center bg-light-danger rounded p-5 mb-9">
                                        <div class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">
                                            {!! session('message_error') !!}...</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                    @yield('content')
                </div>
                <p class="footer">
                    <a href="#" class="footer-nova">Seller Center</a>
                    ©2020
                </p>
            </div>
            <!-- End Content -->
        </div>
    </div>
    <!-- Build Nova Instance -->



    <!-- Tool Scripts -->
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1200
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#6993FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#F3F6F9",
                        "dark": "#212121"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1E9FF",
                        "secondary": "#ECF0F3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#212121",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#ECF0F3",
                    "gray-300": "#E5EAEE",
                    "gray-400": "#D6D6E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#80808F",
                    "gray-700": "#464E5F",
                    "gray-800": "#1B283F",
                    "gray-900": "#212121"
                }
            },
            "font-family": "Poppins"
        };
    </script>

    @php
        $view_load_theme = 'base';
    @endphp

    <script type="text/javascript" src="{{ asset('theme/' . $view_load_theme . '/js/plugins.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/' . $view_load_theme . '/js/prismjs.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/' . $view_load_theme . '/js/scripts.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/' . $view_load_theme . '/js/jsutils.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/' . $view_load_theme . '/js/auto.increase.money.js') }}"></script>
    <!-- Start Nova -->
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#5d78ff",
                    "dark": "#282a3c",
                    "light": "#ffffff",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": [
                        "#c5cbe3",
                        "#a1a8c3",
                        "#3d4465",
                        "#3e4466"
                    ],
                    "shape": [
                        "#f0f3ff",
                        "#d9dffa",
                        "#afb4d4",
                        "#646c9a"
                    ]
                }
            }
        };

        $(document).ready(function() {
            // $('.select2').select2({
            //     placeholder: 'Vui lòng chọn option',
            // });

            $("[data-button-type=delete]").click(function(e) {
                e.preventDefault();
                var delete_url = $(this).attr('href');
                if (confirm("Bạn có chắc muốn xóa dữ liệu này?") == true) {
                    window.location.replace(delete_url);
                }
            });
        });
    </script>

    <!-- collapsible menu -->
    <script type="text/javascript">
        // $('.content').css("display","none")
        $('.collapsible').css("cursor", "pointer")
        $('.collapsible').on('click', function() {
            var content = $(this)
            content.nextUntil("li.collapsible").slideToggle()
            if (content.hasClass('active')) {
                content.removeClass('active')
            } else {
                content.addClass('active')
            }
        });
        // Keep active on the current menu
        $(`a[href^="${window.location.pathname}"]`).closest('.top-level').addClass('active');
    </script>
    <!-- collapsible menu -->
    <!-- Jquery menu -->
    <script>
        $(".nova-text").click(function() {
            $(this).closest(".top-level").toggleClass('active');
        });
    </script>
    <!-- End Jquery Menu -->
    @yield('javascript')
    @yield('css')
    @stack('after_script')
</body>
<!--end::Body-->

</html>
