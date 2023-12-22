<?php
namespace App\Ship\CustomContainer\Tasks;

use App;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateItemTask extends Task
{

    protected $repository;

    public function run($repository, $id, array $data)
    {
        $this->repository = App::make($repository);
        if (empty($data)) {
            throw new UpdateResourceFailedException('Inputs are empty.');
        }
        try {
            return $this->repository->update($data, $id);
        } catch (ModelNotFoundException $exception) {
            throw new NotFoundException('Release Not Found.');
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}