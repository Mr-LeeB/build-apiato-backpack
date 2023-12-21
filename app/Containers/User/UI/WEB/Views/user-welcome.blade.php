<!DOCTYPE html>
<html>

<head>
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 96px;
        }

        .form {
            position: absolute;
            z-index: 1;
            max-width: 360px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
            top: 10px;
            right: 10px;
            border-radius: 10px;
        }

        .form button {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            background: #9e1d4c;
            outline: 0;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            cursor: pointer;
            border-radius: 10px
        }

        .form button:hover,
        .form button:active,
        .form button:focus {
            background: #00bdf4;
        }
    </style>
    <script>
        function confirmLogout() {
            if (confirm("Are you sure you want to logout?")) {
                document.querySelector('.form').submit();
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="title">Welcome Anonymous User :)</div>
            <form class="form" action="{{ route('post_user_logout_form') }}" method="post">
                {{ csrf_field() }}
                <button type="button" onclick="confirmLogout()">
                    logout
                </button>
            </form>
        </div>
    </div>
</body>


</html>
