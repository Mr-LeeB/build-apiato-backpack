<?php

namespace App\Containers\Clients\Models;

use App\Ship\Parents\Models\Model;

class Clients extends Model
{
    protected $fillable = [
      'name',
      'title_description',
      'detail_description',
      'is_publish',
      'images',
    ];

    protected $attributes = [

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
    protected $resourceKey = 'clients';
}
