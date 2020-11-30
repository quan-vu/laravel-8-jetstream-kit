<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\PostAPIController;

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

Route::prefix('v1')->name('api.')->group(function () {
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::group([ 'prefix' => 'posts'], function () {
        Route::get('/', [PostAPIController::class, 'index'])->name('posts.list');    
    });
});


// Route::group([ 'namespace' => 'API', 'prefix' => '/api/v1', 'middleware' => ['auth:sanctum'] ], function () {
    
// });



