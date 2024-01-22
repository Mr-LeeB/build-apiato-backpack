<?php

namespace App\Ship\CustomContainer\Library\Traits;

trait Columns
{
    public $columns = [];

    public function setColumns($columns, $autoset = false)
    {
        if ($autoset) {
            foreach ($columns as $value) {
                $this->columns[$value] = [
                    'label' => $this->makeLabel($value),
                    'type' => $this->inferFieldTypeFromDbColumnType($value),
                    'name' => $value,
                ];
            }

            if (isset($this->columns['password'])) {
                unset($this->columns['password']);
            }
            return;
        }

        $this->columns = $columns;
    }

    protected function getColumns()
    {
        return $this->columns;
    }


    /**
     * Get all columns from the database for that table.
     *
     * @return array
     */
    public function getDbColumnTypes()
    {
        $this->setDoctrineTypesMapping();

        $dbColumnTypes = [];

        foreach ($this->getDbTableColumns() as $key => $column) {
            $column_type = $column->getType()->getName();
            $dbColumnTypes[$column->getName()]['type'] = trim(preg_replace('/\(\d+\)(.*)/i', '', $column_type));
            $dbColumnTypes[$column->getName()]['default'] = $column->getDefault();
        }

        return $dbColumnTypes;
    }



    /**
     * Get all columns in the database table.
     *
     * @return array
     */
    public function getDbTableColumns()
    {
        // if (isset($this->autoset['table_columns']) && $this->autoset['table_columns']) {
        //     return $this->autoset['table_columns'];
        // }

        $conn = $this->model->getConnection();
        $table = $conn->getTablePrefix() . $this->model->getTable();
        $columns = $conn->getDoctrineSchemaManager()->listTableColumns($table);

        // $this->autoset['table_columns'] = $columns;

        return $columns;
    }

    /**
     * Turn a database column name or PHP variable into a pretty label to be shown to the user.
     *
     * @param  string  $value  The value.
     * @return string The transformed value.
     */
    public function makeLabel($value)
    {
        return trim($this->mb_ucfirst(str_replace('_', ' ', preg_replace('/(_id|_at|\[\])$/i', '', $value))));
    }

    /**
     * Capitalize the first letter of a string,
     * even if that string is multi-byte (non-latin alphabet).
     *
     * @param  string  $string  String to have its first letter capitalized.
     * @param  \Defuse\Crypto\Encoding  $encoding  Character encoding
     * @return string String with first letter capitalized.
     */
    function mb_ucfirst($string, $encoding = false)
    {
        $string = $string ?? '';
        $encoding = $encoding ? $encoding : mb_internal_encoding();

        $strlen = mb_strlen($string, $encoding);
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, $strlen - 1, $encoding);

        return mb_strtoupper($firstChar, $encoding) . $then;
    }

    /**
     * Infer a field type, judging from the database column type.
     *
     * @param  string  $field  Field name.
     * @return string Field type.
     */
    protected function inferFieldTypeFromDbColumnType($fieldName)
    {
        if ($fieldName == 'password') {
            return 'password';
        }

        if ($fieldName == 'email') {
            return 'email';
        }

        if (is_array($fieldName)) {
            return 'text'; // not because it's right, but because we don't know what it is
        }

        $dbColumnTypes = $this->getDbColumnTypes();

        if (!isset($dbColumnTypes[$fieldName])) {
            return 'text';
        }

        switch ($dbColumnTypes[$fieldName]['type']) {
            case 'int':
            case 'integer':
            case 'smallint':
            case 'mediumint':
            case 'longint':
                return 'number';

            case 'string':
            case 'varchar':
            case 'set':
                return 'text';

            case 'boolean':
                return 'boolean';

            case 'tinyint':
                return 'active';

            case 'text':
            case 'mediumtext':
            case 'longtext':
                return 'textarea';

            case 'date':
                return 'date';

            case 'datetime':
            case 'timestamp':
                return 'datetime';

            case 'time':
                return 'time';

            case 'json':
                return 'table';

            default:
                return 'text';
        }
    }

    // Fix for DBAL not supporting enum
    public function setDoctrineTypesMapping()
    {
        $types = ['enum' => 'string'];
        $platform = $this->getSchema()->getConnection()->getDoctrineSchemaManager()->getDatabasePlatform();
        foreach ($types as $type_key => $type_value) {
            if (!$platform->hasDoctrineTypeMappingFor($type_key)) {
                $platform->registerDoctrineTypeMapping($type_key, $type_value);
            }
        }
    }

}
