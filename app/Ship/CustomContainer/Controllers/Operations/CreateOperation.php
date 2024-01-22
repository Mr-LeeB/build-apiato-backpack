<?php
namespace App\Ship\CustomContainer\Controllers\Operations;

use Illuminate\Support\Facades\Route;

trait CreateOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param  string  $segment  Name of the current entity (singular). Used as first URL segment.
     * @param  string  $routeName  Prefix of the route name.
     * @param  string  $controller  Name of the current CrudController.
     */
    protected function setupCreateRoutes($segment, $routeName, $controller)
    {
        Route::get($segment . '/create', [
            'as' => $routeName . '.create',
            'uses' => $controller . '@create',
            'operation' => 'create',
        ]);

        Route::post($segment . '/store', [
            'as' => $routeName . '.store',
            'uses' => $controller . '@store',
            'operation' => 'create',
        ]);
    }
}