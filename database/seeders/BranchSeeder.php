<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;
class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branch = Branch::create([
           'name' => 'FACRORY SALES',
           'status' => 1,
        ]);
        
        $branch = Branch::create([
           'name' => 'SHOWROOM N.K.',
           'status' => 1,
        ]);
    }
}
