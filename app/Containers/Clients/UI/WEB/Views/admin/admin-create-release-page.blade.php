@extends('releasevuejs::layout.app_admin_nova')

@section('title')
    {{ __('Create Release') }}
@endsection

@php
    $view_load_theme = 'base';
@endphp

@section('header_sub')
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <h2>{{ __('Create New Release') }}</h2>
            </div>
        </div>
    </div>
@endsection

@once
    @push('after_header')
        <link href="{{ asset('theme/' . $view_load_theme . '/css/admin_create_release_css.css') }}" rel="stylesheet"
            type="text/css">
    @endpush
@endonce


@php
    $name = old('name', null);
    $title_description = old('title_description', null);
    $detail_description = old('detail_description', null);
    $date_created = old('date_created', date('Y-m-d'));
    if (old('is_publish', null)) {
        $is_publish = 'checked';
    } else {
        $is_publish = '';
    }
    $id = 0;
    $list_images = old('images', null);

    if (isset($release)) {
        $name = old('name', $release->name);
        $title_description = old('title_description', $release->title_description);
        $detail_description = old('detail_description', $release->detail_description);
        $date_created = old('date_created', substr($release->created_at, 0, 10));
        if (old('is_publish', $release->is_publish) == true) {
            $is_publish = 'checked';
        } else {
            $is_publish = '';
        }
        $id = $release->id;
        $list_images = $release->images;
    }
@endphp


@section('content')
    <div class="col-12" id="manage-create-edit">
        <div class="row">
            <div class="col-6 create-form">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title" style="font-size: 24px">
                            @if (isset($release))
                                {{ __('Edit release') }}
                            @else
                                {{ __('Create new release') }}
                            @endif
                        </h3>
                    </div>
                    <form id="form-create-release" class="form" action="{{ route('web_releasevuejs_store') }}"
                        method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body" style="background: white">
                            <div class="form-group">
                                <span style="color:red">*</span><label>Release Name:</label>
                                <input type="text" class="form-control form-control-solid" id="name" name="name"
                                    placeholder="Enter release name" value="{{ $name }}" />
                                <span class="form-text validate-name hidden"></span>
                                @if ($errors->has('name'))
                                    <span style="color:red">{{ $errors->first('name') }} </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <span style="color:red">*</span><label>Release Title:</label>
                                <input type="text" class="form-control form-control-solid" id="title_description"
                                    name="title_description" placeholder="Enter release title"
                                    value="{{ $title_description }}" />
                                <span class="form-text validate-title hidden"></span>
                                @if ($errors->has('title_description'))
                                    <span style="color:red">{{ $errors->first('title_description') }} </span>
                                @endif
                            </div>
                            <textarea type="text" id="detail_description" name="detail_description" placeholder="Description" hidden></textarea>
                            <div class="form-group">
                                <div class="checkbox-list col-3 pl-0">
                                    <label class="checkbox">
                                        <input type="checkbox" name="is_publish" id="is_publish" {{ $is_publish }} />
                                        <span></span>
                                        Is Publish
                                    </label>
                                </div>
                            </div>
                            <div>
                                <div class="list-input-hidden-upload">
                                    @for ($i = 0; $i < 10; $i++)
                                        @if ($errors->has('images.' . $i))
                                            <span style="color:red">{{ $errors->first('images.' . $i) }} </span>
                                        @endif
                                    @endfor
                                    <input type="file" id="file_upload" class="hidden"
                                        accept=".jpeg, .png, .jpg, .gif, .svg, .webp" multiple>
                                </div>
                                <button class="btn btn-secondary btn-add-image" type="button">
                                    <i class="fa fa-plus" style="margin-right: 4px"> </i> Add images</button>
                            </div>
                            <div class="list-images">
                                @if (isset($list_images) && !empty($list_images))
                                    @foreach ($list_images as $key => $img)
                                        <div class="box-image">
                                            <input type="hidden" name="images_old[]" value="{{ $img }}"
                                                id="{{ $key }}">
                                            <div class="image-input image-input-outline" id="image_{{ $key }}">
                                                <div class="image-input-wrapper"
                                                    style="background-image: url('{{ asset($img) }}')"></div>

                                                <label
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="change">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" id="_{{ $key }}"
                                                        accept=".jpeg, .png, .jpg, .gif, .svg, .webp" />
                                                </label>

                                                <span
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>

                                                <span
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="remove">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            @if (isset($release))
                                <input type="hidden" name="id" id="id" value="{{ $id }}" />
                                <input type="button" class="btn btn-primary mr-2" id="btn-confirm-save" value="Update">
                            @else
                                <input type="button" class="btn btn-primary mr-2" id="btn-confirm-save" value="Save">
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-6 description-form">
                <div class="card card-custom">
                    <div class="card-header">
                        <h2 class="card-title">
                            <span style="color:red">*</span>Description:
                        </h2>
                        <div class="card-toolbar cursor-pointer icon-zoom">
                            <i class="la la-expand icon-lg zoom-in" data-toggle="tooltip" title="Zoom in"></i>
                            <i class="la la-compress icon-lg zoom-out hidden" data-toggle="tooltip" title="Zoom out"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="editor" style="height: 318px"></div>
                        <span class="form-text validate-description hidden">Please enter description</span>
                        @if ($errors->has('detail_description'))
                            <span style="color:red">{{ $errors->first('detail_description') }} </span>
                        @endif
                    </div>
                    <div class="card-footer">
                        @if (session('success'))
                            <h3 style="color:blue">Success!!</h3>
                            {!! session('success') !!}
                        @elseif (session('error'))
                            <h3 style="color:red">Error!!</h3>
                            {!! session('error') !!}
                        @elseif (!isset($release))
                            <h4>No Release(s) created recently!</h4>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="template hidden"></div>
@endsection


@section('javascript')
    <script>
        const toolbarOptions = {
            container: [
                [{
                    header: [1, 2, 3, 4, 5, false]
                }],
                ['bold', 'italic', 'underline'],
                [{
                    list: 'ordered'
                }, {
                    list: 'bullet'
                }],
                [{
                    'align': []
                }],
                ['image'],
                ['clean'],
                ['link'],
            ],
        }
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions,
            },
        });
        let detail_description = @json($detail_description);
        detail_description = quill.clipboard.convert(detail_description);
        quill.setContents(detail_description, 'silent');

        $(".ql-editor").attr('id', 'detail_description_editor');

        // Init list images
        let images = new Object()
        let input_image = new Object()

        quill.getModule('toolbar').addHandler('image', () => {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', '.jpeg, .png, .jpg, .gif, .svg, .webp');
            input.click();
            input.onchange = async () => {
                try {
                    const file = input.files[0];
                    if (!file) {
                        console.error('No file selected');
                        return;
                    }
                    const imageLink = await convertBlobToDataURL(file);

                    $('#file_upload').attr('id', 'files')

                    let input_type_file =
                        '<input type="file" name="images_from_quill[]" id="file_upload" class="hidden" accept=".jpeg, .png, .jpg, .gif, .svg, .webp" multiple>';
                    $('.list-input-hidden-upload').append(input_type_file);

                    input_image = createImageBox(imageLink, file, input_type_file);

                    $('#files').remove();

                    // Insert the image into the Quill editor
                    const range = quill.getSelection();
                    quill.insertEmbed(range.index, 'image', imageLink);

                    // Move cursor to right side of image (easier to continue typing)
                    quill.setSelection(range.index + 1);

                } catch (error) {
                    console.error('Error handling file upload:', error);
                }
            };
        });

        var linkNode = document.querySelectorAll('#editor img');
        linkNode.forEach(function(item, index) {
            var linkBlot = Quill.find(item);
            images[index] = {
                index: quill.getIndex(linkBlot),
                box_image: $('.box-image').eq(index),
            };
        });

        quill.on('text-change', function(delta, oldDelta, source) {
            const index = delta.ops[0].retain == undefined ? 0 : delta.ops[0].retain;
            const data = index ? delta.ops[1] : delta.ops[0];

            if (data.insert) {
                if (source == 'api') {
                    images[input_image.id] = {
                        index: index,
                        box_image: input_image.box_image,
                    };
                }

                foreach(images, function(value, key) {
                    if (value.index > index) {
                        value.index += data.insert.image ? 1 : data.insert.length;
                    } else if (value.index == index) {
                        const isFirstImage = Object.keys(images).length == 1;
                        if (!isFirstImage && key !== input_image.id) {
                            value.index += data.insert.image ? 1 : data.insert.length;
                        }
                    }
                });
            }

            if (data.delete && source == 'user') {
                for (let i = index; i < index + data.delete; i++) {
                    foreach(images, function(value, key) {
                        if (value.index == i) {
                            handleRemoveImageInListImages(key, value.box_image);
                            delete images[key];
                        }
                    });
                }
                foreach(images, function(value, key) {
                    if (value.index > index) {
                        value.index -= data.delete;
                    }
                });
            } else if (data.delete && source == 'api') {
                foreach(images, function(value, key) {
                    if (value.index > index) {
                        value.index -= data.delete;
                    }
                });
            }

        });

        function convertBlobToDataURL(blob) {
            return new Promise((resolve) => {
                const reader = new FileReader();
                reader.onloadend = () => {
                    resolve(reader.result);
                };
                reader.readAsDataURL(blob);
            });
        }

        function handleRemoveImageInListImages(id, box_image) {
            $('#' + id).remove();
            box_image.remove();
        }
    </script>
    <script>
        $("#name").on("input", function() {
            if ($(this).val().trim().length < 3) {
                $(".validate-name").html('Name must be at least 3 characters!');
                $(".validate-name").css('color', 'red');
                $(".validate-name").removeClass('hidden');
            }

            if ($(this).val().trim().length > 40) {
                $(".validate-name").html('Name must be less than 40 characters!');
                $(".validate-name").css('color', 'red');
                $(".validate-name").removeClass('hidden');
            }

            if ($(this).val().trim().length >= 3 && $("#name").val().trim().length <= 40 || $("#name").val().trim()
                .length == 0) {
                $(".validate-name").addClass('hidden');
            }
        });

        $("#title_description").on("input", function() {
            if ($(this).val().trim().length < 3) {
                $(".validate-title").html('Title must be at least 3 characters!');
                $(".validate-title").css('color', 'red');
                $(".validate-title").removeClass('hidden');
            }

            if ($(this).val().trim().length > 255) {
                $(".validate-title").html('Title must be less than 255 characters!');
                $(".validate-title").css('color', 'red');
                $(".validate-title").removeClass('hidden');
            }

            if ($(this).val().trim().length >= 3 && $("#title_description").val().trim().length <= 255 || $(
                    "#title_description").val().trim().length == 0) {
                $(".validate-title").addClass('hidden');
            }
        });

        $('#detail_description_editor').on('input', function() {
            if ($(this).text().trim().length < 3) {
                $(".validate-description").html('Description must be at least 3 characters!');
                $(".validate-description").css('color', 'red');
                $(".validate-description").removeClass('hidden');
            }

            if ($(this).text().trim().length >= 3 || $(this).text().trim().length == 0) {
                $(".validate-description").addClass('hidden');
            }
        });

        $('#btn-confirm-save').on('click', function() {
            var name = $('#name').val().trim();
            var title_description = $('#title_description').val().trim();
            var detail_description = quill.root.textContent.trim();
            var date_created = $('#date_created').val();
            var is_publish = $('#is_publish').is(':checked');

            if (name.length < 3 || name.length > 40) {
                $(".validate-name").html('Name must be between 3 and 40 characters!');
                $('#name').focus();
                $(".validate-name").css('color', 'red');
                $(".validate-name").removeClass('hidden');
                return;
            }

            if (name === @json($name)) {
                $("#name").removeAttr('name');
            }

            if (title_description.length < 3 || title_description.length > 255) {
                $(".validate-title").html('Title must be between 3 and 255 characters!');
                $('#title_description').focus();
                $(".validate-title").css('color', 'red');
                $(".validate-title").removeClass('hidden');
                return;
            }

            if (detail_description.length < 3) {
                $(".validate-description").html('Description must be at least 3 characters!');
                $('#detail_description_editor').focus();
                $(".validate-description").css('color', 'red');
                $(".validate-description").removeClass('hidden');
                return;
            } else {
                var temp = $('.template').append(quill.root.innerHTML);
                var img = $(".template").find('img');
                var count = 0;
                img.each(function() {
                    if ($(this).attr('src').indexOf('/storage/images-release/') == -1) {
                        $(this).attr('src', 'image_' + count++);
                    }
                });
                $("#detail_description").val($(".template").html());
            }

            $('#file_upload').removeAttr('name');
            if (is_publish) {
                $('#is_publish').val(1);
            } else {
                $('#is_publish').val(0);
            }

            if ({{ isset($release) ? 'true' : 'false' }} == true) {
                $('#form-create-release').attr('action', '{{ route('web_releasevuejs_update', $id) }}')
                $('#form-create-release').append('<input type="hidden" name="_method" value="PUT">');
                if (confirm('Are you sure you want to update this release?')) {
                    $('#form-create-release').submit();
                }
            } else {
                $('#form-create-release').submit();
            }
        });

        function createImageBox(image, files, input_type_file) {
            let today = new Date();
            let time = today.getTime();
            let random = Math.floor(Math.random() * 1000);
            let box_image = $('<div class="box-image"></div>');

            box_image.append(`
                                <div class="image-input image-input-outline" id="image_${time}_${random}">
                                    <div class="image-input-wrapper" style="background-image: url(${image})"></div>

                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" id="_${time}_${random}" accept=".png, .jpg, .jpeg" />
                                    </label>

                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>

                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="remove">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                </div>`);


            $(".list-images").append(box_image);

            const fileInput = document.querySelector('#file_upload');

            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(files);

            fileInput.files = dataTransfer.files;

            $('#file_upload').attr('id', time + "_" + random);

            $('.list-input-hidden-upload').append(input_type_file);

            id = time + "_" + random;
            initActionImage(id, box_image);

            return param = {
                id: id,
                box_image: box_image
            };
        }

        function initActionImage(id, box_image) {
            var img = new KTImageInput("image_" + id);
            img.on('change', function() {
                const files = $('#_' + id).prop('files');
                let fileInput = document.getElementById(id) ?? document.getElementById("new_" + id);

                if (fileInput.files != null) {
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(files[0]);

                    fileInput.files = dataTransfer.files;
                } else {
                    let input_type_file =
                        '<input type="file" name="images[]" id="new_' + id +
                        '" class="hidden" multiple>';
                    $('.list-input-hidden-upload').append(input_type_file);

                    fileInput = document.getElementById("new_" + id);

                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(files[0]);

                    $('#' + id).remove();

                    fileInput.files = dataTransfer.files;
                }
            });

            img.on('cancel', function() {
                $('#' + id).remove();
            });

            img.on('remove', function() {
                foreach(images, function(value, key) {
                    if (key == id) {
                        console.log(value, key)
                        quill.deleteText(value.index, 1);
                        delete images[key];
                    }
                })
                handleRemoveImageInListImages(id, box_image);
            });
        }
        $(document).ready(function() {
            $(".btn-add-image").click(function() {
                $('#file_upload').trigger('click');
            });

            $('.list-input-hidden-upload').on('change', '#file_upload', function(event) {
                $(this).attr('id', 'files')
                let files = $('#files').prop('files');

                let input_type_file =
                    '<input type="file" name="images[]" id="file_upload" class="hidden" accept=".jpeg, .png, .jpg, .gif, .svg, .webp" multiple>';
                $('.list-input-hidden-upload').append(input_type_file);

                for (let i = 0; i < event.target.files.length; i++) {
                    createImageBox(URL.createObjectURL(event.target.files[i]), files[i], input_type_file);
                }
                $('#files').remove();
            });

            $('.zoom-in').on('click', function() {
                $('.description-form').removeClass('col-6');
                $('.description-form').addClass('col-12 mt-4');

                $('.create-form').removeClass('col-6');
                $('.create-form').addClass('col-12');

                $('.zoom-out').removeClass('hidden');
                $('.zoom-in').addClass('hidden');

                $('html, body').animate({
                    scrollTop: $(".description-form").offset().top
                }, 1000);

                $("#editor").removeAttr('style');
            });

            $('.zoom-out').on('click', function() {
                $('.description-form').removeClass('col-12 mt-4');
                $('.description-form').addClass('col-6');

                $('.create-form').removeClass('col-12');
                $('.create-form').addClass('col-6');

                $('.zoom-in').removeClass('hidden');
                $('.zoom-out').addClass('hidden');

                $('html, body').animate({
                    scrollTop: $(".create-form").offset().top
                }, 1000);

                $("#editor").css({
                    'height': '318px'
                });
            });

            @if (isset($release) && $release->images != null)
                @foreach ($list_images as $key => $img)
                    id = @json($key);
                    initActionImage(id, $('.box-image').eq({{ $key }}));
                @endforeach
            @endif
        });
    </script>
@endsection
