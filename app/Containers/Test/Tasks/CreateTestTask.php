<?php

namespace App\Containers\Test\Tasks;

use App\Containers\Test\Data\Repositories\TestRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateTestTask extends Task
{

    protected $repository;

    public function __construct(TestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            return $this->repository->create($data);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
