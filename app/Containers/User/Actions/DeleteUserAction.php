<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class DeleteUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserAction extends Action
{

  /**
   * @param \App\Ship\Transporters\DataTransporter $data
   */
  public function run(DataTransporter $data)
  {
    // dd($data->id);
    $user = $data->id ?
      Apiato::call(
        'User@FindUserByIdTask',
        [$data->id]
      ) : Apiato::call('Authentication@GetAuthenticatedUserTask');

    // dd($user);
    return Apiato::call('User@DeleteUserTask', [$user]);
  }
}