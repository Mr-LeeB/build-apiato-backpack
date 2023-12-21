<?php

namespace App\Containers\User\Tests;

use App\Containers\User\Tests\TestCase as BaseTestCase;

/**
 * Class WebTestCase.
 *
 * This is the container WEB TestCase class. Use this class to add your container specific WEB related helper functions.
 */
class WebTestCase extends BaseTestCase
{
  public function setUp(): void
  {
    // change the API_PREFIX for web tests
    putenv("API_PREFIX=api");

    parent::setUp();
  }

  public function tearDown(): void
  {
    // revert the API_PREFIX variable to null to avoid effects on other test
    putenv("API_PREFIX=");

    parent::tearDown();
  }
}
