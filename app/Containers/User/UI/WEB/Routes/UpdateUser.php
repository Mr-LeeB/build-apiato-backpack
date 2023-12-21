<?php

$router->put('/update/{id}', [
  'as' => 'update_user',
  'uses' => 'Controller@updateUser',
  'middleware' => [
    'auth:web'
  ],
]);
