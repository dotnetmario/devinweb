<?php

use Illuminate\Database\Seeder;
use App\Partner;
use App\City;

class PartnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Partner::insert([
            ['name' => 'Mohamed', 'city_id' => City::where('name', 'Rabat')->first()->id, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'Hassan', 'city_id' => City::where('name', 'Casa')->first()->id, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'Nada', 'city_id' => City::where('name', 'Tangier')->first()->id, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        ]);
    }
}
