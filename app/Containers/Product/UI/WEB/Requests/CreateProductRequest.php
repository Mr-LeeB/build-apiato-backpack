<?php

namespace App\Containers\Product\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class CreateProductRequest.
 */
class CreateProductRequest extends Request
{

  /**
   * The assigned Transporter for this Request
   *
   * @var string
   */
  // protected $transporter = \App\Ship\Transporters\DataTransporter::class;

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
    'id',
  ];

  /**
   * Defining the URL parameters (e.g, `/user/{id}`) allows applying
   * validation rules on them and allows accessing them like request data.
   *
   * @var  array
   */
  protected $urlParameters = [
    // 'id',
  ];

  /**
   * @return  array
   */
  public function rules()
  {
    return [
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