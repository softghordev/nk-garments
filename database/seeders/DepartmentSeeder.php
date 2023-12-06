<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $department = Department::create([
           'name' => 'Yern Stock',
           'status' => 1,
        ]);
        
        $department = Department::create([
           'name' => 'Knitting',
           'status' => 1,
        ]);
        
        $department = Department::create([
           'name' => 'Cutting',
           'status' => 1,
        ]);
        
        $department = Department::create([
           'name' => 'Sewing',
           'status' => 1,
        ]);
        
        $department = Department::create([
           'name' => 'Iron & Packing',
           'status' => 1,
        ]);
        
        $department = Department::create([
           'name' => 'Factory Sales',
           'status' => 1,
        ]);
        
        $department = Department::create([
           'name' => 'Showroom N.K',
           'status' => 1,
        ]);
    }
}
