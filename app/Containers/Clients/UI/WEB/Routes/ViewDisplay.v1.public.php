<?php

/** @var Route $router */
$router->get('clients', [
    'as' => 'web_clients_say_view',
    'uses'  => 'Controller@index',
    'middleware' => [
      'auth:web',
    ],
]);
