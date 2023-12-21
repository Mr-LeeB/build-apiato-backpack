<?php
namespace App\Containers\Product\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteBulkProductAction extends Action
{
  public function run(DataTransporter $request)
  {
    $product_Ids = [];
    $product = Apiato::call('Product@FindProductByIdTask', [$request->id]);

    foreach ($product as $Pid) {
      array_push($product_Ids, $Pid->id);
    }
    return Apiato::call('Product@DeleteBulkProductTask', [$product_Ids]);
  }
}
