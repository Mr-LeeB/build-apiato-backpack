<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>
    @include('customcontainer::base.inc.head')

</head>

<body class="">

    @include('customcontainer::base.inc.main_header')

    <div class="app-body">

        @include('customcontainer::base.inc.sidebar')

        <main class="main pt-2">

            @yield('before_breadcrumbs_widgets')

            @includeWhen(isset($breadcrumbs), 'customcontainer::base.inc.breadcrumbs')

            @yield('after_breadcrumbs_widgets')

            @yield('header')

            <div class="container-fluid animated fadeIn">

                @yield('before_content_widgets')

                @yield('content')

                @yield('after_content_widgets')

            </div>

        </main>

    </div><!-- ./app-body -->

    <footer class="">
        @include('customcontainer::base.inc.footer')
    </footer>

    @yield('before_scripts')
    @stack('before_scripts')

    @include('customcontainer::base.inc.scripts')

    @yield('after_scripts')
    @stack('after_scripts')
</body>

</html>
