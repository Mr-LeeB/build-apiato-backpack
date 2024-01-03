<?php
namespace App\Ship\CustomContainer\Controllers\Operations;

use Illuminate\Support\Facades\Route;

trait DeleteOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param  string  $segment  Name of the current entity (singular). Used as first URL segment.
     * @param  string  $routeName  Prefix of the route name.
     * @param  string  $controller  Name of the current CrudController.
     */
    protected function setupDeleteRoutes($segment, $routeName, $controller)
    {
        Route::delete($segment . '/{id}', [
            'as' => $routeName . '.delete',
            'uses' => $controller . '@delete',
            'operation' => 'delete',
        ]);
    }
}


?>