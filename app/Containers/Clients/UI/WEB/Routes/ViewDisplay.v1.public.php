<?php

// /** @var Route $router */
// $router->get('clients', [
//     'as' => 'web_clients_say_view',
//     'uses'  => 'Controller@index',
//     'middleware' => [
//       'auth:web',
//     ],
// ]);
$segment = 'client';
$routeName = 'web_clients_say_view';

Route::get($segment . '/', [
  'as' => $routeName . '.index',
  'uses' => '\App\Containers\Welcome\UI\WEB\Controllers\Controller' . '@sayWelcome',
  'operation' => 'list',
]);
