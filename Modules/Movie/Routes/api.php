<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/movie', function (Request $request) {
    return $request->user();
});

Route::prefix('movies')->name('movies.')->group(function() {
    // List of movies
    Route::get('/list-of-movies',[\Modules\Movie\Http\Controllers\MovieController::class,'listMovies'])->name('listMovies');
});
