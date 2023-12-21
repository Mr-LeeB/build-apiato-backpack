<?php

Route::prefix('/authorization')->group(
  function () {
    Route::get('/', [
      'as' => 'get_authorization_home_page',
      'uses' => 'Controller@getAllRolePermission',
      'middleware' => [
        'auth:web',
      ],
    ]);
    Route::post('/roles', [
      'as' => 'create_role',
      'uses' => 'Controller@createRole',
      'middleware' => [
        'auth:web',
      ],
    ]);

    Route::put('/roles/{id}', [
      'as' => 'update_role',
      'uses' => 'Controller@updateRole',
      'middleware' => [
        'auth:web',
      ],
    ]);

    Route::delete('/roles/{id}', [
      'as' => 'delete_role',
      'uses' => 'Controller@deleteRole',
      'middleware' => [
        'auth:web',
      ],
    ]);

    Route::post('/roles/attach', [
      'as' => 'attach_permission_to_role',
      'uses' => 'Controller@attachPermissionToRole',
      'middleware' => [
        'auth:web',
      ],
    ]);

    Route::post('/roles/detach', [
      'as' => 'detach_permission_to_role',
      'uses' => 'Controller@detachPermissionToRole',
      'middleware' => [
        'auth:web',
      ],
    ]);
  }
);