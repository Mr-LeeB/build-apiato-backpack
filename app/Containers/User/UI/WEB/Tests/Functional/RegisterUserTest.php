<?php

namespace App\Containers\User\UI\WEB\Tests\Functional;

use App\Containers\User\Tests\WebTestCase;

/**
 * Class DeleteUserTest.
 *
 * @group user
 * @group web
 */
class RegisterUserTest extends WebTestCase
{
  protected $endpoint = '/register';
  protected $auth = false;
  protected $access = [
    'roles' => '',
    'permissions' => '',
  ];
  public function testRegisterNewUserWithCredentials_()
  {
    // prepare your post data
    $data = [
      'email' => 'hello@mail.test',
      'name' => 'Mahmoud',
      'password' => 'secret',
    ];

    // send the HTTP request
    $response = $this->post($this->endpoint, $data);
    // assert response status is redirection
    $response->assertStatus(302);

    // assert the response contain the correct message
    $response->assertRedirect('/login');
  }

  public function testRegisterNewUserUsingGetVerb()
  {
    // send the HTTP request
    $response = $this->get($this->endpoint);

    // assert response status is correct
    $response->assertStatus(200);

    // assert the response contain the correct message
    $response->assertSee('Register');
  }

  public function testRegisterNewUserWithoutCredentials_()
  {
    // send the HTTP request
    $response = $this->post($this->endpoint);

    // assert response status is correct
    $response->assertStatus(302);

    // assert the response contain the correct message
    $response->assertSessionHasErrors(['email', 'password']);

    // assert the session errors are correct
    $messages = session('errors')->getMessages();
    $this->assertEquals($messages['email'][0], 'The email field is required.');
    $this->assertEquals($messages['password'][0], 'The password field is required.');
  }

  public function testRegisterNewUserWithoutEmail_()
  {
    // prepare your post data
    $data = [
      'name' => 'Mahmoud',
      'password' => 'secret',
    ];
    // send the HTTP request
    $response = $this->post($this->endpoint, $data);

    // assert response status is correct
    $response->assertStatus(302);

    // assert the response contain the correct message
    $response->assertSessionHasErrors(['email']);

    // assert the session errors are correct
    $messages = session('errors')->getMessages();
    $this->assertEquals($messages['email'][0], 'The email field is required.');
  }

  public function testRegisterNewUserWithErrorEmail()
  {
    // prepare your post data
    $data = [
      'email' => 'hellomail.test',
      'name' => 'Mahmoud',
      'password' => 'secret',
    ];

    // send the HTTP request
    $response = $this->post($this->endpoint, $data);

    // assert response status is correct
    $response->assertStatus(302);

    // assert the response contain the correct message
    $response->assertSessionHasErrors(['email']);

    // assert the session errors are correct
    $messages = session('errors')->getMessages();
    $this->assertEquals($messages['email'][0], 'The email must be a valid email address.');
  }

  public function testRegisterNewUserWithoutPassword_()
  {
    // prepare your post data
    $data = [
      'email' => 'email@gmail.com',
      'name' => 'Mahmoud',
    ];
    // send the HTTP request
    $response = $this->post($this->endpoint, $data);

    // assert response status is correct
    $response->assertStatus(302);

    // assert the response contain the correct message
    $response->assertSessionHasErrors(['password']);

    // assert the session errors are correct
    $messages = session('errors')->getMessages();
    $this->assertEquals($messages['password'][0], 'The password field is required.');
  }


}

?>
