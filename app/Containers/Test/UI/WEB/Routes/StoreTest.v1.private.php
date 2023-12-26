<?php

/** @var Route $router */
$router->post('tests/store', [
    'as' => 'web_test_store',
    'uses'  => 'Controller@store',
    'middleware' => [
      'auth:web',
    ],
]);
