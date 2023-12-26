<?php

/** @var Route $router */
$router->get('tests/{id}/edit', [
    'as' => 'web_test_edit',
    'uses'  => 'Controller@edit',
    'middleware' => [
      'auth:web',
    ],
]);
