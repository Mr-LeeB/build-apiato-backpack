<?php

namespace App\Containers\Product\Tasks;

use App\Containers\Product\Data\Repositories\ProductRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteProductTask extends Task
{

  protected $repository;

  public function __construct(ProductRepository $repository)
  {
    $this->repository = $repository;
  }

  public function run($id)
  {
    try {
      return $this->repository->delete($id);
    } catch (Exception $exception) {
      throw new DeleteResourceFailedException();
    }
  }
}