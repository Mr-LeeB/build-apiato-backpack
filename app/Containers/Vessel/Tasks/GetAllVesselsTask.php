<?php

namespace App\Containers\Vessel\Tasks;

use App\Containers\Vessel\Data\Repositories\VesselRepository;
use App\Ship\Criterias\Eloquent\OrderByFieldCriteria;
use App\Ship\Parents\Tasks\Task;

class GetAllVesselsTask extends Task
{

    protected $repository;

    public function __construct(VesselRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($paginate, $userId)
    {
        if($userId) return $this->repository->where('user_id', $userId)->paginate($paginate);

        return $this->repository->paginate($paginate);
    }

    public function ordered() {
        $this->repository->pushCriteria(new OrderByFieldCriteria('id', 'asc'));
    }
}
