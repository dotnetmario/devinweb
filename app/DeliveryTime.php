<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class DeliveryTime extends Model
{
    protected $table = "delivery_times";

    protected $fillable = [
        'time',
    ];


    /**
     * CRUD
     */

    /**
     * add a delivery time
     * 
     * @param string delivery_at
     * @return DeliveryTime
     */
    public function add($delivery_at)
    {
        return DeliveryTime::create([
            'time' => $delivery_at
        ]);
    }


    /**
     * get available delivery times for a city in a span of days
     * 
     * @param int city
     * @param int days
     * @return Collection delivery times
     */
    public function availableDeliveryTimes($city, $days)
    {
        // get the range of dates
        $rng = $this->getAllDates(Carbon::now(), Carbon::now()->add($days - 1, 'day'));
        // get the excluded days of a city (not including periods only full days)
        $excl = $this->getExcludedDates($city);

        // filter the excluded days from the range of dates
        $range = array_filter($rng, function($v) use ($excl) {
                    return !in_array($v, $excl);
                });

        $dates = [];

        foreach($range as $r){
            $day_name = Carbon::parse($r)->englishDayOfWeek;
            $d = DeliveryTime::whereNotIn('delivery_times.id', function($query) use($city, $r){
                            $query->select('delivery_times.id')
                                    ->from('delivery_times')
                                    ->join('delivery_exclusion_dates', 'delivery_times.id', 'delivery_exclusion_dates.delivery_time_id')
                                    ->where('delivery_exclusion_dates.city_id', $city)
                                    ->where('delivery_exclusion_dates.date', $r)
                                    ->where('delivery_exclusion_dates.delivery_time_id', '!=', null);
                        })
                        ->join('city_delivery_times', 'delivery_times.id', 'city_delivery_times.delivery_time_id')
                        ->where('city_delivery_times.city_id', $city)
                        ->select("delivery_times.id", "delivery_times.time", "delivery_times.created_at", "delivery_times.updated_at")
                        ->get();

            $object = new \stdClass();
            $object->day_name = $day_name;
            $object->date = $r;
            $object->delivery_times = $d;

            $dates[] = $object;
        }

        return $dates;
    }


    /**
     * gets all the dates between two dates
     * 
     * @param Carbon from
     * @param Carbon to
     * @return array
     */
    public function getAllDates($from, $to)
    {
        $dates = [];

        for($d = $from; $d->lte($to); $d->addDay()) {
            $dates[] = $d->format('Y-m-d');
        }

        return $dates;
    }


    /**
     * get excluded dates of a city as an array
     * 
     * @param int city
     * @return array
     */
    public function getExcludedDates($city)
    {
        $excl = DB::table('delivery_exclusion_dates')->where([
            ['city_id', $city],
            ['delivery_time_id', null],
        ])->select('date')->get();

        $e = [];

        foreach($excl as $ex){
            $e[] = $ex->date;
        }

        return $e;
    }
}
