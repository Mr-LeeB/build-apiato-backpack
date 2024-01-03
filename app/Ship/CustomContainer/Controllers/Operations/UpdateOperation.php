<?php
namespace App\Ship\CustomContainer\Controllers\Operations;

use Illuminate\Support\Facades\Route;

trait UpdateOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param  string  $name  Name of the current entity (singular). Used as first URL segment.
     * @param  string  $routeName  Prefix of the route name.
     * @param  string  $controller  Name of the current CrudController.
     */
    protected function setupUpdateRoutes($segment, $routeName, $controller)
    {
        Route::get($segment . '/{id}/edit', [
            'as' => $routeName . '.edit',
            'uses' => $controller . '@edit',
            'operation' => 'update',
        ]);

        Route::put($segment . '/{id}/update', [
            'as' => $routeName . '.update',
            'uses' => $controller . '@update',
            'operation' => 'update',
        ]);
    }
}


?>