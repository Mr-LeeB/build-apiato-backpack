<?php

/** @var Route $router */
$router->post('products/store', [
    'as' => 'web_product_store',
    'uses'  => 'Controller@store',
    'middleware' => [
      'auth:web',
    ],
]);
