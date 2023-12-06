<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\brand;
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand = brand::create([
           'name' => 'Aarong',
           'status' => 1,
        ]);
        
        $brand = brand::create([
           'name' => 'Cats Eye',
           'status' => 1,
        ]);
        
        $brand = brand::create([
           'name' => 'Dorjibari',
           'status' => 1,
        ]);
        
        $brand = brand::create([
           'name' => 'Richman',
           'status' => 1,
        ]);
        
        $brand = brand::create([
           'name' => 'Yellow',
           'status' => 1,
        ]);
    }
}
