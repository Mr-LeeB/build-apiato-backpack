<?php

namespace App\Ship\CustomContainer\Library\CrudPanel;

use App;
use App\Ship\CustomContainer\Library\Traits\Columns;
use App\Ship\CustomContainer\Library\Traits\Fields;
use App\Ship\CustomContainer\Library\Traits\Operations;


use Illuminate\Database\Eloquent\Model;

class CrudPanel
{
    use Columns, Operations, Fields;

    public $model = "\App\Models\Entity"; // what's the namespace for your entity's model
    public $route; // what route have you defined for your entity? used for links.

    public $title = "Entity"; // what's the title of your entity?

    public $formFields = []; // what fields do you want to show in the create/edit view? (see below for example)

    public $actions = []; // what actions do you want to show in the list view? (see below for example)

    public $repository; // what repository do you want to use for this entity? (see below for example)

    // The following methods are used in CrudController or your EntityCrudController to manipulate the variables above.

    public function __construct()
    {

        if ($this->getCurrentOperation()) {
            $this->setOperation($this->getCurrentOperation());
        }
    }

    /**
     * This function binds the CRUD to its corresponding Model (which extends Eloquent).
     * All Create-Read-Update-Delete operations are done using that Eloquent Collection.
     *
     * @param  string  $model_namespace  Full model namespace. Ex: App\Models\Article
     *
     * @throws \Exception in case the model does not exist
     */
    public function setModel($model_namespace)
    {
        if (!class_exists($model_namespace)) {
            throw new \Exception('The model does not exist.', 500);
        }

        if (!is_subclass_of($model_namespace, Model::class)) {
            throw new \InvalidArgumentException("Model must be a subclass of Illuminate\Database\Eloquent\Model: $this->model");
        }
        // if (!method_exists($model_namespace, 'hasCrudTrait')) {
        //     throw new \Exception('Please use CrudTrait on the model.', 500);
        // }

        $this->model = new $model_namespace();

    }

    public function setRoute($route)
    {
        $this->route = $route;
    }

    public function getRoute()
    {
        return $this->route;
    }
    /**
     * Get the corresponding Eloquent Model for the CrudController, as defined with the setModel() function.
     *
     * @return string|\Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Get the database connection, as specified in the .env file or overwritten by the property on the model.
     *
     * @return \Illuminate\Database\Schema\Builder
     */
    private function getSchema()
    {
        return $this->getModel()->getConnection()->getSchemaBuilder();
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }


    public function setFromDB($autoSetColumns = true, $autoSetFields = true)
    {
        if ($autoSetColumns) {
            $this->setColumns(App::make($this->repository)->getModel()->getFillable(), true);
        }
        if ($autoSetFields) {
            $this->setFields(App::make($this->repository)->getModel()->getFillable(), true);
        }
    }

    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

}

?>