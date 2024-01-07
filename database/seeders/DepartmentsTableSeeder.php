<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'full stack'],
            ['name' => 'flutter'],
            ['name' => ' testing'],
            ['name' => 'HR'],
            ['name' => ' backend'],
            ['name' => 'front end'],
        ];

        // Insert data into the 'departments' table
        Department::insert($departments);
    
    }
}
