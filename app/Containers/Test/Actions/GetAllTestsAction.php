<?php

namespace App\Containers\Test\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllTestsAction extends Action
{
    public function run(Request $request)
    {
        $tests = Apiato::call('Test@GetAllTestsTask', [], ['addRequestCriteria']);

        return $tests;
    }
}
