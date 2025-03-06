<?php

use Illuminate\Support\Facades\Route;
use Modules\NewsFeed\Http\Controllers\NewsFeedController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function () {
    Route::resource('newsfeed', NewsFeedController::class)->names('newsfeed');
});
