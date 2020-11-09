<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = \Illuminate\Support\Facades\File::get("database/data/districts.json");
        $data = json_decode($json);
        foreach ($data as $district) {
            District::updateOrCreate([
                'name' => $district->name,
                'state_id' => $district->state_id,
            ]);
        }
    }
}
