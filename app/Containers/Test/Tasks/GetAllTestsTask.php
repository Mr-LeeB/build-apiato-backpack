<?php

namespace App\Containers\Test\Tasks;

use App\Containers\Test\Data\Repositories\TestRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllTestsTask extends Task
{

    protected $repository;

    public function __construct(TestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }
}
