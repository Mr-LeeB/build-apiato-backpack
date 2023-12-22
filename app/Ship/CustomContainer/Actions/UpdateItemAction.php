<?php

namespace App\Ship\CustomContainer\Actions;

use App\Ship\CustomContainer\Tasks\UpdateItemTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;

class UpdateItemAction extends Action
{
    public function run($repository, $id, DataTransporter $request)
    {
        $data = array_filter($request->toArray());

        $result = App::make(UpdateItemTask::class)->run($repository, $id, $data);

        return $result;
    }
}