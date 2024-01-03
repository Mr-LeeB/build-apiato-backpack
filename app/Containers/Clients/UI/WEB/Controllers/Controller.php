<?php

namespace App\Containers\Clients\UI\WEB\Controllers;

use App\Containers\Clients\Models\Clients;
use App\Containers\User\Models\User;
use App\Containers\User\UI\WEB\Requests\GetAllUserRequest;
use App\Ship\CustomContainer\Controllers\Operations\ListOperation;
use App\Ship\Parents\Controllers\WebController;

/**
 * Class Controller
 *
 * @package App\Containers\Clients\UI\WEB\Controllers
 */
class Controller extends WebController
{
  use ListOperation;
  // protected $views = [
  //   'list' => 'clients::client.show',
  //   'show' => 'clients::client.show',
  // ];
  protected $model = Clients::class;

  protected $customIndexVariables = [
    User::class => GetAllUserRequest::class,
  ];
}
