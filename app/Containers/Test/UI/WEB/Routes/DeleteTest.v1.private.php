<?php

/** @var Route $router */
$router->delete('tests/{id}', [
    'as' => 'web_test_delete',
    'uses'  => 'Controller@delete',
    'middleware' => [
      'auth:web',
    ],
]);
