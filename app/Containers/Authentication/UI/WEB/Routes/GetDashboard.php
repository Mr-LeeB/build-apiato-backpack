<?php

$router->get('/dashboard', [
    'as'         => 'get_admin_dashboard_page',
    'uses'       => 'Controller@viewDashboardPage',
    'middleware' => [
        'auth:web'
    ],
]);
