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
        $id               = (array) $id;
        $this->repository = App::make($repository);

        try {
            return $this->repository->whereIn('id', $id);
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}