<?php

$router->post('/register', [
  'as'   => 'register_user',
  'uses' => 'Controller@createItem',
]);

$router->get('/register', [
  'as'   => 'get_register_user_page',
  'uses' => 'Controller@showCreatePage',
]);
