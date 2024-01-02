<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#show_item_by_call_ajax').on('click', function() {
                $.ajax({
                    url: "{{ route('find_user_by_id', 1) }}",
                    type: "GET",
                    success: function(data) {
                        console.log('true: ', data);
                        $('#show_value').html(data.byId[0].name);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            })
        });
    </script>
</head>

<body>
    @php
        // dd(get_defined_vars()['__data']);
    @endphp
    @if (!isset($items['byId']) && !isset($items['byName']) && count($items) > 0)
        @foreach ($items as $item)
            <form action="{{ route('update_user', $item->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="text" name="name" placeholder="name" value="{{ $item->name }}">
                <input type="text" name="email" placeholder="email" value="{{ $item->email }}">
                <input type="text" name="password" placeholder="password">
                <input type="submit" value="submit">
            </form>
        @endforeach

        @if (session('errors'))
            <div class="text-red">{{ session('errors') }}</div>
        @endif
        <br />
        <br />
        <br />

        @foreach ($items as $item)
            <form action="{{ route('delete_user', $item->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type="text" name="name" placeholder="name" value="{{ $item->name }}">
                <input type="text" name="email" placeholder="email" value="{{ $item->email }}">
                <input type="text" name="password" placeholder="password">
                <input type="submit" value="delete">
            </form>
        @endforeach

        <br />
        <br />
        <br />
        <form action="{{ route('delete_more_users') }}" method="POST">
            {{ csrf_field() }}
            <input type="text" name="ids[]" placeholder="name" value="2">
            <input type="text" name="ids[]" placeholder="name" value="3">
            <input type="text" name="ids[]" placeholder="name" value="4">
            <input type="submit" value="delete">
        </form>

        <br />
        <br />
        <br />
    @endif

    <!-- show item by call ajax -->
    <button type="button" id="show_item_by_call_ajax">show</button>
    <span id="show_value">data</span>

    <br />
    <br />
    <br />

    <!-- show item by call ajax -->
    <form action="{{ route('find_user_by_id', 1) }}" method="GET">
        <button type="submit">get by id</button>
    </form>
    @if (isset($items['byId']))
        @foreach ($items['byId'] as $item)
            <p>{{ $item->name }}</p>
        @endforeach
    @endif
    <form action="{{ route('find_user_by_name', 'Admin') }}" method="GET">
        <button type="submit">get by name</button>
    </form>
    @if (isset($items['byName']))
        @foreach ($items['byName'] as $item)
            <p>{{ $item->name }}</p>
        @endforeach
    @endif
</body>

</html>
