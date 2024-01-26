<?php

namespace App\Containers\Vessel\Tests\Unit;

use App\Containers\Vessel\Models\Vessel;
use App\Containers\User\Models\User;
use App\Containers\Vessel\Tests\TestCase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Class VesselControllerUnitTest.
 *
 * @group vessel
 * @group unit
 */
class VesselControllerUnitTest extends TestCase
{
  protected $public_endpoint = "/vessels";

  protected $admin;

  protected $user;

  public function setUp(): void
  {
    parent::setUp();

    //Attach permission to admin role
    Role::findByName('admin')->syncPermissions(Permission::all());
    //Assign this->admin to admin and assign role
    $this->admin = User::find(1);
    $this->admin->assignRole('admin');

    //Factory create user
    $this->user = factory(User::class)->create([
      'name' => 'Test User',
      'email' => '9hQHb@example.com',
      'password' => bcrypt('password'),
    ]);
  }

  /**
   * Test admin access endpoints function.
   * @runTestInSeparateProcess
   * @return void
   */
  public function testGetAllVessels()
  {
    //Assert 200 admin access endpoint
    $response = $this->actingAs($this->admin)->get('users/1' . $this->public_endpoint);
    $response->assertStatus(200);
    $response->assertSessionMissing('vessels');
    $response = $this->actingAs($this->user)->get($this->public_endpoint)->assertStatus(200);
  }

  /**
   * A test case for the `testGetSpecificVessel` method.
   */
  public function testGetSpecificVessel() {

    //Assert 200 admin get vessel id 1
    $response = $this->actingAs($this->admin)->get($this->public_endpoint . '/1');
    $response->assertStatus(200);
    $response->assertSee(Vessel::find(1)->name);

    //Assert 302 admin get vessel id 2
    $response = $this->from($this->public_endpoint)->actingAs($this->admin)->get($this->public_endpoint . '/2');
    $response->assertStatus(302);
    $this->assertEquals(session('errors')->getBag('default')->first(),'Vessel not found!');

    $response->assertRedirect($this->public_endpoint);

  }

  public function testGetAllPersonalVessel() {
    //Get access to personal vessel without login and assert 401
    $response = $this->get('users/1' . $this->public_endpoint)->assertStatus(401);

    //Get access to personal vessel with login and assert 200
    $response = $this->actingAs($this->user)->get('users/1' . $this->public_endpoint)->assertStatus(200);
    //See no vessel since user 1 doesn't have any vessels
    $response->assertDontSee(Vessel::find(1)->name);

    //Get access to personal vessel with login and assert 200
    $response = $this->actingAs($this->admin)->get('users/2' . $this->public_endpoint)->assertStatus(200);
    //See vessel id 1 since user 2 has vessel
    $response->assertSee(Vessel::find(1)->name);
  }


  /**
   * Test the functionality of the "testGetSpecificPersonalVessel" function.
   *
   * This function performs a series of tests to verify the behavior of the
   * "testGetSpecificPersonalVessel" function. It tests the ability to access
   * personal vessels with and without logging in, and asserts the expected
   * status codes and error messages.
   *
   * @throws \Exception if an error occurs during the test
   */
  public function testGetSpecificPersonalVessel() {
    //Get access to personal vessel without login and assert 401
    $response = $this->get('users/1' . $this->public_endpoint . '/1')->assertStatus(401);

    //Get access to personal vessel with login and assert 302 since user 1 doesn't have vessel 1
    $response = $this->actingAs($this->user)->get('users/1' . $this->public_endpoint . '/1')->assertStatus(302);
    //Assert message
    $this->assertEquals(session('errors')->getBag('default')->first(),'Vessel not found!');

    //Get access to personal vessel (ID = 99) with login and assert 302
    $response = $this->actingAs($this->user)->get('users/1' . $this->public_endpoint . '/99')->assertStatus(302);
    //Assert message
    $this->assertEquals(session('errors')->getBag('default')->first(),'Vessel not found!');

    //Get access to personal vessel with user 99 with login and assert 302
    $response = $this->actingAs($this->user)->get('users/99' . $this->public_endpoint . '/1')->assertStatus(302);
    //Assert message
    $this->assertEquals(session('errors')->getBag('default')->first(),'The requested Resource was not found.');

    //Get access to personal vessel with user 2 to vessel 1 with login and assert 200
    $response = $this->actingAs($this->user)->get('users/2' . $this->public_endpoint . '/1')->assertStatus(200);
    //See vessel id 1 since user 2 has vessel
    $response->assertSee(Vessel::find(1)->name);
  }

  public function testAccessAddVesselPage() {
    //Access add page of user 2 with user 2 and assert 200
    $response = $this->actingAs($this->user)->get('users/2' . $this->public_endpoint . '/add')->assertStatus(200);
    $response->assertSee('Add Vessel');

    //Access add page with mismatch user and owner and assert 403
    $response = $this->actingAs($this->admin)->get('users/2' . $this->public_endpoint . '/add')->assertStatus(403);
  }

  public function testAddVesselToUser() {
    $this->assertTrue(true);
  }
}
