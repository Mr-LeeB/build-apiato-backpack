<?php

namespace App\Containers\Vessel\Actions;

use App\Containers\Vessel\Models\Vessel;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class AddVesselToUserAction extends Action
{
  public function run(DataTransporter $data, $photos): Vessel
  {

    $vessel = Apiato::call('Vessel@CreateVesselTask', [
      $data->userId,
      $data->name,
      $data->description,
      $data->quantity,
      $data->price,
      $data->brand
    ]);

    Apiato::call('Vessel@UploadVesselImagesTask', [
      $vessel->id,
      $photos,
    ]);

    return $vessel;
  }
}
