<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $table = "cities";

    protected $fillable = [
        'name',
    ];

    /**
     * Relationships
     */

    public function partner()
    {
        return $this->hasOne('App\Partner', 'city_id');
    }

    public function deliveryTimes()
    {
        return $this->hasMany('App\CityDeliveryTime', 'city_id');
    }


    /**
     * CRUD
     */

    /**
     * add a city
     * 
     * @param string name
     * @return City
     */
    public function add($name)
    {
        return City::create([
            'name' => $name
        ]);
    }
}
