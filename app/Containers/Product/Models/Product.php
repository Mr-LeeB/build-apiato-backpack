<?php

namespace App\Containers\Product\Models;

use App\Ship\Parents\Models\Model;

class Product extends Model
{
  protected $guard_name = 'web';

  protected $fillable = [
    'name',
    'description',
    'image'
  ];

  protected $hidden = [

  ];

  protected $casts = [

  ];

  protected $dates = [
    'created_at',
    'updated_at',
  ];

  /**
   * A resource key to be used by the the JSON API Serializer responses.
   */
  protected $resourceKey = 'products';
}
