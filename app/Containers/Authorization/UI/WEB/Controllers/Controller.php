<?php

namespace App\Containers\Authorization\UI\WEB\Controllers;


use App\Containers\Authorization\UI\WEB\Requests\AttachPermissionToRoleRequest;
use App\Containers\Authorization\UI\WEB\Requests\CreateRoleRequest;
use App\Containers\Authorization\UI\WEB\Requests\DeleteRoleRequest;
use App\Containers\Authorization\UI\WEB\Requests\UpdateRoleRequest;
use App\Ship\Parents\Controllers\WebController;

use App\Containers\Authorization\UI\WEB\Requests\GetAllRolePermissionRequest;

use App\Containers\Authorization\UI\API\Requests\GetAllRolesRequest;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

/**
 * Class Controller
 *
 * @package App\Containers\Authorization\UI\WEB\Controllers
 */
class Controller extends WebController
{
    public function getAllRolePermission(GetAllRolePermissionRequest $request)
    {
        $roles       = Apiato::call('Authorization@GetAllRolesAction', [new DataTransporter(new GetAllRolesRequest())]);
        $permissions = Apiato::call('Authorization@GetAllPermissionsAction');

        if ($request->expectsJson()) {
            return $permissions;
        }

        return view('authorization::home', compact('roles', 'permissions'));
    }

    public function createRole(CreateRoleRequest $request)
    {
        $role = Apiato::call('Authorization@CreateRoleAction', [new DataTransporter($request)]);
        return redirect()->route('get_authorization_home_page')->with(['success' => 'Role Created Successfully.']);
    }

    public function updateRole(UpdateRoleRequest $request)
    {
        $role = Apiato::call('Authorization@UpdateRoleAction', [new DataTransporter($request)]);
        return redirect()->route('get_authorization_home_page')->with(['success' => 'Role Updated Successfully.']);
    }

    public function deleteRole(DeleteRoleRequest $request)
    {
        $role = Apiato::call('Authorization@DeleteRoleAction', [new DataTransporter($request)]);
        return redirect()->route('get_authorization_home_page')->with(['success' => 'Role Deleted Successfully.']);
    }

    public function attachPermissionToRole(AttachPermissionToRoleRequest $request)
    {
        $role = Apiato::call('Authorization@AttachPermissionsToRoleAction', [new DataTransporter($request)]);

        if ($request->expectsJson()) {
            return $role;
        }
        return redirect()->route('get_authorization_home_page')->with(['success' => 'Permission Attached Successfully.']);
    }

    public function detachPermissionToRole(AttachPermissionToRoleRequest $request)
    {
        $role = Apiato::call('Authorization@DetachPermissionsFromRoleAction', [new DataTransporter($request)]);
        return $role;
    }
}