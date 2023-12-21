<?php

$router->delete('/delete/{id}', [
  'as' => 'delete_user',
  'uses' => 'Controller@deleteUser',
  'middleware' => [
    'auth:web'
  ],
]);