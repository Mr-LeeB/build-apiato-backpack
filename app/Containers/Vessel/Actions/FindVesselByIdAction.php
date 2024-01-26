<?php

namespace App\Containers\Vessel\Actions;

use App\Containers\Vessel\Models\Vessel;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use Exception;



/*
 *    o  \  私は黒狐です。      0
 *   |\＝| -- -- -- -- >--|> |=
 *  /\ /                    \\
 */

class FindVesselByIdAction extends Action
{
  public function run($data): Vessel
  {
    try {
      $vessel = Apiato::call('Vessel@FindVesselByIdTask', [$data]);
    } catch (Exception $e) {
      throw new NotFoundException('Vessel not found!');
    }

    return $vessel;
  }
}
