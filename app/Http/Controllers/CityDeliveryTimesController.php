<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AssignCityDeliveryTimesRequest;
use App\Http\Requests\ExcludeDeliveryTimeRequest;

use App\CityDeliveryTime;
use App\ExcludeDeliveryTime;

class CityDeliveryTimesController extends Controller
{
    public function assign(AssignCityDeliveryTimesRequest $request)
    {
        $request->validated();

        $dls = $request->delivery_time;
        $city = $request->city_id;

        (new CityDeliveryTime)->assign($city, $dls);

        return response()->json([
            'message' => "Delivery times was successfully assigned",
        ], 201);
    }

    public function exclude(ExcludeDeliveryTimeRequest $request)
    {
        $request->validated();

        $city = $request->city_id;
        $d_time = $request->delivery_time;
        $date = $request->date;

        $ex_d_time = (new ExcludeDeliveryTime)->exclude($city, $d_time, $date);

        if(!empty($ex_d_time)){
            return response()->json([
                'exclude_delivery_time' => $ex_d_time,
                'message' => "Delivery time was excluded successfully",
            ], 201);
        }else{
            return response()->json([
                'message' => "Something went wrong!",
            ], 500);
        }
    }
}
