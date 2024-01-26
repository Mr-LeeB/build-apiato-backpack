<?php

namespace App\Containers\Vessel\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllVesselsAction extends Action
{
  public function run($paginate, $userId = null)
  {
    return Apiato::call(
      'Vessel@GetAllVesselsTask',
      [$paginate, $userId],
      [
        'addRequestCriteria',
        'ordered'
      ]
    );
  }
}
