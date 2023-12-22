<?php

namespace App\Ship\CustomContainer\Actions;

use App\Ship\CustomContainer\Tasks\CreateItemTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;

class CreateItemAction extends Action
{
    public function run($repository, DataTransporter $data)
    {

        $result = App::make(CreateItemTask::class)->run($repository, array_filter($data->toArray()));

        return $result;
    }
}