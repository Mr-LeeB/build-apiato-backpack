<?php

namespace App\Ship\CustomContainer\Tasks;

use App;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindItemTask extends Task
{

    protected $repository;

    /**
     * Runs the function with the given parameters.
     *
     * @param string $repository The name of the repository.
     * @param string $field The field to filter the data by.
     * @param mixed $data The data to filter.
     * @throws NotFoundException If an error occurs while executing the function.
     * @return mixed The result of the function execution.
     */
    public function run($repository, $field, $data)
    {
        $this->repository = App::make($repository);
        try {
            if ($field == 'id') {
                return $this->repository->find((array) $data)->first();
            }
            return $this->repository->where($field, 'like', "%{$data}%")->get();
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}