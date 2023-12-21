<?php

$router->get('/register', [
  'as' => 'get_user_register_page',
  'uses' => 'Controller@showUserRegisterPage',
]);