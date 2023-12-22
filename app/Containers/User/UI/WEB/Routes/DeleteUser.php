<?php

$router->delete('/delete/{id}', [
  'as' => 'delete_user',
  'uses' => 'Controller@deleteItem',
  'middleware' => [
    'auth:web'
  ],
]);