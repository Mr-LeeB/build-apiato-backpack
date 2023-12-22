<?php

namespace App\Ship\CustomContainer\Task;

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
            return $this->repository->delete($id);
        } catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
