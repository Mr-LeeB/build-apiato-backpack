<?php

namespace App\Containers\Vessel\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class ProductImagesRepository
 */
class VesselImagesRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
