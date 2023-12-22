<?php

namespace App\Ship\CustomContainer\Actions;

use App;
use App\Ship\CustomContainer\Tasks\GetAllItemTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class GetAllItemAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllItemAction extends Action
{

    /**
     * @return mixed
     */
    public function run($repository, DataTransporter $data)
    {
        $instance = App::make(GetAllItemTask::class, [$repository]);
        // $instance->addRequestCriteria();
        // $instance->ordered();
        $items = $instance->run($repository);

        return $items;
    }

}
