<?php

$router->get('/listuser', [
  'as' => 'get_all_user',
  'uses' => 'Controller@getAllUser',
  'middleware' => [
    'auth:web'
  ],
]);
