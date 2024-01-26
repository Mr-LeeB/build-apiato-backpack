<?php

namespace App\Containers\Vessel\Models;

use App\Containers\Vessel\Models\Vessel;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VesselImages extends Model
{
    protected $table = 'vessel_images';

    protected $fillable = [
        'vessel_id',
        'name'
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
    protected $resourceKey = 'vesselImages';

    public function getOwner(): BelongsTo {
        return $this->belongsTo(Vessel::class, 'vessel_id', 'id');
    }
}
