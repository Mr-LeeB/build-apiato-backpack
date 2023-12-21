<?php

namespace App\Containers\Product\UI\API\Transformers;

use App\Containers\Product\Models\Product;
use App\Ship\Parents\Transformers\Transformer;

class ProductTransformer extends Transformer
{
  /**
   * @var  array
   */
  protected $defaultIncludes = [

  ];

  /**
   * @var  array
   */
  protected $availableIncludes = [

  ];

  /**
   * @param Product $entity
   *
   * @return array
   */
  public function transform(Product $entity)
  {
    $response = [
      'object' => 'Product',
      'id' => $entity->getHashedKey(),
      'name' => $entity->name,
      'description' => $entity->description,
      'image' => $entity->image,
      
      'created_at' => $entity->created_at,
      'updated_at' => $entity->updated_at,

    ];

    $response = $this->ifAdmin([
      'real_id' => $entity->id,
      // 'deleted_at' => $entity->deleted_at,
    ], $response);

    return $response;
  }
}