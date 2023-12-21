<?php

namespace App\Containers\Product\Tasks;

use App\Containers\Product\Data\Repositories\ProductRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindProductByNameTask extends Task
{

  protected $repository;

  public function __construct(ProductRepository $repository)
  {
    $this->repository = $repository;
  }

  public function run($name)
  {
    try {
      return $this->repository->findByField('name', $name)->first();
    } catch (Exception $exception) {
      throw new NotFoundException();
    }
  }
}