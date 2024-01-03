<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    
    'namespace' => '\App\Containers\User\UI\WEB\Controllers',
], function () { // custom admin routes
    Route::crud('user', 'Controller');
}); // this should be the absolute last line of this file
