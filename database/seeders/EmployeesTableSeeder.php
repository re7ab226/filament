<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'county_id' => 1,
                'state_id' => 1,
                'city-id' => 1,
                'department_id' => 1,
                'f-name' => 'John',
                'l-name' => 'Doe',
                'email' => 'john.doe@example.com',
                'date_birth' => '1990-01-01',
                'address' => '123 Main St',
            ],
                  [
                'county_id' => 2,
                'state_id' => 2,
                'city-id' => 2,
                'department_id' => 2,
                'f-name' => 'REhab',
                'l-name' => 'ossama',
                'email' => 'ossama@example.com',
                'date_birth' => '1980-01-01',
                'address' => '123 Main St',
            ],
                         [
                'county_id' => 2,
                'state_id' => 3,
                'city-id' => 2,
                'department_id' => 2,
                'f-name' => 'yousra',
                'l-name' => 'khattab',
                'email' => 'yousra@example.com',
                'date_birth' => '1999-11-11',
                'address' => '123 Main St',
            ],
        ];

     
        Employee::insert($employees);
    }
}
