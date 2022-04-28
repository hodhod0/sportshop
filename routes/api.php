<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('categories')->group(function () {
  

    Route::get('/', [CategoryController::class, 'getCategory']);
    Route::get('/{id}', [CategoryController::class, 'getCategoryByID']);
    Route::post('/', [CategoryController::class, 'createCategory']);
    Route::delete('/{id}', [CategoryController::class, 'deleteCategory']);
    Route::post('/{id}', [CategoryController::class, 'updateCategory']);

});
Route::prefix('items')->group(function () {
   

    Route::get('/', [ItemController::class, 'getItem']);
    Route::get('/{id}', [ItemController::class, 'getItemByID']);
    Route::post('/', [ItemController::class, 'createItem']);
    Route::delete('/{id}', [ItemController::class, 'deleteItem']);
    Route::post('/{id}', [ItemController::class, 'updateItem']);

});
