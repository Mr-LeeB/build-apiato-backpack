<?php

namespace App\Containers\Product\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class ProductNameIsExistedException extends Exception
{
  public $httpStatusCode = Response::HTTP_BAD_REQUEST;

  public $message = 'Product name is existed.';

  public $code = 0;
}