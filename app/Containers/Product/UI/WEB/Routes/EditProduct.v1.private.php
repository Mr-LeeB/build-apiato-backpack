<?php

/** @var Route $router */
$router->get('products/{id}/edit', [
    'as' => 'web_product_edit',
    'uses'  => 'Controller@edit',
    'middleware' => [
      'auth:web',
    ],
]);
