<?php

namespace App\Ship\CustomContainer\Library\Traits;

trait Fields
{

    public $fields = [];

    protected function setFields($fields, $autoset = false)
    {
        if ($autoset) {
            foreach ($fields as $value) {
                $this->fields[$value] = [
                    'label' => $this->makeLabel($value),
                    'type' => $this->inferFieldTypeFromDbColumnType($value),
                    'name' => $value,
                ];
            }

            if ($this->fields['password']) {
                unset($this->fields['password']);
            }
            return;
        }

        $this->fields = $fields;
    }

    protected function getFields()
    {
        return $this->fields;
    }

}

?>