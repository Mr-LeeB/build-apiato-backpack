<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="{{ isset($item) ? route('user.update', $item[0]->id) : route('user.store') }}" method="POST">
        {{ csrf_field() }}
        @if (isset($item))
            {{ method_field('PUT') }}
        @endif
        <input type="text" name="name" placeholder="name" value="{{ isset($item) && $item[0]->name }}">
        <input type="text" name="email" placeholder="email" value="{{ isset($item) && $item[0]->email }}">
        <input type="text" name="password" placeholder="password">
        <input type="submit" value="submit">
    </form>

    @if (session('errors'))
        <div class="text-red">{{ session('errors') }}</div>
    @endif
    @if (session('success'))
        <div class="text-green">{{ session('success') }}</div>
    @endif
</body>

</html>
