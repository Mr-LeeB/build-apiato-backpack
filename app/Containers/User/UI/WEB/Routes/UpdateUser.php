<?php

$router->put('/update/{id}', [
  'as'         => 'update_user',
  'uses'       => 'Controller@update',
  'middleware' => [
    'auth:web'
  ],
]);
