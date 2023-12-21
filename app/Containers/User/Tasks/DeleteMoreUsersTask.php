<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class DeleteUserTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class DeleteMoreUsersTask extends Task
{

  protected $repository;

  public function __construct(UserRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   *
   * @param User $user
   *
   * @return bool
   * @throws DeleteResourceFailedException
   */

  //delete list user
  public function run($user_Ids)
  {
    try {
      // dd($user_Ids);
      return User::whereIn('id', $user_Ids)->delete();

    } catch (Exception $exception) {
      throw new DeleteResourceFailedException();
    }
  }

}