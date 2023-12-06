<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Party;
class PartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            // Party 
           $party = Party::create([
                'party_type' => $faker->randomElement(['Purchase Party', 'Sales Party','Third Party Production']),
                'party_name' => $faker->name,
                'company_name' => $faker->company,
                'owner_name' => $faker->name,
                'company_address' => $faker->address,
                'email' => $faker->email,
                'web_page' => $faker->url,
                'business_phone' => $faker->phoneNumber,
                'home_phone' => $faker->phoneNumber,
                'phone' => $faker->phoneNumber,
                'country' => $faker->country,
                'party_bank_details' => $faker->text,
                'image'   => 'asset/placeholder_190x140c.png',
                'registration_date' => $faker->date,
                'note' => $faker->sentence,
            ]);
        }
    }
}
