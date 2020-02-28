<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddCityRequest;

use App\City;

class CitiesController extends Controller
{
    public function add(AddCityRequest $request)
    {
        $request->validated();

        $city = (new City)->add($request->name);

        if(!empty($city)){
            return response()->json([
                'city' => $city,
                'message' => "City was successfully added",
            ], 201);
        }else{
            return response()->json([
                'message' => "Something went wrong!",
            ], 500);
        }
    }
}
