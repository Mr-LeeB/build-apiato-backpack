<?php

namespace App\Ship\CustomContainer\Library\Traits;

trait Operations
{

    public $currentOperation;

    public function __construct()
    {
        if ($this->getCurrentOperation()) {
            $this->setCurrentOperation($this->getCurrentOperation());
        }
    }

    /**
     * Get the current CRUD operation being performed.
     *
     * @return string Operation being performed in string form.
     */
    public function getCurrentOperation()
    {
        return $this->currentOperation ?? \Route::getCurrentRoute()->action['operation'] ?? null;
    }


    /**
     * Set the CRUD operation being performed in string form.
     *
     * @param  string  $operation_name  Ex: create / update / revision / delete
     */
    public function setCurrentOperation($operation)
    {
        $this->currentOperation = $operation;
    }

    /**
     * Set the CRUD operation being performed in string form.
     *
     * @param  string  $operation_name  Ex: create / update / revision / delete
     */
    public function setOperation($operation_name)
    {
        return $this->setCurrentOperation($operation_name);
    }
}

?>