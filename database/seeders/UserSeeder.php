<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
           'name' => 'Admin',
           'email' => 'admin@softghor.com',
           'password' => bcrypt('admin')
       ]);

       $user->assignRole('admin');


       $user = User::create([
            'name' => 'Test-Admin',
            'email' => 'test@softghor.com',
            'password' => bcrypt('softghor1212')
        ]);

        $user->assignRole('admin');

        $operator = User::create([
            'name' => 'Operator',
            'email' => 'operator@softghor.com',
            'password' => bcrypt('operator'),
            'department_id' =>1
        ]);
 
        $operator->assignRole('operator');

    }
}
