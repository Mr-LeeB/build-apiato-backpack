<?php

/** @var Route $router */
$router->get('tests/create', [
    'as' => 'web_test_create',
    'uses'  => 'Controller@create',
    'middleware' => [
      'auth:web',
    ],
]);
