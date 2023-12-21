<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manager Role - Permission</title>

    @yield('css')

    @yield('js')
    {{-- php function --}}

    @php
        $permissionIDs = [];
        foreach ($permissions as $permission) {
            array_push($permissionIDs, $permission->id);
        }
    @endphp
</head>

<body>
    @include('product::menu')
    <div class="parent">
        <div class="content">
            <h1>Manager Role - Permission</h1>
            {{ old('isEdited') }}
            {{ old('name') }}
            <br>
            {{ $errors }}
            <hr>
            <div class="managers">
                <div class="manager">
                    <div class="role-area">
                        <h2>Role</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Role Name</th>
                                    <th>Guard Name</th>
                                    <th>Display Name</th>
                                    <th>Description</th>
                                    <th>Level</th>
                                    @role('admin')
                                        <th colspan="2">Action</th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $role)
                                    <tr>
                                        <form id="form-delete-role-{{ $role->id }}"
                                            action="{{ route('delete_role', $role->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                        <form id="form-update-role{{ $role->id }}" name="form-update-role"
                                            action="{{ route('update_role', $role->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <input type="hidden" name="isEdited" value="{{ $role->id }}">
                                            <td>
                                                <input class="input-edit" id="name{{ $role->id }}" type="text"
                                                    name="name" value="{{ $role->name }}" disabled>
                                            </td>
                                            <td>
                                                <input class="input-edit" type="text"
                                                    value=" {{ $role->guard_name }}" disabled>
                                            <td>
                                                <input class="input-edit" id="display_name{{ $role->id }}"
                                                    type="text" name="display_name"
                                                    value="{{ $role->display_name }}" disabled>
                                            </td>
                                            <td>
                                                <input class="input-edit" id="description{{ $role->id }}"
                                                    type="text" name="description" value="{{ $role->description }}"
                                                    disabled>
                                            </td>
                                            <td>
                                                <input class="input-edit" id="level{{ $role->id }}" type="number"
                                                    name="level" value="{{ $role->level }}" disabled>
                                            </td>
                                            @role('admin')
                                                <td>
                                                    <input id="btn-edit-role{{ $role->id }}" class="btn-edit-role"
                                                        type="button"
                                                        onclick="enableEditRole({{ $role->id }}, {{ json_encode($role->name) }})"
                                                        value="Edit">
                                                </td>
                                                <td>
                                                    <input id="btn-delete-role{{ $role->id }}" class="btn-remove-role"
                                                        type="button" onclick="confirmDelRole({{ $role->id }})"
                                                        value="Remove">
                                                </td>
                                            @endrole
                                        </form>
                                    </tr>
                                @endforeach

                                @role('admin')
                                    <form action="{{ route('create_role') }}" method="POST" id="form-create-role">
                                        {{ csrf_field() }}
                                        <tr class="create-form-add-role">
                                            @php
                                                $nameR = '';
                                                $display_nameR = '';
                                                $descriptionR = '';
                                                
                                                $errorNameR = '';
                                                $errorDisplayNameR = '';
                                                $errorDescriptionR = '';
                                                
                                                if ($errors->any()) {
                                                    if (old('isEdited') == null) {
                                                        $nameR = old('name');
                                                        $display_nameR = old('display_name');
                                                        $descriptionR = old('description');
                                                
                                                        $errorNameR = $errors->first('name');
                                                        $errorDisplayNameR = $errors->first('display_name');
                                                        $errorDescriptionR = $errors->first('description');
                                                    }
                                                }
                                                
                                            @endphp
                                            <td>
                                                <div class="td-create-input">
                                                    <input type="text" name="name" id="name"
                                                        placeholder="Role Name" value="{{ $nameR }}">
                                                    @if ($errors->has('name'))
                                                        <span class="errorCreate"> {{ $errorNameR }} </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="td-create-input">
                                                    <input type="text" id="guard_name" value="web" disabled>

                                                </div>
                                            <td>
                                                <div class="td-create-input">
                                                    <input type="text" name="display_name" id="display_name"
                                                        placeholder="Display Name" value="{{ $display_nameR }}">
                                                    @if ($errors->has('display_name'))
                                                        <span class="errorCreate"> {{ $errorDisplayNameR }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="td-create-input">
                                                    <input type="text" name="description" id="description"
                                                        placeholder="Description" value="{{ $descriptionR }}">
                                                    @if ($errors->has('description'))
                                                        <span class="errorCreate"> {{ $errorDescriptionR }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $level = 0;
                                                    if (old('level')) {
                                                        $level = old('level');
                                                    }
                                                @endphp
                                                <div class="td-create-input">
                                                    <input type="number" name="level" id="level" placeholder="Level"
                                                        value="{{ $level }}">
                                                    @if ($errors->has('level'))
                                                        <span class="errorCreate"> {{ $errors->first('level') }} </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <input class="btn-confirm-create-role" type="button"
                                                    onclick="confirmCreateRole()" value="Save">
                                            </td>
                                            <td>
                                                <input class="btn-cancle-create-role" type="button"
                                                    onclick="cancleCreateRole()" value="Cancle">
                                            </td>
                                        </tr>
                                    </form>
                                    <tr>
                                        <td colspan="5" style="text-align: center; width: fit-content">
                                            <input class="btn-create-role" type="button" onclick="createNewRole()"
                                                value="Add New Role">
                                        </td>
                                    </tr>
                                @endrole
                            </tbody>
                        </table>
                    </div>

                    <div class="permission-area">
                        <h2>Permission</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Permission Name</th>
                                    <th>Guard Name</th>
                                    <th>Display Name</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>
                                            {{ $permission->name }}
                                        </td>
                                        <td>
                                            {{ $permission->guard_name }}
                                        <td>
                                            {{ $permission->display_name }}
                                        </td>
                                        <td>
                                            {{ $permission->description }}
                                        </td>

                                    </tr>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="role-permission-area">
                    <h2>Role - Permission</h2>
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Role</th>
                                    <th>Permission</th>
                                    @role('admin')
                                        <th>Action</th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    @php
                                        $permissionRoleIDs = [];
                                        foreach ($role->permissions as $permissionRole) {
                                            array_push($permissionRoleIDs, $permissionRole->id);
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td class="list-role-permission"
                                            id="list-role-permission{{ $role->id }}">
                                            @foreach ($role->permissions as $permission)
                                                {{ $permission->name }} <br>
                                            @endforeach
                                        </td>
                                        <td class="list-all-permission" id="list-all-permission{{ $role->id }}">
                                            <form id="form-attach-permission-to-role{{ $role->id }}"
                                                action="{{ route('attach_permission_to_role') }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="role_id" value="{{ $role->id }}">
                                                @foreach ($permissions as $permission)
                                                    <div class="permission-id-item">
                                                        <input
                                                            class="permission-item permission-item{{ $role->id }}"
                                                            id="permission-attach-ids{{ $permission->id }}{{ $role->id }}"
                                                            type="checkbox" value="{{ $permission->id }}"
                                                            @if ($role->permissions->contains($permission->id)) checked @endif>
                                                        {{ $permission->name }}
                                                    </div>
                                                @endforeach
                                            </form>
                                            @role('admin')
                                                <div class="group-btn-save-cancle"
                                                    id="group-btn-save-cancle{{ $role->id }}">
                                                    <input class="btn-save-permission" type="button"
                                                        onclick="confirmSavePermission({{ $role->id }}, {{ json_encode($permissionIDs) }}, {{ json_encode($permissionRoleIDs) }})"
                                                        value="Save">
                                                    <input class="btn-cancle-permission" type="button"
                                                        onclick="cancleEditPermission({{ $role->id }}, {{ json_encode($role->permissions) }})"
                                                        value="Cancle">
                                                </div>
                                            @endrole
                                        </td>
                                        @role('admin')
                                            <td>
                                                <input class="btn-enable-edit" id="btn-enable-edit{{ $role->id }}"
                                                    type="button" onclick="enableEditPermission({{ $role->id }})"
                                                    value="Edit">
                                            </td>
                                        @endrole
                                    </tr>
                                    <form action="{{ route('detach_permission_to_role') }}" method="POST"
                                        id="form-detach-permission-to-role{{ $role->id }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="role_id" value="{{ $role->id }}">
                                        @foreach ($permissionIDs as $permissionID)
                                            <input type="hidden"
                                                id="permission-detach-ids{{ $permissionID }}{{ $role->id }}"
                                                value="{{ $permissionID }}">
                                        @endforeach
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        if ({{ $errors->any() }}) {
            if ({{ old('isEdited') }} == null) {
                createNewRole();
            } else if ('{{ old('name') }}' != null) {
                setVal({{ old('isEdited') }}, '{{ old('name') }}');
                enableEditRole({{ old('isEdited') }}, '{{ json_encode(old('name')) }}');
            } else {
                var name = document.getElementById('name' + '{{ old('isEdited') }}').value;
                setVal({{ old('isEdited') }}, name);
                enableEditRole({{ old('isEdited') }}, name);
            }
        }

        function setVal(id, name) {
            document.getElementById('name' + id).value = name;
            document.getElementById('display_name' + id).value = '{{ old('display_name') }}';
            document.getElementById('description' + id).value = '{{ old('description') }}';
            document.getElementById('level' + id).value = '{{ old('level') }}';
        }
    </script>
</body>

</html>
