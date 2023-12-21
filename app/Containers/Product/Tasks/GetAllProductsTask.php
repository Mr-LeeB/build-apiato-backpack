<?php

namespace App\Containers\Product\Tasks;

use App\Containers\Product\Data\Repositories\ProductRepository;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Ship\Parents\Tasks\Task;

class GetAllProductsTask extends Task
{

  protected $repository;

  public function __construct(ProductRepository $repository)
  {
    $this->repository = $repository;
  }

  public function run()
  {
    return $this->repository->paginate(10);
  }
  public function ordered()
  {
    $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
  }
}