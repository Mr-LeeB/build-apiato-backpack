<?php

namespace App\Containers\Product\Tasks;

use App\Containers\Product\Data\Repositories\ProductRepository;
use App\Containers\Product\Models\Product;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteBulkProductTask extends Task
{

  protected $repository;

  public function __construct(ProductRepository $repository)
  {
    $this->repository = $repository;
  }

  public function run($product_Ids)
  {
    try {
      // return Product::whereIn('id', $product_Ids)->delete();
      return $this->repository->whereIn('id', $product_Ids)->delete();

    } catch (Exception $exception) {
      throw new DeleteResourceFailedException();
    }
  }
}