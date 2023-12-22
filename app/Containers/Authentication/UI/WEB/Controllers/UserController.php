<?php

namespace App\Containers\Authentication\UI\WEB\Controllers;

use Apiato\Core\Abstracts\Controllers\WebController;
use App\Containers\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\Authentication\UI\WEB\Requests\LogoutRequest;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;
use Exception;

/**
 * Class UserController
 *
 * @package App\Containers\Authentication\UI\WEB\Controllers
 */
class UserController extends WebController
{
    /**
     * @param \App\Containers\Authentication\UI\WEB\Requests\LoginRequest $request
     *
     * @return  \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function loginUser(LoginRequest $request)
    {
        try {
            $result = Apiato::call('Authentication@WebLoginAction', [new DataTransporter($request)]);
        } catch (Exception $e) {
            return redirect('login')->with('status', $e->getMessage());
        }

        return is_array($result) ? redirect('login')->with($result) : redirect('dashboard');
    }

    /**
     * @return  \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logoutUser(LogoutRequest $request)
    {

        $result = Apiato::call('Authentication@WebLogoutAction');

        return redirect('logout')->with(['result' => $result]);
    }
}
