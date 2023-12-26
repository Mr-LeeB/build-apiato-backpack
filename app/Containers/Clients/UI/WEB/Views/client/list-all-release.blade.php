<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Release</title>

    @yield('css')

    @php
        $releases = \App\Containers\Release\Models\Release::all();
    @endphp
</head>

<body>

    <div class="parent">
        <div class="content">
            <div class="title">
                <h1> Release page</h1>
            </div>

            {{-- <div class="create-release " >
                <form id="form-create-release" class="form-create" action="{{ route('web_release_store') }}"
                    method="POST">
                    {{ csrf_field() }}
                    <input type="text" id="name" name="name" placeholder="Name">
                    <input type="text" id="title_description" name="title_description" placeholder="Title">
                    <input type="text" id="detail_description" name="detail_description" placeholder="Description">
                    <input type="date" id="date_created" name="date_created" placeholder="Date Created"
                        value="{{ date('Y-m-d') }}">
                    <div class="is-publish-checkbox">
                        <input type="checkbox" name="is_publish" id="is_publish">
                        <label for="is_publish"> Is Publish</label>
                    </div>
                    <input type="button" value="Create new release">
                </form>
            </div> --}}


            <div class="release-note-list">
                @foreach ($releases as $release)
                    <div class="release-note-item">
                        <div class="release-note-item-header" onclick="activeBody({{ $release->id }})">
                            <div class="release-note-item-header-title">
                                {{ $release->name }}
                            </div>
                            <div class="release-note-item-header-date">
                                {{ $release->date_created }}
                            </div>
                        </div>
                        <div class="release-note-item-body unactive" id="body{{ $release->id }}">
                            <div class="release-note-item-body-title ">
                                Title: {{ $release->title_description }}
                            </div>
                            <div class="release-note-item-body-description">
                                Description: {{ $release->detail_description }}
                            </div>
                            <div class="more-detail">
                                <a href="{{ route('web_release_search_by_id', $release->id) }}">More detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    @yield('js')
</body>

</html>
