<?php

namespace App\Containers\Clients\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class ClientsRepository
 */
class ClientsRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
