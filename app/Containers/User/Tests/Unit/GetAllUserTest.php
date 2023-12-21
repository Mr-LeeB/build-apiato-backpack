<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Actions\GetAllUsersAction;
use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;
use Log;

/**
 * Class DeleteUserTest.
 *
 * @group user
 * @group unit
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllUserTest extends TestCase
{

  /**
   * @test
   */
  public function testGetAllUser_()
  {
    // creating 4 users
    factory(User::class, 8)->create();
    $transporter = new DataTransporter();
    $action = App::make(GetAllUsersAction::class);
    $user = $action->run($transporter);

    // asset get all user
    for ($i = 0; $i < count($user); $i++) {
      $this->assertInstanceOf(User::class, $user[$i]);
      Log::info($user[$i]);
    }
  }
}
