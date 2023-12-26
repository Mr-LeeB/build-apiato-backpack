<div id="kt_header" class="header header-fixed">
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                @if (\Auth::check())
                    
                    @if (1==2)
                    <ul class="menu-nav">
                        <li class="menu-item menu-item-submenu menu-item-open-dropdown" data-menu-toggle="click" aria-haspopup="true">
                            <a href="javascript:;" class="menu-link menu-toggle btn bg-primary">
                                <span class="menu-text font-weight-bold text-light">Seller Center</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu menu-submenu-fixed menu-submenu-left" style="width:1000px">
                                <div class="menu-subnav">
                                    <ul class="menu-content">
                                        <li class="menu-item">
                                            <h3 class="menu-heading menu-toggle">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Menu</span>
                                                <i class="menu-arrow"></i>
                                            </h3>
                                            <ul class="menu-inner">
                                                <li class="menu-item" aria-haspopup="true">
                                                    <a href="{{URL::route('subscription.index')}}" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Quản lý Subscription</span>
                                                    </a>
                                                </li>    
                                                <li class="menu-item" aria-haspopup="true">    
                                                    <a href="{{URL::route('product.index')}}" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Quản lý Product</span>
                                                    </a>
                                                </li>    
                                                <li class="menu-item" aria-haspopup="true">    
                                                    <a href="{{URL::route('plan.index')}}" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Quản lý Plan</span>
                                                    </a>
                                                </li>    
                                                <li class="menu-item" aria-haspopup="true">    
                                                    <a href="{{URL::route('item.index')}}" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Quản lý Item</span>
                                                    </a>
                                                </li>    
                                                <li class="menu-item" aria-haspopup="true">
                                                    <a href="{{URL::route('service.index')}}" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Quản lý Dịch vụ</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-item">
                                            <h3 class="menu-heading menu-toggle">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text text-uppercase">System</span>
                                                <i class="menu-arrow"></i>
                                            </h3>
                                            <ul class="menu-inner">
                                                <li class="menu-item" aria-haspopup="true">
                                                    <a href="{{URL::route('referral.index')}}" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Quản lý Referral</span>
                                                    </a>
                                                </li>    
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                    @endif
                @endif
            </div>
        </div>
        <div class="topbar">
            @if (\Auth::check())
                <!-- <div class="topbar-item">
                    <span class="btn-transparent-success font-weight-bold mr-3 text-light"><b>Số dư: {!!\Auth::user()->cv_balance!!}</b></span>
                </div> -->
                <div class="topbar-item">
                    <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                        <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-2">{{\Auth::user()->name}}</span>
                        <span class="symbol-label font-size-h5 font-weight-bold">
                            <img src="{{asset('theme/base/images/profile.png')}}" class="img-fluid" style="width:32px">
                        </span>
                    </div>
                    <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
                        <!--begin::Header-->
                        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5" kt-hidden-height="40" style="">
                            <h3 class="font-weight-bold m-0">
                                Profile
                                <!-- <small class="text-muted font-size-sm ml-2">12 messages</small> -->
                            </h3>
                            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                        <!--end::Header-->
                        <!--begin::Content-->
                        <div class="offcanvas-content pr-5 mr-n5 scroll ps ps--active-y" style="height: 432px; overflow: hidden;">
                            <!--begin::Header-->
                            <div class="d-flex align-items-center mt-5">
                                <div class="symbol symbol-100 mr-5">
                                    <div class="symbol-label">
                                        <img src="{{asset('theme/base/images/profile.png')}}" class="img-fluid">
                                    </div>
                                    <i class="symbol-badge bg-success"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-danger">{{\Auth::user()->name}}</a>
                                    <div class="text-muted mt-1">{{\Auth::user()->phone}}</div>
                                    <div class="navi mt-2">
                                        <a href="#" class="navi-item">
                                            <span class="navi-link p-0 pb-2">
                                                <span class="navi-icon mr-1">
                                                    <span class="svg-icon svg-icon-lg svg-icon-primary">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000"></path>
                                                                <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"></circle>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                                <span class="navi-text text-muted text-hover-primary">{{\Auth::user()->email}}</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed mt-8 mb-5"></div>
                            <!--end::Separator-->
                            <!--begin::Nav-->
                            <div class="navi navi-spacer-x-0 p-0">
                          
                                <!-- <a href="system/profile" class="navi-item">
                                    <div class="navi-link">
                                        <div class="symbol symbol-40 bg-light mr-3">
                                            <div class="symbol-label">
                                                <i class="flaticon2-calendar-3"></i>
                                            </div>
                                        </div>
                                        <div class="navi-text">
                                            <div class="font-weight-bold">Thông tin cá nhân</div>
                                        </div>
                                    </div>
                                </a> -->

                                <!-- <a href="#" class="navi-item">
                                    <div class="navi-link">
                                        <div class="symbol symbol-40 bg-light mr-3">
                                            <div class="symbol-label">
                                                <i class="flaticon2-settings"></i>
                                            </div>
                                        </div>
                                        <div class="navi-text">
                                            <div class="font-weight-bold">Cài đặt</div>
                                        </div>
                                    </div>
                                </a> -->

                                <!-- <a href="system/change_password" class="navi-item">
                                    <div class="navi-link">
                                        <div class="symbol symbol-40 bg-light mr-3">
                                            <div class="symbol-label">
                                                <i class="flaticon2-edit"></i>
                                            </div>
                                        </div>
                                        <div class="navi-text">
                                            <div class="font-weight-bold">Đổi mật khẩu</div>
                                        </div>
                                    </div>
                                </a> -->

                                <a href="/system/logout" class="navi-item">
                                    <div class="navi-link">
                                        <div class="symbol symbol-40 bg-light mr-3">
                                            <div class="symbol-label">
                                                <i class="fa fa-sign-out-alt"></i>
                                            </div>
                                        </div>
                                        <div class="navi-text">
                                            <div class="font-weight-bold">Thoát</div>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="topbar-item topbar-item--user">
                    <a href="{{URL::route('user.login')}}" class="btn btn-danger mr-5">
                        <i class="fa fa-sign-in-alt"></i> Đăng nhập
                    </a>
                </div>
                <!-- <div class="topbar-item topbar-item--user">
                    <a href="{{URL::route('user.register')}}" class="btn btn-danger">
                        <i class="fa fa-user"></i> Đăng ký
                    </a>
                </div> -->
            @endif
        </div>
    </div>
</div>
