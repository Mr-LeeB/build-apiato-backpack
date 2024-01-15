<?php
namespace App\Ship\Providers;

use App\Ship\CustomContainer\Library\CrudPanel\CrudPanel;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CustomRouteServiceProvider extends ServiceProvider
{

    public $customRoutesFilePath = '/app/Containers/User/UI/WEB/Routes/custom.php';

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->setupCustomRoutes($this->app->router);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        // Bind the CrudPanel object to Laravel's service container
        $this->app->singleton('crud', function ($app) {
            return new CrudPanel($app);
        });
        
        // load a macro for Route,
        // helps developers load all routes for a CRUD resource in one line
        if (!Route::hasMacro('crud')) {
            $this->addRouteMacro();
        }
    }

    /**
     * Load custom routes file.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupCustomRoutes(Router $router)
    {
        // if the custom routes file is published, register its routes
        if (file_exists(base_path() . $this->customRoutesFilePath)) {
            $this->loadRoutesFrom(base_path() . $this->customRoutesFilePath);
        }
    }

    /**
     * The route macro allows developers to generate the routes for a CrudController,
     * for all operations, using a simple syntax: Route::crud().
     *
     * It will go to the given CrudController and get the setupRoutes() method on it.
     */
    private function addRouteMacro()
    {
        Route::macro('crud', function ($name, $controller) {
            // put together the route name prefix,
            // as passed to the Route::group() statements
            $routeName = '';

            if ($this->hasGroupStack()) {
                foreach ($this->getGroupStack() as $key => $groupStack) {
                    if (isset($groupStack['name'])) {
                        if (is_array($groupStack['name'])) {
                            $routeName = implode('', $groupStack['name']);
                        } else {
                            $routeName = $groupStack['name'];
                        }
                    }
                }
            }
            // add the name of the current entity to the route name prefix
            // the result will be the current route name (not ending in dot)
            $routeName .= $name;

            // get an instance of the controller
            if ($this->hasGroupStack()) {
                $groupStack = $this->getGroupStack();
                $groupNamespace = $groupStack && isset(end($groupStack)['namespace']) ? end($groupStack)['namespace'] . '\\' : '';
            } else {
                $groupNamespace = '';
            }
            $namespacedController = $groupNamespace . $controller;

            $controllerInstance = App::make($namespacedController);

            return $controllerInstance->setupRoutes($name, $routeName, $controller);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['crud'];
    }
}



?>