<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'الدقهيله'],
            ['name' => 'القاهره'], 
            ['name' => 'دمياط'],
            ['name' => 'كفر الشيخ'],
            ['name' => 'سوهاج'],
            ['name' => 'الاقصر'], 
            ['name' => 'البحر الاحمر'],
            ['name' => 'الشرقيه'],
            ['name' => ' الغربيه'],
            ['name' => 'الوادي الجديد'], 
            ['name' => 'الفيوم'],
            ['name' => 'المنيا'],
            ['name' => 'أسوان'],
            ['name' => 'أسيوط'], 
            ['name' => 'بني سويف'],
            ['name' => 'قنا'],
            ['name' => 'شمال سينا'],
            ['name' => 'أسكندريا'],
            ['name' => 'بورسعيد'],

            //19 Add more countries as needed
        ];
        Country::insert($countries);

    }
}
