<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
<<<<<<< HEAD
    
    'namespace' => '\App\Containers\User\UI\WEB\Controllers',
], function () { // custom admin routes
    Route::crud('user', 'Controller');
}); // this should be the absolute last line of this file
=======

    'namespace' => '\App\Containers\Clients\UI\WEB\Controllers',
], function () { // custom admin routes
    Route::crud('clients', 'Controller');
}); // this should be the absolute last line of this file
>>>>>>> 9069c4e6cd22f4a76d4e61eb3afe450a52abb6e6
