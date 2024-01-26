<?php

namespace App\Ship\CustomContainer\Controllers;

use Apiato\Core\Abstracts\Controllers\WebController as AbstractWebController;
use App\Ship\CustomContainer\Requests\AccessDashboardRequest;

class AdminController extends AbstractWebController
{
    protected $crud;

    public function __construct()
    {
        $this->middleware('web');

        $this->crud = app()->make('crud');
        $this->crud->setTitle('Custom Container Dashboard');
    }

    public function dashboard(AccessDashboardRequest $request)
    {
        return view('customcontainer::admin.dashboard')->with('crud', $this->crud);
    }
}