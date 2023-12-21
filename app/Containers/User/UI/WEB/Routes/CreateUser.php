<?php

$router->post('/create', [
  'as' => 'create_new_user',
  'uses' => 'Controller@createUser',
  'middleware' => [
    'auth:web',
  ],
]);
