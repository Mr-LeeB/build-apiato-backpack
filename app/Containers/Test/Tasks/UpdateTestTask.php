<?php

namespace App\Containers\Test\Tasks;

use App\Containers\Test\Data\Repositories\TestRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateTestTask extends Task
{

    protected $repository;

    public function __construct(TestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            return $this->repository->update($data, $id);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
