<?php

$router->delete('/deletes', [
  'as' => 'delete_more_users',
  'uses' => 'Controller@deleteMoreUsers',
  'middleware' => [
    'auth:web',
  ],
]);