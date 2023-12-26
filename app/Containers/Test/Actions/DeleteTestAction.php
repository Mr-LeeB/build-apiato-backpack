<?php

namespace App\Containers\Test\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteTestAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Test@DeleteTestTask', [$request->id]);
    }
}
