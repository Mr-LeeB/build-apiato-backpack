<?php

$router->post('/logout', [
    'as'   => 'post_user_logout_form',
    'uses' => 'UserController@logoutUser',
]);
