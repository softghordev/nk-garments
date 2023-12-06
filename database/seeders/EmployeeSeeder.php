<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Employee;
class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            // Employee 
            $employee = Employee::create([
                'employee_name'    => $faker->name,
                'department_id'    => $faker->numberBetween(1,7),
                'designation'      => $faker->jobTitle,
                'employee_type'    => $faker->randomElement(["Production", "Salary"]),
                'join_date'        => $faker->date,
                'phone'            => $faker->phoneNumber,
                'email'            => $faker->email,
                'image'            => 'asset/placeholder_190x140c.png',
                'current_address'  => $faker->address,
                'note'             => $faker->sentence,
            ]);

            // Employee Personal Information
            $employee->personal()->create([
                'fathers_name'      => $faker->name,
                'mothers_name'      => $faker->name,
                'spouse_name'       => $faker->name,
                'date_of_birth'     => $faker->date,
                'nid'               => $faker->unique()->randomNumber(9),
                'blood_group'       => $faker->randomElement(['A+', 'B+', 'AB+', 'O+', 'A-', 'B-', 'AB-', 'O-']),
                'permanent_address' => $faker->address,
                'emergency_contact' => $faker->phoneNumber,
            ]);

            // Employee Educational Information
            $employee->educational()->create([
                'educational_qualification'  => $faker->randomElement(["Bachelor's", "Master's", "PhD"]),
                'educational_details'        => $faker->sentence,
                'training'                   => $faker->sentence,
                'experience'                 => $faker->sentence,
            ]);

            // Employee Salary Information
            $employee->salary()->create([
                'basic_salary'            => $faker->numberBetween(3000, 8000),
                'house_rent'              => $faker->numberBetween(500, 2000),
                'medical_allowance'       => $faker->numberBetween(100, 500),
                'child_allowance'         => $faker->numberBetween(100, 200),
                'communication_allowance' => $faker->numberBetween(500, 1000),
                'special_allowance'       => $faker->numberBetween(1000, 5000),
                'lta'                     => $faker->numberBetween(500, 1000),
                'bonus'                   => $faker->numberBetween(1000, 5000),
                'total_salary'            => $faker->numberBetween(30000, 50000), 
            ]);
        }
    }
}
