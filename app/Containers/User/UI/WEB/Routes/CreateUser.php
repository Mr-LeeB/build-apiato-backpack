<?php

$router->post('/create', [
  'as'         => 'create_new_user',
  'uses'       => 'Controller@createItem',
  'middleware' => [
    'auth:web',
  ],
]);

$router->get('/create', [
  'as'         => 'get_create_user_page',
  'uses'       => 'Controller@showCreatePage',
  'middleware' => [
    'auth:web',
  ],
]);
