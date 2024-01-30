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


    /**
     * Redirect to the dashboard.
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        // The '/admin' route is not to be used as a page, because it breaks the menu's active state.
        return redirect(custom_url('dashboard'));
    }
}