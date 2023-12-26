<?php

namespace App\Containers\Test\UI\WEB\Controllers;

use App\Containers\Test\UI\WEB\Requests\CreateTestRequest;
use App\Containers\Test\UI\WEB\Requests\DeleteTestRequest;
use App\Containers\Test\UI\WEB\Requests\GetAllTestsRequest;
use App\Containers\Test\UI\WEB\Requests\FindTestByIdRequest;
use App\Containers\Test\UI\WEB\Requests\UpdateTestRequest;
use App\Containers\Test\UI\WEB\Requests\StoreTestRequest;
use App\Containers\Test\UI\WEB\Requests\EditTestRequest;
use App\Ship\Parents\Controllers\WebController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @package App\Containers\Test\UI\WEB\Controllers
 */
class Controller extends WebController
{
    /**
     * Show all entities
     *
     * @param GetAllTestsRequest $request
     */
    public function index(GetAllTestsRequest $request)
    {
        $tests = Apiato::call('Test@GetAllTestsAction', [$request]);

        // ..
    }

    /**
     * Show one entity
     *
     * @param FindTestByIdRequest $request
     */
    public function show(FindTestByIdRequest $request)
    {
        $test = Apiato::call('Test@FindTestByIdAction', [$request]);

        // ..
    }

    /**
     * Create entity (show UI)
     *
     * @param CreateTestRequest $request
     */
    public function create(CreateTestRequest $request)
    {
        // ..
    }

    /**
     * Add a new entity
     *
     * @param StoreTestRequest $request
     */
    public function store(StoreTestRequest $request)
    {
        $test = Apiato::call('Test@CreateTestAction', [$request]);

        // ..
    }

    /**
     * Edit entity (show UI)
     *
     * @param EditTestRequest $request
     */
    public function edit(EditTestRequest $request)
    {
        $test = Apiato::call('Test@GetTestByIdAction', [$request]);

        // ..
    }

    /**
     * Update a given entity
     *
     * @param UpdateTestRequest $request
     */
    public function update(UpdateTestRequest $request)
    {
        $test = Apiato::call('Test@UpdateTestAction', [$request]);

        // ..
    }

    /**
     * Delete a given entity
     *
     * @param DeleteTestRequest $request
     */
    public function delete(DeleteTestRequest $request)
    {
         $result = Apiato::call('Test@DeleteTestAction', [$request]);

         // ..
    }
}
