<?php

namespace App\Ship\CustomContainer\Tasks;

use App;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteItemTask extends Task
{

    protected $repository;

    public function run($repository, $id)
    {
        $this->repository = App::make($repository);

        try {
            return $this->repository->whereIn('id', $id)->delete();
        } catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
