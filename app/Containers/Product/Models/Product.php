<?php

namespace App\Containers\Product\Models;

use App\Containers\User\Models\User;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
  protected $guard_name = 'web';

  protected $fillable = [
    'name',
    'description',
    'image',
    'user_id',
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

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }
}
