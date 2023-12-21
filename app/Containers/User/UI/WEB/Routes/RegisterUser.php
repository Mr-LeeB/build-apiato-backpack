<?php

$router->post('/register', [
  'as' => 'register_user',
  'uses' => 'Controller@registerUser',
]);
