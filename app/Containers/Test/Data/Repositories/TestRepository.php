<?php

namespace App\Containers\Test\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class TestRepository
 */
class TestRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
