<?php

$router->get('/listuser', [
  'as'         => 'get_all_user',
  'uses'       => 'Controller@getAllItem',
  'middleware' => [
    'auth:web'
  ],
]);
