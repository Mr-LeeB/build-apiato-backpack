<?php

namespace App\Containers\User\Tasks;

use App;
use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class DeleteUserTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class DeleteUserTask extends Task
{

  protected $repository;

  public function __construct(UserRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * @return bool
   * @throws DeleteResourceFailedException
   */
  public function run($repository, $id)
  {
    $this->repository = App::make($repository);
    try {
      return $this->repository->delete($id);
    } catch (Exception $exception) {
      throw new DeleteResourceFailedException();
    }
  }
}
