<?php

$router->delete('/remove-account/{id}', [
  'as' => 'remove_user_account',
  'uses' => 'Controller@removeUserAccount',
  'middleware' => [
    'auth:web'
  ],
]);