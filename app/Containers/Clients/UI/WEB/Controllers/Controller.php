<?php

namespace App\Containers\Clients\UI\WEB\Controllers;

use App\Containers\Clients\Models\Clients;
use App\Containers\User\Models\User;
use App\Ship\Parents\Controllers\WebController;

/**
 * Class Controller
 *
 * @package App\Containers\Clients\UI\WEB\Controllers
 */
class Controller extends WebController
{
  protected $views = [
    'list' => 'clients::client.show',
  ];
  protected $model = Clients::class;
}
