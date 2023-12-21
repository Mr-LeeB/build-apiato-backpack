@php
    // use \App\Lib\AdminAsideMenu;
    // $menus = new AdminAsideMenu();
    // $menus = $menus->getMenuData();
@endphp
<!-- Logo -->
<div class="logo-nova">
    {{-- <a href="/system">
        <img src="{{asset('storage/'.$view_load_namespace.'/images/logo.png')}}" alt="" />
    </a> --}}
</div>
@php
    $menus = [
        [
            'label' => 'Dashboard',
            'children' => [
                [
                    'label' => 'Dashboard',
                    'url' => '/#',
                ],
                [
                    'label' => 'Dashboard 2',
                    'url' => '/#',
                ],
            ],
        ],
        [
            'label' => 'Users',
            'children' => [
                [
                    'label' => 'Users',
                    'url' => '/#',
                ],
                [
                    'label' => 'Users 2',
                    'url' => '/#',
                ],
            ],
        ],
        [
            'label' => 'Roles',
            'children' => [
                [
                    'label' => 'Roles',
                    'url' => '/#',
                ],
                [
                    'label' => 'Roles 2',
                    'url' => '/#',
                ],
            ],
        ],
        [
            'label' => 'Permissions',
            'children' => [
                [
                    'label' => 'Permissions',
                    'url' => '/authorization',
                ],
            ],
        ],
        [
            'label' => 'Release',
            'children' => [
                [
                    'label' => 'Show Release',
                    'url' => '/releasevuejs',
                ],
                [
                    'label' => 'Create Release',
                    'url' => '/releasevuejs/new',
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
                    <li class="leading1">
                        <div>
                            <a href="{{ $child['url'] ?? '#' }}" target="_self">
                                <div class="items-center" style="width: 100%">
                                    @if (strpos(request()->fullUrl(), $child['url']) !== false)
                                        <span class="text" style="width: 20%; display: inline-block">
                                            {!! '<i class="fa fa-eye" aria-hidden="true"></i>' !!}
                                        </span>
                                    @endif
                                    <span class="text"
                                        style="wdith: 80%; display: inline-block; @if (strpos(request()->fullUrl(), $child['url']) !== false) {{ 'font-weight: bold; font-style: italic' }} @endif">
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
