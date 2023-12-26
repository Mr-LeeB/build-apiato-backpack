<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body class="">


    <div class="app-body">


        <main class="main pt-2">

            @yield('before_breadcrumbs_widgets')


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
    </footer>

    @yield('before_scripts')
    @stack('before_scripts')


    @yield('after_scripts')
    @stack('after_scripts')
</body>

</html>
