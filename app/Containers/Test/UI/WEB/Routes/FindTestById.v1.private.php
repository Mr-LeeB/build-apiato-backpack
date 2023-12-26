<?php

/** @var Route $router */
$router->get('tests/{id}', [
    'as' => 'web_test_show',
    'uses'  => 'Controller@show',
    'middleware' => [
      'auth:web',
    ],
]);
