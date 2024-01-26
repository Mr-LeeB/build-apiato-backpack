<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('custom.base.route_prefix', 'admin'),
    'namespace' => '\App\Ship\CustomContainer\Controllers',
    'middleware' => ['web'],
], function () { // custom admin routes
    Route::get('dashboard', 'AdminController@dashboard')->name('custom.dashboard');
}); // this should be the absolute last line of this file
