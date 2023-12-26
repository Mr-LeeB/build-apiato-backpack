<?php

$router->delete('/delete/{id}', [
  'as'         => 'delete_user',
  'uses'       => 'Controller@delete',
  'middleware' => [
    'auth:web'
  ],
]);