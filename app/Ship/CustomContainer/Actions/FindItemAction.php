<?php

namespace App\Ship\CustomContainer\Actions;

use App;
use App\Ship\CustomContainer\Tasks\FindItemTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class FindUserByIdAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindItemAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     */
    public function run($repository, DataTransporter $data)
    {
        $item = App::make(FindItemTask::class)->run($repository, [$data->id]);

        if (!$item) {
            throw new NotFoundException();
        }

        return $item;
    }

}
