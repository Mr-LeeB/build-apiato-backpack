<?php

$router->post('/login', [
    'as'   => 'post_user_login_form',
    'uses' => 'UserController@loginUser',
]);
?>