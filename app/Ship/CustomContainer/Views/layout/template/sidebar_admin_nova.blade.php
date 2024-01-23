@php
    // use \App\Lib\AdminAsideMenu;
    // $menus = new AdminAsideMenu();
    // $menus = $menus->getMenuData();
@endphp
<!-- Logo -->
<div class="logo-nova">
    <a href="#">
        <img src="{{ asset('storage/images/logo.png') }}" alt="" />
        {{-- <img src="{{ asset('storage/' . $view_load_namespace . '/images/logo.png') }}" alt="" /> --}}
    </a>
</div>
@php
    $menus = [
        [
            'label' => 'Admin',
            'children' => [
                [
                    'label' => 'Dashboard',
                    'url' => '/admin/dashboard',
                ],
            ],
        ],
        [
            'label' => 'Users',
            'children' => [
                [
                    'label' => 'Users fake BP',
                    'url' => '/admin/user',
                ],
                [
                    'label' => 'User normal',
                    'url' => '/users',
                ],
            ],
        ],
        [
            'label' => 'Products',
            'children' => [
                [
                    'label' => 'Product fake BP',
                    'url' => '/admin/product',
                ],
                [
                    'label' => 'Product normal',
                    'url' => '/products',
                ],
            ],
        ],
    ];
@endphp
<!-- End Logo -->
<div class="nova-menu">
    @foreach ($menus as $menu)
        <div class="top-level">
            <h3 class="nova-text">
                <div class="nova-icon">
                    <svg class="img1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="theme-icon">
                    <div class="text-nova">
                        <span>{{ $menu['label'] ?? '' }}</span>
                        <div class="nova1">
                            <div class="nova1">
                                <svg class="box plus" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor"
                                        d="M13 11h2c.55 0 1 .45 1 1s-.45 1-1 1h-2v2c0 .55-.45 1-1 1s-1-.45-1-1v-2H9c-.55 0-1-.45-1-1s.45-1 1-1h2V9c0-.55.45-1 1-1s1 .45 1 1v2z">
                                    </path>
                                </svg>
                                <svg class="box minus" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor"
                                        d="M16 12c0 .55-.45 1-1 1H9c-.55 0-1-.45-1-1s.45-1 1-1h6c.55 0 1 .45 1 1z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
            </h3>
            <!-- Danh sách ul -->
            <ul class="nova1-list">
                @foreach ($menu['children'] ?? [] as $child)
                    @php
                        $pos = strpos(request()->fullUrl(), $child['url']);
                    @endphp
                    <li class="leading1">
                        <div>
                            <a href="{{ $child['url'] ?? '#' }}" target="_self">
                                <div class="items-center" style="width: 100%">
                                    @if ($pos !== false && substr(request()->fullUrl(), $pos + strlen($child['url']), 1) !== '/')
                                        <span class="text" style="width: 20%; display: inline-block">
                                            {!! '<i class="fa fa-eye cursor-pointer" aria-hidden="true"></i>' !!}
                                        </span>
                                    @endif
                                    <span class="text"
                                        style="display: inline-block; @if ($pos !== false && substr(request()->fullUrl(), $pos + strlen($child['url']), 1) !== '/') {{ 'font-weight: bold; font-style: italic' }} @endif">
                                        {{ $child['label'] ?? '' }}
                                    </span>
                                </div>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
