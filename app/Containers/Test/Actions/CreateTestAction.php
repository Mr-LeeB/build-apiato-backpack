<?php

namespace App\Containers\Test\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class CreateTestAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        $test = Apiato::call('Test@CreateTestTask', [$data]);

        return $test;
    }
}
