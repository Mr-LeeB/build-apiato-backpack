<?php

/** @var Route $router */
$router->get('vessels', [
    'as' => 'web_vessel_get_all_vessels',
    'uses'  => 'Controller@getAllVessels',
    /* No guard here
    'middleware' => [
      'auth:web',
    ],
    */
]);

$router->get('vessels/{id}', [
    'as' => 'web_vessel_get_specific_vessel',
    'uses' => 'Controller@showSpecificVessel',
    /* No guard here
    'middleware' => [
      'auth:web',
    ]
    */
]);
