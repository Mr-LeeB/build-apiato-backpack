<?php
namespace App\Ship\CustomContainer\Controllers\Operations;

use Illuminate\Support\Facades\Route;

trait ListOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param  string  $segment  Name of the current entity (singular). Used as first URL segment.
     * @param  string  $routeName  Prefix of the route name.
     * @param  string  $controller  Name of the current CrudController.
     */
    protected function setupListRoutes($segment, $routeName, $controller)
    {
        Route::get($segment . '/', [
            'as' => $routeName . '.index',
            'uses' => $controller . '@list',
            'operation' => 'list',
        ]);

        Route::get($segment . '/{id}/show', [
            'as' => $routeName . '.showHandDiEm',
            'uses' => $controller . '@show',
            'operation' => 'list',
        ]);
    }
}


?>
