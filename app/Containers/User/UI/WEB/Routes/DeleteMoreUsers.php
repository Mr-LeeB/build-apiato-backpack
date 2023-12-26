<?php

$router->post('/deletes', [
  'as'         => 'delete_more_users',
  'uses'       => 'Controller@bulkDelete',
  'middleware' => [
    'auth:web',
  ],
]);