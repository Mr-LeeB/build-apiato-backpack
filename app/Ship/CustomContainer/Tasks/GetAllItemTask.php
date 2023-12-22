<?php

namespace App\Ship\CustomContainer\Tasks;

use App;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Ship\Parents\Tasks\Task;

class GetAllItemTask extends Task
{
    public $repository;
    public function __construct()
    {
        // $this->repository = App::make($repository);
    }

    public function run($repository)
    {
        $this->repository = App::make($repository);
        $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
        return $this->repository->paginate();
    }
    public function ordered()
    {
        $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
    }
}