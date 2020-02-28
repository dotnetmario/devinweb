<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddDeliveryTimeRequest;

use App\DeliveryTime;

class DeliveryTimesController extends Controller
{
    public function add(AddDeliveryTimeRequest $request)
    {
        $request->validated();

        $d_time = (new DeliveryTime)->add($request->delivery_at);

        if(!empty($d_time)){
            return response()->json([
                'delivery_time' => $d_time,
                'message' => "Delivery time was successfully added",
            ], 201);
        }else{
            return response()->json([
                'message' => "Something went wrong!",
            ], 500);
        }
    }

    public function deliveryDateTimes(Request $request)
    {
        $city = $request->city_id;
        $days = $request->number_of_days;

        $dates = (new DeliveryTime)->availableDeliveryTimes($city, $days);

        return response()->json([
            'dates' => $dates,
            'message' => "Delivery time was successfully added",
        ], 201);
    }
}
