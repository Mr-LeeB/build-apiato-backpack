<?php

namespace App\Ship\CustomContainer\Library\CrudPanel;

use App;
use App\Ship\CustomContainer\Library\Traits\AutoSet;
use App\Ship\CustomContainer\Library\Traits\Columns;
use App\Ship\CustomContainer\Library\Traits\FakeColumns;
use App\Ship\CustomContainer\Library\Traits\Fields;
use App\Ship\CustomContainer\Library\Traits\Operations;
use App\Ship\CustomContainer\Library\Traits\Read;
use App\Ship\CustomContainer\Library\Traits\Relationships;
use App\Ship\CustomContainer\Library\Traits\Search;


use App\Ship\CustomContainer\Library\Traits\Settings;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class CrudPanel
{
    use Columns, Operations, Fields, Search, FakeColumns, Read, Settings, AutoSet, Relationships;

    public $model = "\App\Models\Entity"; // what's the namespace for your entity's model
    public $route; // what route have you defined for your entity? used for links.

    public $title = "Entity"; // what's the title of your entity?

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
     * @throws Exception in case the model does not exist
     */
    public function setModel($model_namespace)
    {
        if (!class_exists($model_namespace)) {
            throw new Exception('The model does not exist.', 500);
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

    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

    /**
     * Check if the database connection is any sql driver.
     *
     * @return bool
     */
    private function driverIsSql()
    {
        $driver = $this->getSchema()->getConnection()->getConfig('driver');

        return in_array($driver, $this->getSqlDriverList());
    }

    /**
     * Get SQL driver list.
     *
     * @return array
     */
    public function getSqlDriverList()
    {
        return ['mysql', 'sqlsrv', 'sqlite', 'pgsql'];
    }

    /**
     * Check if the method in the given model has any parameters.
     *
     * @param  object  $model
     * @param  string  $method
     * @return bool
     */
    private function modelMethodHasParameters($model, $method)
    {
        $reflectClassMethod = new \ReflectionMethod(get_class($model), $method);

        if ($reflectClassMethod->getNumberOfParameters() > 0) {
            return true;
        }

        return false;
    }

    /**
     * Get the Eloquent Model name from the given relation definition string.
     *
     * @example For a given string 'company' and a relation between App/Models/User and App/Models/Company, defined by a
     *          company() method on the user model, the 'App/Models/Company' string will be returned.
     * @example For a given string 'company.address' and a relation between App/Models/User, App/Models/Company and
     *          App/Models/Address defined by a company() method on the user model and an address() method on the
     *          company model, the 'App/Models/Address' string will be returned.
     *
     * @param  string  $relationString  Relation string. A dot notation can be used to chain multiple relations.
     * @param  int  $length  Optionally specify the number of relations to omit from the start of the relation string. If
     *                       the provided length is negative, then that many relations will be omitted from the end of the relation
     *                       string.
     * @param  \Illuminate\Database\Eloquent\Model  $model  Optionally specify a different model than the one in the crud object.
     * @return string Relation model name.
     */
    public function getRelationModel($relationString, $length = null, $model = null)
    {
        $relationArray = explode('.', $relationString);

        if (!isset($length)) {
            $length = count($relationArray);
        }

        if (!isset($model)) {
            $model = $this->model;
        }

        $result = array_reduce(array_splice($relationArray, 0, $length), function ($obj, $method) {
            try {
                $result = $obj->$method();

                return $result->getRelated();
            } catch (Exception $e) {
                return $obj;
            }
        }, $model);

        return get_class($result);
    }

    /**
     * Get the given attribute from a model or models resulting from the specified relation string (eg: the list of streets from
     * the many addresses of the company of a given user).
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model  Model (eg: user).
     * @param  string  $relationString  Model relation. Can be a string representing the name of a relation method in the given
     *                                  Model or one from a different Model through multiple relations. A dot notation can be used to specify
     *                                  multiple relations (eg: user.company.address).
     * @param  string  $attribute  The attribute from the relation model (eg: the street attribute from the address model).
     * @return array An array containing a list of attributes from the resulting model.
     */
    public function getRelatedEntriesAttributes($model, $relationString, $attribute)
    {
        $endModels = $this->getRelatedEntries($model, $relationString);
        $attributes = [];
        foreach ($endModels as $model => $entries) {
            $model_instance = new $model();
            $modelKey = $model_instance->getKeyName();

            if (is_array($entries)) {
                //if attribute does not exist in main array we have more than one entry OR the attribute
                //is an acessor that is not in $appends property of model.
                if (!isset($entries[$attribute])) {
                    //we first check if we don't have the attribute because it's an acessor that is not in appends.
                    if ($model_instance->hasGetMutator($attribute) && isset($entries[$modelKey])) {
                        $entry_in_database = $model_instance->find($entries[$modelKey]);
                        $attributes[$entry_in_database->{$modelKey}] = $this->parseTranslatableAttributes($model_instance, $attribute, $entry_in_database->{$attribute});
                    } else {
                        //we have multiple entries
                        //for each entry we check if $attribute exists in array or try to check if it's an acessor.
                        foreach ($entries as $entry) {
                            if (isset($entry[$attribute])) {
                                $attributes[$entry[$modelKey]] = $this->parseTranslatableAttributes($model_instance, $attribute, $entry[$attribute]);
                            } else {
                                if ($model_instance->hasGetMutator($attribute)) {
                                    $entry_in_database = $model_instance->find($entry[$modelKey]);
                                    $attributes[$entry_in_database->{$modelKey}] = $this->parseTranslatableAttributes($model_instance, $attribute, $entry_in_database->{$attribute});
                                }
                            }
                        }
                    }
                } else {
                    //if we have the attribute we just return it, does not matter if it is direct attribute or an acessor added in $appends.
                    $attributes[$entries[$modelKey]] = $this->parseTranslatableAttributes($model_instance, $attribute, $entries[$attribute]);
                }
            }
        }

        return $attributes;
    }

    /**
     * Traverse the tree of relations for the given model, defined by the given relation string, and return the ending
     * associated model instance or instances.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model  The CRUD model.
     * @param  string  $relationString  Relation string. A dot notation can be used to chain multiple relations.
     * @return array An array of the associated model instances defined by the relation string.
     */
    private function getRelatedEntries($model, $relationString)
    {
        $relationArray = explode('.', $this->getOnlyRelationEntity(['entity' => $relationString]));
        $firstRelationName = Arr::first($relationArray);
        $relation = $model->{$firstRelationName};

        $results = [];
        if (!is_null($relation)) {
            if ($relation instanceof Collection) {
                $currentResults = $relation->all();
            } elseif (is_array($relation)) {
                $currentResults = $relation;
            } elseif ($relation instanceof Model) {
                $currentResults = [$relation];
            } else {
                $currentResults = [];
            }

            array_shift($relationArray);

            if (!empty($relationArray)) {
                foreach ($currentResults as $currentResult) {
                    $results = array_merge_recursive($results, $this->getRelatedEntries($currentResult, implode('.', $relationArray)));
                }
            } else {
                $relatedClass = get_class($model->{$firstRelationName}()->getRelated());
                $results[$relatedClass] = $currentResults;
            }
        }

        return $results;
    }
    /**
     * Parse translatable attributes from a model or models resulting from the specified relation string.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model  Model (eg: user).
     * @param  string  $attribute  The attribute from the relation model (eg: the street attribute from the address model).
     * @param  string  $value  Attribute value translatable or not
     * @return string A string containing the translated attributed based on app()->getLocale()
     */
    public function parseTranslatableAttributes($model, $attribute, $value)
    {
        if (!method_exists($model, 'isTranslatableAttribute')) {
            return $value;
        }

        if (!$model->isTranslatableAttribute($attribute)) {
            return $value;
        }

        if (!is_array($value)) {
            $decodedAttribute = json_decode($value, true);
        } else {
            $decodedAttribute = $value;
        }

        if (is_array($decodedAttribute) && !empty($decodedAttribute)) {
            if (isset($decodedAttribute[app()->getLocale()])) {
                return $decodedAttribute[app()->getLocale()];
            } else {
                return Arr::first($decodedAttribute);
            }
        }

        return $value;
    }
}
