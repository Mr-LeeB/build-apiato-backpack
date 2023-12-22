<?php

$router->put('/update/{id}', [
  'as'         => 'update_user',
  'uses'       => 'Controller@updateItem',
  'middleware' => [
    'auth:web'
  ],
]);
