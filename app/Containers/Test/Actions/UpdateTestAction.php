<?php

namespace App\Containers\Test\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class UpdateTestAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        $test = Apiato::call('Test@UpdateTestTask', [$request->id, $data]);

        return $test;
    }
}
