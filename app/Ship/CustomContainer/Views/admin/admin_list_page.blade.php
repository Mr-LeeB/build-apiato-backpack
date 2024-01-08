@extends('customcontainer::layout.app_admin_nova')

@section('title')
    {{ __('Release') }}
@endsection

@php
    // dd($customs);
    // dd(get_defined_vars()['__data']);

    $view_load_theme = 'base';
    session()->put('url.back', url()->current());
@endphp

@section('header_sub')
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <h2>{{ __('Show items') }}</h2>
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
    <div class="col-12" id="manage_item">
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
                <a href="{{ route('get_all_user') }}">
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
                    value="Delete items">
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
                    <table id="tableproduct">
                    <table id="tableproduct">
                        <thead>
                            @php

                            @endphp
                            <tr>
                                @foreach ($crud->$columns as $column)
                                    <th>
                                        {{ $column['label'] }}
                                    </th>
                                @endforeach
                            @php

                            @endphp
                            <tr>
                                @foreach ($crud->$columns as $column)
                                    <th>
                                        {{ $column['label'] }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
            integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
        <script>
            $(document).ready(function() {
                $('#tableproduct').DataTable({
                    data: @json($items->items()),
                    columns: [{
                            data: 'name'
                        },
                        {
                            data: 'email'
                        },
                    ],
                    searching: false,
                    ordering: false,
                    paging: false,
                    scrollX: 400,
                    scrollY: 400,
                    processing: true,
                    info: false,
                });
            });
        </script>
        <script>
            const app = new Vue({
                el: '#manage_item',
                data: {
                    items: @json($items->items()),
                    total: @json($items->total()),
                    length: @json($items->count()),
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
                    lastPage: @json($items->lastPage()),
                    isLoading: false
                },
                computed: {},
                methods: {
                    getRelease: async function() {
                        this.isLoading = true;
                        const response = await handleCallAjax(
                            '{{ route('user.index') }}', {
                                orderBy: this.params.orderBy,
                                sortedBy: this.params.sortedBy,
                                limit: this.params.limit,
                                page: this.params.page,
                                search: this.params.search,
                                searchFields: this.params.searchFields,
                            },
                            'GET',
                        );
                        this.items = response.data.data;
                        this.total = response.data.total;
                        this.length = this.items.length;
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
                                $('#form-access').append(
                                    '<input type="hidden" name="id[]" value="' + id +
                                    '">');
                            });
                            const response = await handleCallAjax(
                                "{{ route('user.bulkDelete') }}",
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
                        $('.icon-' + this.params.orderBy + '.icon-' + this.params.sortedBy).css('color',
                            '#3699FF');
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
                    items: function() {
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
