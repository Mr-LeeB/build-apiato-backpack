<?php

namespace App\Containers\Test\Tasks;

use App\Containers\Test\Data\Repositories\TestRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindTestByIdTask extends Task
{

    protected $repository;

    public function __construct(TestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->find($id);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
