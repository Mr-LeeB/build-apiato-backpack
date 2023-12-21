<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Actions\UpdateUserAction;
use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;
use Log;

/**
 * Class CreateUserTest.
 *
 * @group user
 * @group unit
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserTest extends TestCase
{

  /**
   * @test
   */
  public function testUpdateUser_()
  {
    $oldUser = $this->getTestingUser();
    $data = [
      'id' => $oldUser->id,
      'email' => $oldUser->email,
      'name' => 'Mahmoud',
    ];

    $transporter = new DataTransporter($data);
    $action = App::make(UpdateUserAction::class);
    $user = $action->run($transporter);

    // asset the returned object is an instance of the User
    $this->assertInstanceOf(User::class, $user);

    $this->assertNotEquals($user->name, $oldUser->name);

    Log::info("After update: " . $user->name . " | " . "Before update: " . $oldUser->name);
  }
}