<?php

use App\Http\Controllers\ProductController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
}
);

Route::post('addProduct', 'ProductController@store');
Route::get('showProducts/{filterName}', 'ProductController@show');
Route::get('showProduct/{id}', 'ProductController@showProduct');
Route::post('updateProduct/{id}', 'ProductController@update');
Route::get('deleteProduct/{id}', 'ProductController@destroy');

Route::post('addCategorie', 'CategorieController@store');
Route::get('showCategories', 'CategorieController@show');
Route::post('addSubCategorie', 'CategorieController@addSubCategorie');
Route::get('showSubCategorie/{id}', 'CategorieController@showSubCategorie');
Route::get('showCategorie/{id}', 'CategorieController@showCategorie');


