<?php

$router->post('/check-password', [
  'as' => 'check_password',
  'uses' => 'Controller@checkPassword',
  'middleware' => [
    'auth:web',
  ],
]);