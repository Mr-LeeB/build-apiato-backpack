<?php

namespace App\Ship\CustomContainer\Controllers\Operations;

use Illuminate\Support\Facades\Route;

trait ShowOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param  string  $segment  Name of the current entity (singular). Used as first URL segment.
     * @param  string  $routeName  Prefix of the route name.
     * @param  string  $controller  Name of the current CrudController.
     */
    protected function setupShowRoutes($segment, $routeName, $controller)
    {
        Route::get($segment . '/{id}/show', [
            'as' => $routeName . '.show',
            'uses' => $controller . '@show',
            'operation' => 'list',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupShowDefaults()
    {
        // $this->crud->allowAccess('show');
        $this->crud->setOperationSetting('setFromDb', true);

        $this->crud->operation('show', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        // $this->crud->operation('list', function () {
        //     $this->crud->addButton('line', 'show', 'view', 'crud::buttons.show', 'beginning');
        // });

        // $this->crud->operation(['create', 'update'], function () {
        //     $this->crud->addSaveAction([
        //         'name' => 'save_and_preview',
        //         'visible' => function ($crud) {
        //             return $crud->hasAccess('show');
        //         },
        //         'redirect' => function ($crud, $request, $itemId = null) {
        //             $itemId = $itemId ?: $request->input('id');
        //             $redirectUrl = $crud->route . '/' . $itemId . '/show';
        //             if ($request->has('locale')) {
        //                 $redirectUrl .= '?locale=' . $request->input('locale');
        //             }

        //             return $redirectUrl;
        //         },
        //         'button_text' => trans('backpack::crud.save_action_save_and_preview'),
        //     ]);
        // });
    }
}
