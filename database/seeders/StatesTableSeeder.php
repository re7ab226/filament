<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['county_id' => 1, 'name' => 'المنصوره'],
            ['county_id' => 1, 'name' => 'دكرنس'],
            ['county_id' => 1, 'name' => 'شيربين'],
            ['county_id' => 1, 'name' => 'أجا'],
            ['county_id' => 1, 'name' => 'ميت غمر'],
            ['county_id' => 2, 'name' => 'الهرم'],
            ['county_id' => 2, 'name' => 'مصر الجديده'],
            ['county_id' => 2, 'name' => 'المعادي'],
            ['county_id' => 4, 'name' => 'دسوق'],
            ['county_id' => 4, 'name' => 'مطوبس'],
            ['county_id' => 17, 'name' => 'العريش'],
            ['county_id' => 17, 'name' => 'رفح'],
            ['county_id' => 17, 'name' => 'نخل'],
            ['county_id' => 7, 'name' => 'الغردقه'],
        
            // Add more states as needed
        ];
        
        State::insert($states);

    }
}
