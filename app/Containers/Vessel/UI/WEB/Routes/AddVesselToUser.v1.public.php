<?php

/** @var Route $router */
$router->get('users/{userId}/vessels/add', [
  'as' => 'web_vessel_show_add_form',
  'uses'  => 'Controller@addVesselsPage',
  'middleware' => [
    'auth:web',
  ],
]);

$router->post('users/{userId}/vessels/add-vessel', [
  'as' => 'web_vessel_add_to_user',
  'uses'  => 'Controller@addVesselToUser',
  'middleware' => [
    'auth:web',
  ]
]);
