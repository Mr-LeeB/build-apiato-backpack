@extends('releasevuejs::layout.app_admin_nova')

@section('title')
    {{ __('Release') }}
@endsection

@php
    $view_load_theme = 'base';
    session()->put('url.back', url()->current());
@endphp

@section('header_sub')
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <h2>{{ __('Show Releases') }}</h2>
            </div>
        </div>
    </div>
@endsection

@once
    @push('after_header')
        <link href="{{ asset('theme/' . $view_load_theme . '/css/admin_show_release_css.css') }}" rel="stylesheet" type="text/css">
    @endpush
@endonce

@section('header_sub')
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <h2>{{ __('Danh sách Release') }}</h2>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-12" id="manage_release">
        <div class="row">
            <div class="col">
                <div class="card card-custom gutter-b card-stretch">
                    <div class="card-header boloc border-0 py-5" @click="showSearch">
                        <h3 class="card-title"><span class="font-weight-bolder">{{ __('Bộ Lọc') }}</span></h3>
                        <div class="card-toolbar">
                        </div>
                    </div>
                    <div class="card-body boloc-show hidden">
                        <div class="tab-content">
                            <form class="form gutter-b col">
                                <div class="form-group row mt-4">
                                    <label class="col-3 col-form-label">Title: </label>
                                    <div class="col-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control search-title"
                                                placeholder="Enter title" />
                                            <div class="input-group-append">
                                                <select
                                                    class="field-search-title form-control form-control-nm font-weight-bold border-0 bg-light"
                                                    style="width: 75px;">
                                                    <option value="like">like</option>
                                                    <option value="=">=</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group
                                                        row">
                                    <label class="col-3 col-form-label">Description: </label>
                                    <div class="col-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control search-description"
                                                placeholder="Enter description" />
                                            <div class="input-group-append">
                                                <select
                                                    class="field-search-description form-control form-control-nm font-weight-bold border-0 bg-light"
                                                    style="width: 75px;">
                                                    <option value="like">like</option>
                                                    <option value="=">=</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="form-group
                                                                            row">
                                    <label class="col-3 col-form-label">Date
                                        Created: </label>
                                    <div class="col-9">
                                        <div class="input-group date">
                                            <input type="date" class="form-control search-date" />
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-row-reverse">
                                    <button type="button" id="search_release" class="btn btn-primary btn-block"
                                        style="width: 180px" @click="searchRelease()">{{ __('Lọc danh sách') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="create-release">
            <div class="create">
                <a href="{{ route('web_releasevuejs_create') }}">
                    <button class="btn btn-primary mt-6">
                        Create New Release
                    </button>
                </a>
            </div>
        </div>

        <div class="table-list-all-release">
            <div class="py-2">
                <div v-if="error" v-html="error"></div>
                <div v-if="success" v-html="success"></div>
            </div>

            <div class="delete-more-release mb-2 hidden">
                <input type="button" @click="confirmDeleteMoreRelease()" class="btn btn-light-danger font-weight-bold mr-2"
                    value="Delete Releases">
            </div>

            <div class="card card-custom card-fit">
                <div class="card-header">
                    <div class="card-title">
                        <h3>{{ __('Danh sách') }} Release </h3>
                        <div class="d-flex align-items-center ml-2" v-if="isLoading">
                            <div class="mr-2 text-muted">Loading...</div>
                            <div class="spinner mr-10"></div>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <i class="flaticon2-reload cursor-pointer reset_params" @click="resetParams()" data-toggle="tooltip"
                            title="Reset"></i>
                    </div>
                </div>

                <div class="card-body py-0 overlay-parent">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>
                                    <input type="checkbox" id="checkAll" @click="checkAll()">
                                </td>
                                <td @click="sortRelease('id')" class="field field-id cursor-pointer"> ID
                                    <i class="la la-long-arrow-up icon-nm icon icon-asc icon-id"></i>
                                    <i class="la la-long-arrow-down icon-nm icon icon-desc icon-id"></i>
                                </td>
                                <td @click="sortRelease('name')" class="field field-name cursor-pointer"> Name
                                    <i class="la la-long-arrow-up icon-nm icon icon-asc icon-name"></i>
                                    <i class="la la-long-arrow-down icon-nm icon icon-desc icon-name"></i>
                                </td>
                                <td class="field field-title_description cursor-pointer"
                                    @click="sortRelease('title_description')"> Title
                                    <i class="la la-long-arrow-up icon-nm icon icon-asc icon-title_description"></i>
                                    <i class="la la-long-arrow-down icon-nm icon icon-desc icon-title_description"></i>
                                </td>
                                <td class="field field-detail_description cursor-pointer"
                                    @click="sortRelease('detail_description')">Description
                                    <i class="la la-long-arrow-up icon-nm icon icon-asc icon-detail_description"></i>
                                    <i class="la la-long-arrow-down icon-nm icon icon-desc icon-detail_description"></i>
                                </td>
                                <td class="text-center field field-created_at cursor-pointer"
                                    @click="sortRelease('created_at')"> Date Created
                                    <i class="la la-long-arrow-up icon-nm icon icon-asc icon-created_at"></i>
                                    <i class="la la-long-arrow-down icon-nm icon icon-desc icon-created_at"></i>
                                </td>
                                <td class="text-center">Is Publish</td>
                                <td class="text-center"> Images </td>
                                <td class="text-center" colspan="3"> Actions </td>

                            </tr>
                        </thead>

                        <tbody id="body-content" v-if="!isLoading">
                            <tr class="bg-hover-secondary" v-for="release in releases" v-if="length > 0">
                                <td style="text-align: center;">
                                    <input type="checkbox" :value="release.id" @click="check()">
                                </td>
                                <td>
                                    <span v-html="release.id">Release id</span>
                                </td>
                                <td>
                                    <span v-html="mb_str_split(release.name)"> Release name</span>
                                </td>
                                <td>
                                    <span v-html="mb_str_split(release.title_description)"> Release title</span>
                                </td>
                                <td>
                                    <span v-html="mb_str_split(strip_tags(release.detail_description))"> Release
                                        description</span>
                                </td>
                                <td class="text-center">
                                    <span v-html="release.created_at.substring(0, 10)"> Release date created</span>
                                </td>
                                <td class="text-center">
                                    <span v-html="release.is_publish">Is publish</span>
                                </td>
                                <td>
                                    <div class="small-image d-flex flex-column align-items-center"
                                        v-if="release.images != null">
                                        <div class="symbol symbol-40 mr-3">
                                            <img alt="Image" :src="release.images[0]" />
                                        </div>
                                        <span style="font-size: 12px" v-if="release.images.length > 1">
                                            More <span v-html="release.images.length - 1"></span> image(s)
                                        </span>
                                    </div>
                                    <div class="small-image d-flex flex-column align-items-center" v-else>
                                        <p> Not image </p>
                                    </div>
                                </td>
                                <td style="text-align: center btn">
                                    <i class="fa la-info-circle btn-show-info"
                                        @click="showReleaseDetailPage(release.id)"></i>
                                </td>
                                <td style="text-align: center">
                                    <i class="fa fa-pen btn-edit" @click="enableEdit(release.id)"></i>
                                </td>
                                <td style="text-align: center">
                                    <i class="fa fa-trash btn-delete-one" @click="deleteRelease(release.id)"></i>
                                </td>
                            </tr>
                            <tr v-else>
                                <td colspan="100%" class=" bg-hover-secondary text-center">
                                    <b>{{ __('global.no_data') }}</b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="overlay-child" v-if="isLoading"></div>
                </div>

                <div class="card-footer pt-0">
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex align-items-center py-0">
                                <div class="d-flex align-items-center" v-if="isLoading">
                                    <div class="mr-2 text-muted">Loading...</div>
                                    <div class="spinner mr-10"></div>
                                </div>
                                <select
                                    class="form-limit form-control form-control-sm font-weight-bold mr-4 border-0 bg-light"
                                    style="width: 75px;" v-on:change="limitRelease()">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <span class="text-muted">Displaying <span v-html="length"></span> of
                                    <span v-html="total"></span>
                                    records</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <setup-paginate :current_page="params.page" :last_page="lastPage"
                                @handle_change="changePage" />
                        </div>
                    </div>
                    <form id="form-access">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('javascript')
        <script>
            const app = new Vue({
                el: '#manage_release',
                data: {
                    releases: @json($releases->items()),
                    total: @json($releases->total()),
                    length: @json($releases->count()),
                    message: @json(session('success')),
                    error: @json(session('error')),
                    success: @json(session('success')),

                    params: {
                        orderBy: null,
                        sortedBy: null,
                        limit: null,
                        page: 1,
                        search: null,
                        searchFields: null,
                    },
                    lastPage: @json($releases->lastPage()),
                    isLoading: false,
                },
                computed: {},
                methods: {
                    getRelease: async function() {
                        this.isLoading = true;
                        const response = await handleCallAjax(
                            '{{ route('web_releasevuejs_get_all_release') }}', {
                                orderBy: this.params.orderBy,
                                sortedBy: this.params.sortedBy,
                                limit: this.params.limit,
                                page: this.params.page,
                                search: this.params.search,
                                searchFields: this.params.searchFields,
                            },
                            'GET',
                        );
                        this.releases = response.data.data;
                        this.total = response.data.total;
                        this.length = this.releases.length;
                        this.lastPage = response.data.last_page;

                        this.isLoading = false;
                    },
                    enableEdit: function(id) {
                        window.location.href = '/releasevuejs/' + id + '/edit';
                    },
                    deleteRelease: async function(id) {
                        if (confirm("Are you sure you want to delete this release?")) {
                            this.isLoading = true;

                            const response = await handleCallAjax(
                                '/releasevuejs/' + id + "/delete",
                                $('#form-access').serialize(),
                                'delete',
                            );

                            if (response.status == 200) {
                                app.success = response.data.success;
                                app.message = response.data.message;
                                app.getRelease();
                            } else {
                                app.error = response.data.error;
                                app.message = response.data.message;
                            }

                            this.isLoading = false;
                        }
                    },
                    confirmDeleteMoreRelease: async function() {
                        this.isLoading = true;
                        var checkBoxes = document.getElementById("body-content")
                            .querySelectorAll('input[type="checkbox"]');
                        var releaseIDs = [];
                        checkBoxes.forEach((checkbox) => {
                            if (checkbox.checked && checkbox.value != 'on') {
                                releaseIDs.push(checkbox.value);
                                checkbox.checked = false;
                            }
                        });

                        if (confirm("Are you sure you want to delete this release?")) {
                            releaseIDs.forEach((id) => {
                                $('#form-access').append('<input type="hidden" name="id[]" value="' + id +
                                    '">');
                            });
                            const response = await handleCallAjax(
                                "{{ route('web_releasevuejs_delete_bulk') }}",
                                $('#form-access').serialize(),
                                'DELETE',
                            );

                            if (response.status == 200) {
                                app.getRelease();
                                app.success = response.data.success;
                                app.message = response.data.message;
                            } else {
                                app.error = response.data.error;
                                app.message = response.data.message;
                            }

                            this.isLoading = false;
                        }
                    },
                    checkAll: function() {
                        var checkBoxes = document.getElementById("body-content")
                            .querySelectorAll('input[type="checkbox"]');

                        check = document.getElementById("checkAll").checked;
                        checkBoxes.forEach((checkbox) => {
                            checkbox.checked = check;
                        });

                        if (check) {
                            $(".delete-more-release").removeClass('hidden');
                        } else {
                            $(".delete-more-release").addClass('hidden');
                        }
                    },
                    check: function() {
                        var checkBoxes = document.getElementById("body-content")
                            .querySelectorAll('input[type="checkbox"]');

                        var check = true;
                        if (!checkBoxes.length) {
                            check = false;
                        } else {
                            var count = 0;
                            checkBoxes.forEach((checkbox) => {
                                if (!checkbox.checked) {
                                    check = false;
                                } else {
                                    count++;
                                }
                            });
                        }

                        document.getElementById("checkAll").checked = check;

                        if (count) {
                            $(".delete-more-release").removeClass('hidden');
                        } else {
                            $(".delete-more-release").addClass('hidden');
                        }
                    },
                    showReleaseDetailPage: function(id) {
                        window.location.href = 'releasevuejs/' + id;
                    },
                    sortRelease: function(newOrderBy) {
                        //if orderBy is null or not equal newOrderBy => set sortedBy = asc
                        if (this.params.orderBy == null || this.params.orderBy != newOrderBy) {
                            this.params.orderBy = newOrderBy;
                            this.params.sortedBy = 'asc';
                        } else {
                            //if orderBy is equal newOrderBy => change sortedBy
                            if (this.params.sortedBy == null) {
                                this.params.sortedBy = 'asc';
                            } else {
                                this.params.sortedBy = this.params.sortedBy == 'asc' ? 'desc' : 'asc';
                            }
                        }

                        // change color icon
                        $('.icon-nm').css('color', '#3f4254');
                        $('.icon-' + this.params.orderBy).css('display', 'inline-block');
                        $('.icon-' + this.params.orderBy).css('color', '#a9cef3');
                        $('.icon-' + this.params.orderBy + '.icon-' + this.params.sortedBy).css('color', '#3699FF');
                        $('.field').css('color', '#3f4254');
                        $('.field-' + this.params.orderBy).css('color', '#3699FF');

                    },
                    showSearch: function() {
                        $('.boloc-show').toggleClass('hidden');
                    },
                    searchRelease: function() {
                        this.isLoading = true;

                        this.resetParams(true);

                        var title = $('.search-title').val();
                        var description = $('.search-description').val();
                        var date = $('.search-date').val();

                        var field_title = $('.field-search-title').val();
                        var field_description = $('.field-search-description').val();

                        search = '';
                        searchFields = '';
                        if (title != '') {
                            search += 'title_description:' + title;
                        }

                        if (description != '') {
                            if (title != '') {
                                search += ';detail_description:' + description;
                            } else {
                                search += 'detail_description:' + description;
                            }
                        }

                        if (date != '') {
                            if (title != '' || description != '') {
                                search += ';created_at:' + date;
                            } else {
                                search += 'created_at:' + date;
                            }
                        }

                        if (field_title != 'like') {
                            searchFields += 'title_description:' + field_title;
                        }

                        if (field_description != 'like') {
                            if (field_title != 'like') {
                                searchFields += ';detail_description:' + field_description;
                            } else {
                                searchFields += 'detail_description:' + field_description;
                            }
                        } else {
                            if (field_title == 'like') {
                                searchFields = null;
                            }
                        }

                        if (search != '') {
                            this.params.search = search;
                        }

                        if (searchFields != '') {
                            this.params.searchFields = searchFields;
                        }

                        this.isLoading = false;
                    },
                    limitRelease: function() {
                        this.params.limit = $('.form-limit').val();

                        this.params.page = 1;
                    },
                    strip_tags: function(description) {
                        return description.replace(/(<([^>]+)>)/gi, "");
                    },
                    mb_str_split: function(description) {
                        if (description.length > 20) {
                            return description.substring(0, 20).concat('...');
                        } else {
                            return description;
                        }
                    },
                    resetParams: function(searching = false) {
                        this.isLoading = true;

                        // clear params
                        this.params.orderBy = null;
                        this.params.sortedBy = null;
                        this.params.limit = null;
                        this.params.page = 1;
                        this.params.search = null;
                        this.params.searchFields = null;

                        // clear message
                        this.success = null;
                        this.error = null;
                        this.message = null;

                        // clear search

                        if (!searching) {
                            $('.search-title').val('');
                            $('.search-description').val('');
                            $('.search-date').val('');

                            $('.field-search-title').val('like');
                            $('.field-search-description').val('like');

                            $('.boloc-show').addClass('hidden');
                        }
                        // clear icon
                        $('.form-limit').val(10);

                        $('.icon-nm').css('color', '#3f4254');
                        $('.field').css('color', '#3f4254');

                        // clear checkbox
                        var checkBoxes = document.getElementById("body-content")
                            .querySelectorAll('input[type="checkbox"]');
                        checkBoxes.forEach((checkbox) => {
                            if (checkbox.checked) {
                                checkbox.checked = false;
                            }
                        });
                        this.check();

                        this.isLoading = false;
                    },
                    changePage: function(page) {
                        this.params.page = page;
                    },
                },
                watch: {
                    releases: function() {
                        this.$nextTick(() => {
                            app.check();
                        });
                    },
                    total: function() {},
                    length: function() {},
                    params: {
                        handler: function() {
                            this.getRelease();
                        },
                        deep: true,
                    },
                    lastPage: function() {},
                    isLoading: function() {
                        if (this.isLoading) {
                            $('.btn').attr('disabled', true);
                        } else {
                            $('.btn').attr('disabled', false);
                        }

                    },
                }
            })
        </script>
    @endsection
