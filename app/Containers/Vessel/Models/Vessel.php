<?php

namespace App\Containers\Vessel\Models;

use App\Containers\User\Models\User;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vessel extends Model
{
  protected $table = 'vessels';
  protected $fillable = [
    'user_id',
    'name',
    'description',
    'price',
    'quantity',
    'brand',
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
  protected $resourceKey = 'vessels';

  public function getOwner(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function getImages()
  {
    return $this->hasMany(VesselImages::class, 'product_id', 'id');
  }
}
