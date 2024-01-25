<?php

namespace App\Containers\Clients\UI\WEB\Controllers;

use App\Containers\Authorization\Actions\GetAllRolesAction;
use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\UI\API\Requests\GetAllPermissionsRequest;
use App\Containers\Authorization\UI\API\Requests\GetAllRolesRequest;
use App\Containers\Clients\Models\Clients;
use App\Containers\User\Models\User;
use App\Containers\User\UI\WEB\Requests\GetAllUserRequest;
use App\Ship\CustomContainer\Controllers\Operations\BulkDeleteOperation;
use App\Ship\CustomContainer\Controllers\Operations\CreateOperation;
use App\Ship\CustomContainer\Controllers\Operations\DeleteOperation;
use App\Ship\CustomContainer\Controllers\Operations\ListOperation;
use App\Ship\CustomContainer\Controllers\Operations\UpdateOperation;
use App\Ship\CustomContainer\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Ship\Parents\Controllers\WebController;

/**
 * Class Controller
 *
 * @package App\Containers\Clients\UI\WEB\Controllers
 */
class Controller extends WebController
{
  use ListOperation, CreateOperation, UpdateOperation, DeleteOperation, BulkDeleteOperation;
  // protected $views = [
  //   'list' => 'clients::client.show',
  //   'show' => 'clients::client.show',
  // ];

  protected function setupListOperation()
  {
    // $this->crud->enableDetailRow();
  //   CRUD::setColumns([
  //     'name' => [
  //         'label' => 'Name',
  //         'type' => 'text',
  //         'name' => 'name',
  //     ],
  //     'created_at' => [
  //         'label' => 'Created At',
  //         'type' => 'date',
  //         'name' => 'created_at',
  //     ],
  //     'updated_at' => [
  //         'label' => 'Updated At',
  //         'type' => 'date',
  //         'name' => 'updated_at',
  //     ],
  // ]);
    CRUD::setFromDB();
  }

  protected function setupCreateOperation()
  {
    // $this->setFields([
    //   'name' => [
    //     'label' => 'Tên',
    //     'type' => 'text',
    //     'rules' => 'required',
    //   ],
    //   'email' => [
    //     'label' => 'Thơ điện tử',
    //     'type' => 'email',
    //     'rules' => 'required',
    //   ],
    //   'password' => [
    //     'label' => 'Mật khẩu',
    //   ]
    // ]);
  }

  public function setup()
  {
    $this->setModel(Clients::class);
    $this->setViews([
      'list' => 'clients::client.show',
    ]);
    CRUD::setRoute(config('custom.base.route_prefix') . '/client');
  }

  protected $customIndexVariables = [
    User::class => GetAllUserRequest::class,
    Role::class => GetAllRolesRequest::class,
    Permission::class => GetAllPermissionsRequest::class,
  ];

}
