<?php

Route::prefix('users')->group(function () {

  Route::get('/', [
    'as' => 'get_user_home_page',
    'uses' => 'Controller@getAllUser',
  ]);

  Route::get('/{id}/ajax', [
    'as' => 'find_user_by_id',
    'uses' => 'Controller@show',
  ]);

  Route::get('/name/{name}', [
    'as' => 'find_user_by_name',
    'uses' => 'Controller@show',
  ]);
});

Route::prefix('role')->group(function () {
  Route::post('/assign', [
    'as' => 'assign_user_to_role',
    'uses' => 'Controller@assignUserToRole',
  ]);

  Route::post('/revoke', [
    'as' => 'revoke_user_from_role',
    'uses' => 'Controller@revokeUserFromRole',
  ]);
});