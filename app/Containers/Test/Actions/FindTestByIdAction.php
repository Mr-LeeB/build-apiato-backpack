<?php

namespace App\Containers\Test\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindTestByIdAction extends Action
{
    public function run(Request $request)
    {
        $test = Apiato::call('Test@FindTestByIdTask', [$request->id]);

        return $test;
    }
}
