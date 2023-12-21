<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Actions\DeleteUserAction;
use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;

/**
 * Class DeleteUserTest.
 *
 * @group user
 * @group unit
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserTest extends TestCase
{

  /**
   * @test
   */
  public function testDeteleUser_()
  {
    $user = $this->getTestingUser();
    $data = [
      'id' => $user->id,
      // 'id' => '100',
      'email' => $user->email,
      'name' => $user->name,
    ];

    $transporter = new DataTransporter($data);
    $action = App::make(DeleteUserAction::class);
    $deletedUser = $action->run($transporter);

    // asset the user is deleted
    $this->assertTrue($deletedUser);
  }
}
