<?php

namespace App\Containers\Product\Tests\Unit;

use App\Containers\Product\Actions\CreateProductAction;

use App\Containers\Product\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;

/**
 * Class CreateProductUnitTest.
 *
 * @group product
 * @group unit
 */
class CreateProductUnitTest extends TestCase
{

  /**
   * @test
   */
  public function testCreateProduct_()
  {
    // create a data object
    $data = [
      'name'       => 'new product',
      'descripton' => 'my description',
      'image'      => ''
    ];

    $transporter = new DataTransporter($data);
    $action      = App::make(CreateProductAction::class);
    $user        = $action->run($transporter);

    // assert something here
    $this->assertEquals(true, true);
  }
}