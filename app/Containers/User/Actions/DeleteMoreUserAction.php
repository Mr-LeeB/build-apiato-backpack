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
class DeleteMoreUsersAction extends Action
{

  /**
   * @param \App\Ship\Transporters\DataTransporter $data
   */
  public function run(DataTransporter $data)
  {
    $user_Ids = [];
    foreach ($data->ids as $id) {
      $user = Apiato::call('User@FindUserByIdTask', [$id]);
      array_push($user_Ids, $user->id);
    }
    return Apiato::call('User@DeleteMoreUsersTask', [$user_Ids]);
  }
}