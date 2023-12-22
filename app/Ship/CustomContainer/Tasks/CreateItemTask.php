<?php

namespace App\Ship\CustomContainer\Tasks;

use App;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateItemTask extends Task
{

    protected $repository;
    /**
     * @return  mixed
     * @throws  CreateResourceFailedException
     */
    public function run($repository, $data)
    {
        $this->repository = App::make($repository);
        try {
            // create new release
            $result = $this->repository->create($data);

        } catch (Exception $e) {
            throw (new CreateResourceFailedException())->debug($e);
        }
        return $result;
    }
}