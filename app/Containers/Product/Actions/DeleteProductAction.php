<?php

namespace App\Containers\Product\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteProductAction extends Action
{
  public function run(DataTransporter $request)
  {
    return Apiato::call('Product@DeleteProductTask', [$request->id]);
  }
}