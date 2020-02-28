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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// add cities
Route::post('cities', 'CitiesController@add');

// add delivery times
Route::post('delivery-times', 'DeliveryTimesController@add');

// attach cities to delivery times
Route::post('cities/{city_id}/delivery-times', 'CityDeliveryTimesController@assign');

// exclude a delivery time
Route::post('cities/{city_id}/exclude', 'CityDeliveryTimesController@exclude');

// get available delivery times for a city and a time span
Route::get('cities/{city_id}/delivery-dates-times/{number_of_days}', 'DeliveryTimesController@deliveryDateTimes');