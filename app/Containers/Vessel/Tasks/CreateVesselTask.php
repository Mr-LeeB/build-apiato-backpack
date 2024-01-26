<?php

namespace App\Containers\Vessel\Tasks;

use App\Containers\Vessel\Data\Repositories\VesselRepository;
use App\Containers\Vessel\Models\Vessel;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateVesselTask extends Task
{

  protected $repository;

  public function __construct(VesselRepository $repository)
  {
    $this->repository = $repository;
  }

  public function run(string $userId, string $name, string $description, string $quantity, string $price, string $brand): Vessel
  {
    try {
      // create new vessel
      $vessel = $this->repository->create([
        'user_id' => $userId,
        'name' => $name,
        'description' => $description,
        'quantity' => $quantity,
        'price' => $price,
        'brand' => $brand,
      ]);
    } catch (Exception $e) {
      throw (new CreateResourceFailedException())->debug($e);
    }
    return $vessel;
  }
}
