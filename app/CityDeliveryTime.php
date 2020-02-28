<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityDeliveryTime extends Model
{
    protected $table = "city_delivery_times";

    protected $fillable = [
        'city_id', 'delivery_time_id',
    ];


    public function city()
    {
        return $this->belongsTo('App\City', 'city_id');
    }


    /**
     * 
     * CRUD
     */

    /**
     * assign delivery times to a city
     * 
     * @param int city
     * @param array delivery_times
     * @return void
     */
    public function assign($city, $d_time)
    {
        foreach($d_time as $dt){
            CityDeliveryTime::create([
                'city_id' => $city,
                'delivery_time_id' => $dt,
            ]);
        }
    }
}
