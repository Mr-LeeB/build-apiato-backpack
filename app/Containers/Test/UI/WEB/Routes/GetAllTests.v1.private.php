<?php

/** @var Route $router */
$router->get('tests', [
    'as' => 'web_test_index',
    'uses'  => 'Controller@index',
    'middleware' => [
      'auth:web',
    ],
]);
