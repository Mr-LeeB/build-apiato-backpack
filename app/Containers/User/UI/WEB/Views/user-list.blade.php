<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>List Users</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    @yield('css')

    <!-- Scripts -->
    @yield('js')

    {{-- php function --}}
    @php
        $email = null;
        $name = null;
        $gender = null;
        $birth = null;
        if (old('email')) {
            $email = old('email');
        } elseif ($userEdited) {
            $email = $userEdited->email;
        }
        if (old('name')) {
            $name = old('name');
        } elseif ($userEdited) {
            $name = $userEdited->name;
        }
        if (old('gender')) {
            $gender = old('gender');
        } elseif ($userEdited) {
            $gender = $userEdited->gender;
        }
        if (old('birth')) {
            $birth = old('birth');
        } elseif ($userEdited) {
            $birth = $userEdited->birth;
        }
    @endphp
</head>

<body>
    @include('product::menu')
    <div class="parent">
        <!--List all user-->
        <div class="content">
            <div class="title m-b-md">
                List Users
            </div>
            {{-- <div class="paginationWrap">
                @if (isset($users) && count($users) > 0)
                {{ $users->links() }}
                @endif
            </div> --}}

            <div class="info">

                @php
                    $user = Auth::user();
                    $rolesUser = $user->roles;
                    $userCanCreate = false;
                    $userCanEdit = false;
                    $userCanDelete = false;
                    $userCanManageRole = false;

                    echo 'You are logged in as ';
                    foreach ($rolesUser as $role) {
                        echo $role->name . ' ';
                    }
                    echo '!';
                    foreach ($rolesUser as $role) {
                        # code...
                        foreach ($role->permissions as $permission) {
                            if ($permission->name == 'create-admins') {
                                $userCanCreate = true;
                            }
                            if ($permission->name == 'update-users') {
                                $userCanEdit = true;
                            }
                            if ($permission->name == 'delete-users') {
                                $userCanDelete = true;
                            }
                            if ($permission->name == 'manage-roles') {
                                $userCanManageRole = true;
                            }
                        }
                        // echo $permission->name . ', ';
                    }

                    $roleIDs = [];
                    foreach ($roles as $role) {
                        array_push($roleIDs, $role->id);
                    }
                    $roleIDs_json = json_encode($roleIDs);
                @endphp

                @if ($userCanCreate)
                    {{-- @if ($errors->first('email') || $errors->first('name') || $errors->first('password')) --}}
                    @if ($errors->any())
                        <style>
                            .create-form {
                                display: block
                            }

                            #add {
                                display: none;
                            }

                            #cancle {
                                display: block;
                            }

                            .errorEmailCreate,
                            .errorNameCreate,
                            .errorPasswordCreate,
                            .errorGender,
                            .errorBirth {
                                display: block;
                            }
                        </style>
                    @endif

                    <div class="new-user">

                        @if ($isEdited != -1)
                            <div class="form">
                                <div id="error"></div>
                                {{-- <form class="create-form form" action="{{ route('update_user', $isEdited) }}"
                            method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }} --}}

                                <form id="edit{{ $isEdited }}" class="create-form save-form{{ $isEdited }}"
                                    action="{{ route('update_user', $isEdited) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                @else
                                    <input type="button" id="add" class="btn-add" name="createUser"
                                        onclick="showCreateForm()" value="Add New User">
                                    <input type="button" id="cancle" class="btn-cancle"
                                        onclick="disableCreateForm()" value="Cancle">
                                    <div class="form">
                                        <div id="error"></div>
                                        <form class="create-form form" action="{{ route('create_new_user') }}"
                                            method="post">
                                            {{ csrf_field() }}
                        @endif

                        @if (session('status'))
                            <div class="text-red">{{ session('status') }}</div>
                        @endif

                        <label for="email">Email: </label>
                        <input type="email" placeholder="email" id="email" name="email"
                            value="{{ $email }}" oninput="changeEmailRegister()" />

                        <span class="text-red errorEmailCreate">{{ $errors->first('email') }}</span>

                        <label for="name">Name:</label>
                        <input type="text" placeholder="name" id="name" name="name"
                            value="{{ $name }}" oninput="changeNameRegister()" />

                        <span class="text-red errorNameCreate">{{ $errors->first('name') }}</span>

                        <div class="gender-radio">
                            <div class="gender-female">
                                <input type="radio" name="gender" id="gender-female" value="female">
                                <label for="gender-female">Female</label>
                            </div>
                            <div class="gender-male">
                                <input type="radio" name="gender" id="gender-male" value="male">
                                <label for="gender-male">Male</label>
                            </div>
                            <div class="gender-none">
                                <input type="radio" name="gender" id="gender-none" value="other" checked>
                                <label for="gender-none">Other</label>
                            </div>
                        </div>

                        <span class="text-red errorGender">{{ $errors->first('gender') }}</span>

                        <label for="birth">Birthday:</label>
                        <input type="date" name="birth" id="birth">

                        <span class="text-red errorBirth">{{ $errors->first('birth') }}</span>

                        @if ($isEdited != -1)
                            {{-- <input type="hidden" name="isEdited" value="{{ $user->id }}"> --}}
                            <div class="controll-edit-btn">
                                <button class="btn-save-edit" type="button"
                                    style="color: blue; font-weight: 500; margin: 0 10px;"
                                    onclick="confirmSave({{ $userEdited }})">Save</button>

                                <button class="btn-cancle-edit" type="button"
                                    style="color: red; font-weight: 500; margin: 0 10px;"
                                    onclick="cancleEdit()">Cancle</button>
                            </div>
                        @else
                            <label for="password">Password:</label>
                            <input type="password" placeholder="password" id="password" name="password" />

                            <span class="text-red errorPasswordCreate">{{ $errors->first('password') }}</span>

                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" placeholder="confirm password" id="confirm_password" />

                            {{-- <input type="hidden" name="isEdited" value="-1" /> --}}
                            <button type="button" onclick="confirmCreate()">Create</button>
                        @endif
                        </form>
                    </div>
            </div>
            @endif
            @if (session('createSuccess'))
                <span style="color:#43A047">{{ session('createSuccess') }}</span>
            @endif

            <hr>

            @php
                // get all user ids, user emails
                $userIds = [];
                $userEmails = [];
                foreach ($users as $user) {
                    if ($user->id != Auth::user()->id && $user->id != 1) {
                        array_push($userIds, $user->id);
                    }
                    array_push($userEmails, $user->email);
                }
                $userIds_json = json_encode($userIds);
                $usersEmails_json = json_encode($userEmails);
            @endphp

            {{-- create button delete all users --}}
            @if ($userCanDelete)
                <form class="delete-selected-form" action="{{ route('delete_more_users') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    @foreach ($userIds as $item)
                        <input id="selectUser{{ $item }}" type="hidden" name="ids[]"
                            value="{{ $item }}" />
                    @endforeach

                    <button id="deleteAll" class="btn-delete-selected" type="button" name="deleteAll"
                        onclick="deleteUserSelected({{ $userIds_json }})">Delete Users</button>
                </form>
            @endif

            <table class="table table-hover">
                @if (session('message'))
                    <span style="color:#43A047">{{ session('message') }}</span>
                @endif
                <tr>
                    @if ($userCanDelete)
                        <th><input type="checkbox" id="checkAll" onclick="checkAll({{ $userIds_json }})" /></th>
                    @endif
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <th>Created</th>
                    @if ($userCanManageRole)
                        @can('manage-admins-access')
                            <th>Role</th>
                        @endcan
                    @endif
                    @if ($userCanEdit)
                        @if ($userCanDelete)
                            <th colspan="2">Operation</th>
                        @else
                            <th>Operation</th>
                        @endif
                    @else
                        @if ($userCanDelete)
                            <th>Operation</th>
                        @endif
                    @endif
                </tr>
                @foreach ($users as $user)
                    <tr>
                        @if ($userCanDelete && $user->id != 1 && $user->id != Auth::user()->id)
                            <td style='text-align: center'>
                                <input type="checkbox" id="select_user{{ $user->id }}"
                                    onclick="selectOne({{ $userIds_json }})">
                            </td>
                        @else
                            @if ($userCanDelete)
                                <td></td>
                            @endif
                        @endif
                        <td style='text-align:center;'>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td style='text-align:center;'>{{ $user->gender }}</td>
                        <td style='text-align:center;'>{{ $user->birth }}</td>
                        <td style='text-align:center;'>{{ substr($user->created_at, 0, 10) }}</td>
                        @if ($userCanManageRole)
                            @can('manage-admins-access')
                                <td style='text-align:center; '>
                                    {{-- <form action="" method="GET">
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <button type="submit" style="color: #43A047; font-weight: 1000;">Role</button>
                                </form> --}}
                                    <div class="btn-assign-revoke-role">
                                        @foreach ($user->roles as $rolesUser)
                                            {{ $rolesUser->name }} <br>
                                        @endforeach

                                        <button class="btn-assign-role" type="button"
                                            style="color: #43A047; font-weight: 1000;"
                                            onclick="assignRole({{ $user->id }})">Assign Role</button>

                                        <form class="form_assign_user_to_role"
                                            id="assign_user_to_role{{ $user->id }}"
                                            action="{{ route('assign_user_to_role') }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            @foreach ($roles as $role)
                                                <div class="role-id-item">
                                                    <input id="role-{{ $role->id }}{{ $user->id }}"
                                                        type="checkbox" value="{{ $role->id }}"
                                                        onclick="checkRole({{ $role->id }})"
                                                        @foreach ($user->roles as $rolesUser)@if ($role->id == $rolesUser->id) checked
                                            @endif @endforeach>
                                                    {{ $role->name }}
                                                </div>
                                            @endforeach
                                            <div class="btn-save-cancle">
                                                <button class="btn-save-assign-role" type="button"
                                                    style="color: #43A047; font-weight: 1000;"
                                                    onclick="saveAssignRole({{ json_encode($user) }}, {{ $roleIDs_json }},{{ json_encode($user->roles) }})">Save</button>
                                                <button class="btn-cancle-assign-role" type="button"
                                                    style="color: #43A047; font-weight: 1000;"
                                                    onclick="cancleAssignRole({{ $user->id }})">Cancle</button>
                                            </div>
                                        </form>

                                        <form id="revoke_user_to_role{{ $user->id }}"
                                            action="{{ route('revoke_user_from_role') }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            @foreach ($roles as $role)
                                                <input id="remove-role-{{ $role->id }}{{ $user->id }}"
                                                    type="hidden" value="{{ $role->id }}">
                                            @endforeach
                                        </form>
                                    </div>
                                </td>
                            @endcan
                        @endif
                        @if ($userCanEdit)
                            <td style='text-align:center; '>
                                <input id="{{ $user->id }}" type="submit"
                                    onclick="enableEdit({{ $user }})" value="Edit"
                                    style="color: #43A047; font-weight: 1000;" />
                            </td>
                        @endif


                        @if ($userCanDelete)
                            <td style='text-align:center; '>
                                @if ($user->id == 1 || $user->id == Auth::user()->id)
                                    <button type="button" style="color: red; font-weight: 1000;"
                                        onclick="confirmDelete({{ $user->id }})" disabled>Delete</button>
                                @else
                                    <form id="delete{{ $user->id }}" class="delete-form{{ $user->id }}"
                                        action="{{ route('delete_user', $user->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="button" style="color: red; font-weight: 1000;"
                                            onclick="confirmDelete({{ $user->id }})">Delete</button>
                                    </form>
                                @endif
                            </td>
                        @endif

                    </tr>
                @endforeach
            </table>

        </div>
        <div class="paginationWrap">
            @if (isset($users) && count($users) > 0)
                {{ $users->links() }}
            @endif
        </div>
        <form class="logout-form" action="{{ route('post_user_logout_form') }}" method="post"
            style="padding-bottom: 15px">
            {{ csrf_field() }}
            <button type="button" onclick="confirmlogout()">
                Logout
            </button>
        </form>

        <form id="removeAccount-form" class="removeAccount"
            action="{{ route('remove_user_account', Auth::user()->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input id="passwordRemoveAccount" type="password"
                placeholder="Please enter your password to remove your account">
            {{-- <span class="text-red errorPasswordRemoveAccount">{{ $errors }}</span> --}}
            <button class="btn-remove-account" id="enterRemoveAccount" type="button"
                onclick="confirmRemoveAccount()">
                Remove Your Account</button>
        </form>

        <form action="{{ route('check_password') }}" method="POST" id="checkpassword" style="display: none">
            @csrf
            <input id="thispass" type="hidden" name="password">
            {{-- <input type="hidden" name="authpassword" id="authpassword"
                        value="{{ Auth::user()->password }}"> --}}
        </form>

        <form id="formfinduser" action="{{ route('get_all_user') }}" method="GET">
            <input type="hidden" name="id" id="findUser">
            {{-- <input type="hidden" name="isEdited" id="isEdited"> --}}
        </form>
    </div>
    </div>
    <script>
        if ({{ $isEdited }} != -1) {
            document.querySelector('.create-form').style.display = 'block';
        }
        if ('{{ $gender }}' == 'male') {
            document.getElementById('gender-male').checked = true;
        } else if ('{{ $gender }}' == 'female') {
            document.getElementById('gender-female').checked = true;
        } else
            document.getElementById('gender-none').checked = true;

        if ('{{ $birth }}' != null)
            document.getElementById('birth').value = '{{ $birth }}';
    </script>
</body>

</html>
