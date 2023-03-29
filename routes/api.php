<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ArticleController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [RegisterController::class, 'login']);

//protected routes
Route::group(['middleware'=>['auth:sanctum']], function(){

    Route::post('/logout', [RegisterController::class, 'logout']);
    Route::put('/updateUser/{id}', [RegisterController::class, 'updateUser']);

    Route::post('/StoreArticle', [ArticleController::class, 'StoreArticle']);
    Route::get('/getArticle/{id}', [ArticleController::class, 'getArticle']);
    Route::get('/getArticleDetail/{detail_fld}', [ArticleController::class, 'getArticleDetail']);
    Route::put('/updateArticle/{id}', [ArticleController::class, 'updateArticle']);
    Route::delete('/delArticle/{id}', [ArticleController::class, 'delArticle']);
});
