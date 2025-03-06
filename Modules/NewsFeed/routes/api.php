<?php

use Illuminate\Support\Facades\Route;
use Modules\NewsFeed\Http\Controllers\NewsFeedController;
use Modules\NewsFeed\Http\Controllers\PostController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

// Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
//    Route::apiResource('newsfeed', NewsFeedController::class)->names('newsfeed');
// });

Route::apiResource('posts', PostController::class)->names('posts');
