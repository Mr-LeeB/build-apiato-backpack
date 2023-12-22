<?php

namespace App\Ship\CustomContainer\Tasks;

use App;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindItemTask extends Task
{

    protected $repository;

    public function run($repository, $id)
    {
        $this->repository = App::make($repository);

        try {
            return $this->repository->find($id);
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}