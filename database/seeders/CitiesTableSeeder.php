<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['state_id' => 1, 'name' => 'جديله'],
            ['state_id' => 1, 'name' => 'المحافظه'],
            ['state_id' => 14, 'name' => 'الكوثر'],
            ['state_id' => 14, 'name' => 'الهضبه'],
            ['state_id' => 10, 'name' => 'مينا مطوبس'],
            ['state_id' => 1, 'name' => 'السكه الجديده'],
            ['state_id' => 1, 'name' => 'العباسي'],
           
            // Add more cities as needed
        ];
        City::insert($cities);

    }

}
