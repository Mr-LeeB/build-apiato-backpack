@extends('authorization::layout.app_admin_nova')

@section('title')
    {{ __('Show Permission') }}
@endsection

@php
    $view_load_theme = 'base';
@endphp

@section('header_sub')
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <h2>{{ __('Show Permission') }}</h2>
            </div>
        </div>
    </div>
@endsection

@once
    @push('after_header')
        <link href="{{ asset('theme/' . $view_load_theme . '/css/show_permission.css') }}" rel="stylesheet" type="text/css">
    @endpush
@endonce

@section('javascript')
    <script>
        Vue.component('show-list-permission', {
            props: {
                groups: Array,
                list_permissions: Array,
                num: Number,
            },
            methods: {
                seeMore: function(group) {
                    return app.seeMore(group);
                },
                seeLess: function(group) {
                    return app.seeLess(group);
                },
                hidden: function(id) {
                    return app.hidden(id);
                },
                onCheckAllPermissionInAGroup: function(groupName) {
                    return app.onCheckAllPermissionInAGroup(groupName);
                },
                check: function(index) {
                    return app.check(index);
                },
            },
            template: `<div class="card card-flush h-md-100" style="width: 100%">
                                    <div class="card-header" style="background-color:rgb(239 239 239);">
                                        <div class="card-title mb-0">
                                            <h3 class="d-flex justify-content-between font-weight-bold">
                                                <div class="d-flex align-items-center">
                                                    <input class="check-box-permission mr-2" 
                                                        :id="num - 1 + '_check_all'" 
                                                        type="checkbox" name="" 
                                                        @click="onCheckAllPermissionInAGroup(num - 1)"
                                                    />
                                                    @{{ groups[num - 1].name }}
                                                </div>
                                                <div @click="hidden(groups[num-1].name)" class="cursor-pointer">
                                                    <i class="flaticon2-next hidden" :id="groups[num - 1].name + 'next'"></i>
                                                    <i class="flaticon2-down" :id="groups[num - 1].name + 'down'"></i>
                                                </div>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="content px-0 py-0" :id="groups[num - 1].name">
                                        <div class="card-body pt-1">
                                            <div class="font-weight-bold text-gray-600 mb-5">
                                                Total permission in @{{ groups[num - 1].name }} group: @{{ groups[groups[num - 1].name] }}
                                            </div>
                                            <div class="d-flex flex-column text-gray-600">
                                                <div class="d-flex align-items-center" v-for="(permission, index) in list_permissions[groups[num-1].name]">
                                                    <table class="table mb-0" v-show="index < groups[num - 1].count">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 5%">
                                                                    <input class="check-box-permission" type="checkbox" :value="permission.id" @click="check(num-1)"/>
                                                                </td>
                                                                <td style="width: 35%">@{{ permission.name }}</td>
                                                                <td style="width: 60%">@{{ permission.description }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer py-2 mb-0" v-show="groups[groups[num-1].name] > 10">
                                            <div class="btn-group btn-group-sm">
                                                <div class="btn btn-secondary" @click='seeLess(num-1)'
                                                    v-if="groups[num-1].count > 10">
                                                    See less
                                                </div>
                                                <div class="show-more btn btn-primary" @click="seeMore(num-1)"
                                                    v-if="groups[num-1].count < groups[groups[num-1].name]">
                                                    See more
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`,
        });
        const app = new Vue({
            el: '#permission_field',
            data: {
                list_permissions: [],
                groups: [],
            },
            computed: {

            },
            methods: {
                getPermissions: function() {
                    axios.get('{{ route('get_authorization_home_page') }}' + '?limit=999999')
                        .then(function(response) {
                            response.data.data.forEach(function(item) {
                                if (app.groups[item.group] === undefined && item.group !== null &&
                                    item.group !== "") {
                                    app.groups[item.group] = [];
                                    app.groups.push({
                                        name: item.group,
                                        count: 10,
                                    });
                                }
                                if (item.group === null || item.group === "") {
                                    if (app.groups["None_Group"] === undefined) {
                                        app.groups["None_Group"] = [];
                                        app.groups.push({
                                            name: "None_Group",
                                            count: 10,
                                        });
                                    }
                                    if (app.list_permissions["None_Group"] === undefined) {
                                        app.list_permissions["None_Group"] = [];
                                    }
                                    app.list_permissions["None_Group"].push(item);
                                } else {
                                    if (app.list_permissions[item.group] === undefined) {
                                        app.list_permissions[item.group] = [];
                                    }
                                    app.list_permissions[item.group].push(item);
                                }
                            });

                            app.groups.forEach(function(item) {
                                app.groups[item.name] = app.list_permissions[item.name].length;
                            });
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                seeMore: function(index) {
                    this.groups[index].count += 10;
                },
                seeLess: function(index) {
                    this.groups[index].count -= 10;
                },
                hidden: function(id) {
                    var x = document.getElementById(id);
                    var y = document.getElementById(id + 'next');
                    var z = document.getElementById(id + 'down');
                    x.classList.toggle("hidden");
                    y.classList.toggle("hidden");
                    z.classList.toggle("hidden");
                },
                hiddenAll: function() {
                    var x = document.getElementsByClassName("content");
                    var y = document.getElementsByClassName("flaticon2-next");
                    var z = document.getElementsByClassName("flaticon2-down");
                    for (var i = 0; i < x.length; i++) {
                        x[i].classList.add("hidden");
                        y[i].classList.remove("hidden");
                        z[i].classList.add("hidden");
                    }

                    for (var i = 0; i < this.groups.length; i++) {
                        if (!document.getElementById(i + '_check_all').checked) {
                            this.groups[i].count = 10;
                        }
                    }
                },
                showAll: function() {
                    var x = document.getElementsByClassName("content");
                    var y = document.getElementsByClassName("flaticon2-next");
                    var z = document.getElementsByClassName("flaticon2-down");
                    for (var i = 0; i < x.length; i++) {
                        x[i].classList.remove("hidden");
                        y[i].classList.add("hidden");
                        z[i].classList.remove("hidden");
                    }

                    for (var i = 0; i < this.groups.length; i++) {
                        this.groups[i].count = this.groups[this.groups[i].name];
                    }
                },
                onCheckAllPermissionInAGroup: function(index) {
                    this.groups[index].count = this.groups[this.groups[index].name];

                    var x = document.getElementById(this.groups[index].name);
                    var y = document.getElementById(this.groups[index].name + 'next');
                    var z = document.getElementById(this.groups[index].name + 'down');
                    x.classList.remove("hidden");
                    y.classList.add("hidden");
                    z.classList.remove("hidden");

                    this.$nextTick(() => {
                        var checkBoxes = document.getElementById(this.groups[index].name)
                            .querySelectorAll(
                                'input[type="checkbox"]');
                        check = document.getElementById(index + '_check_all').checked;
                        checkBoxes.forEach((checkbox) => {
                            checkbox.checked = check;
                        });
                    });
                },
                attachPermissionToRole: function() {
                    var checkBoxes = document.querySelectorAll('input[type="checkbox"]');
                    var checked = [];
                    checkBoxes.forEach((checkbox) => {
                        if (checkbox.checked && checkbox.value !== "on") {
                            checked.push(checkbox.value);
                        }
                    });
                    if (checked.length === 0) {
                        alert("Please choose permission to attach");
                        return;
                    }
                    axios.post('{{ route('attach_permission_to_role') }}', {
                            role_id: 1,
                            permissions_ids: checked,
                        })
                        .then(function(response) {
                            console.log(response);
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                check: function(index) {
                    var checkBoxes = document.getElementById(this.groups[index].name)
                        .querySelectorAll(
                            'input[type="checkbox"]');
                    var check = true;
                    checkBoxes.forEach((checkbox) => {
                        if (!checkbox.checked) {
                            check = false;
                        }
                    });
                    document.getElementById(index + '_check_all').checked = check;
                }
            },
            watch: {
                list_permissions: function(value) {
                    console.log("show list", this.list_permissions);
                },
                groups: function(value) {
                    console.log("show groups", this.groups);
                },
            }
        });

        app.getPermissions();
    </script>
@endsection

@section('content')
    <div class="col-12" id="permission_field">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <h2 class="">
                        List Permission
                    </h2>
                </div>
                <div class="card-toolbar">
                    <button class="attach btn btn-light-danger mr-4" @click="attachPermissionToRole"> Attach </button>
                    <div class="btn-group">
                        <button class="hidden-all btn btn-secondary" @click="hiddenAll"> Hidden All </button>
                        <button class="show-all btn btn-primary" @click="showAll"> Show All </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-12">
                    <div class="row d-flex justify-content-between">
                        <div class="col-6 ">
                            <div class="row mb-2 mr-2" v-for="num in Math.floor(groups.length / 2)">
                                <show-list-permission :groups="groups" :list_permissions="list_permissions"
                                    :num="num">
                                </show-list-permission>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row mb-2 ml-2" v-for="num in groups.length"
                                v-if="num > Math.floor(groups.length / 2)">
                                <show-list-permission :groups="groups" :list_permissions="list_permissions"
                                    :num="num">
                                </show-list-permission>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
