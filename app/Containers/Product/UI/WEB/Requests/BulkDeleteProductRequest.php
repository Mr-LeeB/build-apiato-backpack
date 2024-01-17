<?php

namespace App\Containers\Product\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class BulkDeleteProductRequest.
 */
class BulkDeleteProductRequest extends Request
{
  /**
   * Define which Roles and/or Permissions has access to this request.
   *
   * @var  array
   */
  protected $access = [
    'permissions' => '',
    'roles' => '',
  ];

  /**
   * Id's that needs decoding before applying the validation rules.
   *
   * @var  array
   */
  protected $decode = [
    'ids.*',
  ];

  /**
   * Defining the URL parameters (e.g, `/user/{id}`) allows applying
   * validation rules on them and allows accessing them like request data.
   *
   * @var  array
   */
  protected $urlParameters = [
  ];

  /**
   * @return  array
   */
  public function rules()
  {
    return [
      'ids' => 'array|required',
      'ids.*' => 'exists:products,id',
    ];
  }

  /**
   * @return  bool
   */
  public function authorize()
  {
    return $this->check([
      'hasAccess',
    ]);
  }
}