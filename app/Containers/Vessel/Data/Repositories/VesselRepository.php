<?php

namespace App\Containers\Vessel\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class ProductRepository
 */
class VesselRepository extends Repository
{

  /**
   * @var array
   */
  protected $fieldSearchable = [
    'id' => '=',
    'name' => 'like',
  ];

}
