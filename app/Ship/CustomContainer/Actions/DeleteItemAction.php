<?php

namespace App\Ship\CustomContainer\Actions;

use App;
use App\Ship\CustomContainer\Tasks\DeleteItemTask;
use App\Ship\CustomContainer\Tasks\FindItemTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

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
        App::make(FindItemTask::class)->run($repository, $data->id) ? $item = $data->id : null;

        if (!$item)
            throw new NotFoundException();

        return App::make(DeleteItemTask::class)->run($repository, (array) $item);
    }
}