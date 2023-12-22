<?php

namespace App\Ship\CustomContainer\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App;
use App\Containers\User\Tasks\DeleteUserTask;
use App\Ship\CustomContainer\Tasks\FindItemTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Exception;

/**
 * Class DeleteUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteItemAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     */
    public function run($repository, DataTransporter $data)
    {
        $item = $data->id ??
            App::make(FindItemTask::class)->run($repository, [$data->id]);

        if (!$item)
            throw new NotFoundException();

        return App::make(DeleteUserTask::class)->run($repository, $item);
    }
}