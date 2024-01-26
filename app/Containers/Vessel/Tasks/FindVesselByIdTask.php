<?php

namespace App\Containers\Vessel\Tasks;

use App\Containers\Vessel\Data\Repositories\VesselRepository;
use App\Ship\Parents\Tasks\Task;

class FindVesselByIdTask extends Task
{
    protected $repository;

    public function __construct(VesselRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
      return $this->repository->find($id);
    }
}
