<?php

namespace App\Containers\Product\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Apiato\Core\Foundation\Facades\Apiato;

class FindProductByIdAction extends Action
{
  public function run(DataTransporter $data)
  {
    $product = Apiato::call('Product@FindProductByIdTask', [$data->id]);

    return $product;
  }
}
