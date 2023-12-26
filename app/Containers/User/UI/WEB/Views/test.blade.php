<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @php
        // dd(get_defined_vars()['__data']);
    @endphp

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
</body>

</html>
