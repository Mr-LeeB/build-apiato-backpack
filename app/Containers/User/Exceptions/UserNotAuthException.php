<?php

namespace App\Containers\User\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class UserNotAuthException extends Exception
{
  public $httpStatusCode = Response::HTTP_BAD_REQUEST;

  public $message = 'Test Exception for UserNotAuthException.';

  public $code = 0;
}
