<?php 
namespace App\Ship\CustomContainer\Controllers\Operations;

use Illuminate\Support\Facades\Route;

trait ListOperation{
    protected function setupListRoutes($segment, $routeName, $controller)
    {
        Route::get($segment . '/', [
            'as'        => $routeName . '.index',
            'uses'      => $controller . '@index',
            'operation' => 'list',
        ]);

        Route::post($segment . '/search', [
            'as'        => $routeName . '.search',
            'uses'      => $controller . '@search',
            'operation' => 'list',
        ]);

        Route::get($segment . '/{id}/details', [
            'as'        => $routeName . '.showDetailsRow',
            'uses'      => $controller . '@showDetailsRow',
            'operation' => 'list',
        ]);
    }
}


?>