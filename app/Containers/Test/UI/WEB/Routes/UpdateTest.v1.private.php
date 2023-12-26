<?php

/** @var Route $router */
$router->patch('tests/{id}', [
    'as' => 'web_test_update',
    'uses'  => 'Controller@update',
    'middleware' => [
      'auth:web',
    ],
]);
