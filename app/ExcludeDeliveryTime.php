<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExcludeDeliveryTime extends Model
{
    protected $table = "delivery_exclusion_dates";

    protected $fillable = [
        'city_id', 'delivery_time_id', 'date',
    ];


    /**
     * exclude a delivery time for a certain city
     * 
     * @param int city
     * @param int delivery_time
     * @param Date date
     * @return ExcludeDeliveryTime
     */
    public function exclude($city, $d_time, $date)
    {
        return ExcludeDeliveryTime::create([
            'city_id' => $city,
            'delivery_time_id' => $d_time,
            'date' => $date,
        ]);
    }
}
