<?php

$router->get('/listuser', [
  'as'         => 'get_all_user',
  'uses'       => 'Controller@index',
  'middleware' => [
    'auth:web'
  ],
]);
