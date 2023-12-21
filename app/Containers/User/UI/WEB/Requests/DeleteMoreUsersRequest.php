<?php

namespace App\Containers\User\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class LoginRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteMoreUsersRequest extends Request
{

  /**
   * Define which Roles and/or Permissions has access to this request.
   *
   * @var  array
   */
  protected $access = [
    'permissions' => 'delete-users',
    'roles'       => '',
  ];

  /**
   * Id's that needs decoding before applying the validation rules.
   *
   * @var  array
   */
  protected $decode = [
    'ids.*'
  ];

  /**
   * Defining the URL parameters (`/stores/999/items`) allows applying
   * validation rules on them and allows accessing them like request data.
   *
   * @var  array
   */
  protected $urlParameters = [
  ];

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'ids'   => 'array|required',
      'ids.*' => 'exists:users,id',
    ];
  }

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return $this->check([
      'hasAccess',
    ]);
  }
}