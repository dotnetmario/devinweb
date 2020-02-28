<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = "partners";

    protected $fillable = [
        'name', 'city_id',
    ];

    public function city()
    {
        return $this->belongsTo('App\City');
    }
}
