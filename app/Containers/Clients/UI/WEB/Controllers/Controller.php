<?php

namespace App\Containers\Clients\UI\WEB\Controllers;

use App\Containers\Clients\Models\Clients;
use App\Containers\User\Models\User;
use App\Ship\CustomContainer\Controllers\WebCrudController;

/**
 * Class Controller
 *
 * @package App\Containers\Clients\UI\WEB\Controllers
 */
class Controller extends WebCrudController
{
  public function __construct() {

    $this->view = 'welcome::welcome-page';
    $this->model = 'clients';
  }
}
