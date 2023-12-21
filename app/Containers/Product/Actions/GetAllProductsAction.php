<?php

namespace App\Containers\Product\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllProductsAction extends Action
{
  public function run()
  {
    $products = Apiato::call('Product@GetAllProductsTask', [], ['addRequestCriteria', 'ordered']);

    return $products;
  }
}
