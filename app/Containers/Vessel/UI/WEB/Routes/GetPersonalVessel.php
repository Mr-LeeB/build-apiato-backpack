<?php

/** @var Route $router */
$router->get('users/{userId}/vessels', [
  'as' => 'web_vessel_show_all_personal',
  'uses' => 'Controller@showAllPersonalVessels',
  'middleware' => [
    'auth:web',
  ],
]);


$router->get('users/{userId}/vessels/{id}', [
  'as' => 'web_vessel_show_specific_personal',
  'uses' => 'Controller@showSpecificPersonalVessel',
  'middleware' => [
    'auth:web',
  ],
]);
