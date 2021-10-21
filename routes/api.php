<?php

use App\Http\Controllers\API\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
    // Route::get('test-data', function() {
    //     return 'Done';
    // });

    Route::apiResource('posts', PostController::class);
    Route::get('post/search', [PostController::class, 'search']);


    Route::get('token', [PostController::class, 'token']);

    Route::get('sanctum', [PostController::class, 'sanctum'])->middleware('auth:sanctum');
    // Route::get('sanctum', [PostController::class, 'sanctum']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
