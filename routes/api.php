<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('product', ProductController::class);

Route::get('product-history-list/{id}', [ProductController::class, "getHistoryListById"]);
Route::get('product-history-list', [ProductController::class, "getHistoryList"]);

Route::any('{url}', function () {
    return response()->json(['success' => false, 'message' => "API route not found"], 404);
})->where('url', '.*');
