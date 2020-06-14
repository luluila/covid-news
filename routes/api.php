<?php

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
});

//enduser
Route::post('/enduser/register','EndUserController@register');
Route::post('/enduser/getbyid','EndUserController@show');
Route::post('/enduser/login','EndUserController@login');
Route::post('/enduser/logout','EndUserController@logout');

//category news
Route::post('/category-news/create','CategoryNewsController@store');
Route::post('/category-news/getall','CategoryNewsController@getAll');
Route::post('/category-news/getbyname','CategoryNewsController@getbyname');
Route::post('/category-news/getbyid','CategoryNewsController@getbyid');
Route::post('/category-news/delete','CategoryNewsController@destroy');

//categorysuffer
Route::post('/category-suffer/getbyid','CategorySufferController@getbyid');
Route::post('/category-suffer/getbyname','CategorySufferController@getbyname');
Route::post('/category-suffer/getall','CategorySufferController@getall');
Route::post('/category-suffer/create','CategorySufferController@store');
Route::post('/category-suffer/update','CategorySufferController@update');
Route::post('/category-suffer/delete','CategorySufferController@destroy');

//region
Route::post('/region/getbyid','RegionController@getbyid');
Route::post('/region/getbyname','RegionController@getbyname');
Route::post('/region/getall','RegionController@getall');
Route::post('/region/create','RegionController@store');
Route::post('/region/update','RegionController@update');
Route::post('/region/delete','RegionController@destroy');

//news
Route::post('/news/create','NewsController@store');
Route::post('/news/getbytitle','NewsController@getbytitle');
Route::post('/news/getbyid','NewsController@getbyid');
Route::post('/news/trending','NewsController@gettrending');
Route::post('/news/popular','NewsController@getpopularnews');
Route::post('/news/latest','NewsController@getlatestnews');
Route::post('/news/foryou','NewsController@getforuser');

//getbydate
Route::post('/graphic-info/daily','GraphicInfoController@getbydate');
Route::post('/graphic-info/total','GraphicInfoController@getallinfo');
Route::post('/graphic-info/total-by-region','GraphicInfoController@getinfobyregion');
Route::post('/graphic-info/create','GraphicInfoController@store');
Route::post('/graphic-info/update','GraphicInfoController@update');
Route::post('/graphic-info/delete','GraphicInfoController@delete');




