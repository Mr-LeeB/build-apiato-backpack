<?php

namespace App\Containers\Authentication\UI\WEB\Controllers;

use App\Containers\Authentication\UI\WEB\Requests\CreateAuthenticationRequest;
use App\Containers\Authentication\UI\WEB\Requests\DeleteAuthenticationRequest;
use App\Containers\Authentication\UI\WEB\Requests\GetAllAuthenticationsRequest;
use App\Containers\Authentication\UI\WEB\Requests\FindAuthenticationByIdRequest;
use App\Containers\Authentication\UI\WEB\Requests\UpdateAuthenticationRequest;
use App\Containers\Authentication\UI\WEB\Requests\StoreAuthenticationRequest;
use App\Containers\Authentication\UI\WEB\Requests\EditAuthenticationRequest;
use App\Ship\Parents\Controllers\WebController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class UserController
 *
 * @package App\Containers\Authentication\UI\WEB\Controllers
 */
class UserController extends WebController
{
    /**
     * Show all entities
     *
     * @param GetAllAuthenticationsRequest $request
     */
    public function index(GetAllAuthenticationsRequest $request)
    {
        $authentications = Apiato::call('Authentication@GetAllAuthenticationsAction', [$request]);

        // ..
    }

    /**
     * Show one entity
     *
     * @param FindAuthenticationByIdRequest $request
     */
    public function show(FindAuthenticationByIdRequest $request)
    {
        $authentication = Apiato::call('Authentication@FindAuthenticationByIdAction', [$request]);

        // ..
    }

    /**
     * Create entity (show UI)
     *
     * @param CreateAuthenticationRequest $request
     */
    public function create(CreateAuthenticationRequest $request)
    {
        // ..
    }

    /**
     * Add a new entity
     *
     * @param StoreAuthenticationRequest $request
     */
    public function store(StoreAuthenticationRequest $request)
    {
        $authentication = Apiato::call('Authentication@CreateAuthenticationAction', [$request]);

        // ..
    }

    /**
     * Edit entity (show UI)
     *
     * @param EditAuthenticationRequest $request
     */
    public function edit(EditAuthenticationRequest $request)
    {
        $authentication = Apiato::call('Authentication@GetAuthenticationByIdAction', [$request]);

        // ..
    }

    /**
     * Update a given entity
     *
     * @param UpdateAuthenticationRequest $request
     */
    public function update(UpdateAuthenticationRequest $request)
    {
        $authentication = Apiato::call('Authentication@UpdateAuthenticationAction', [$request]);

        // ..
    }

    /**
     * Delete a given entity
     *
     * @param DeleteAuthenticationRequest $request
     */
    public function delete(DeleteAuthenticationRequest $request)
    {
         $result = Apiato::call('Authentication@DeleteAuthenticationAction', [$request]);

         // ..
    }
}
