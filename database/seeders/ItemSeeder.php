<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\items;
use App\Models\ItemColor;
use App\Models\ItemSize;
use App\Models\ItemVariation;
class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
      
            $item= items::create([
            'type' =>$faker->randomElement(['Regular', 'Wastase']),
            'name' =>"Product",
            'weight' =>$faker->randomElement(['100 gm', '200 gm','300 gm', '400 gm', '500 gm']),
            'count' =>$faker->randomFloat(100, 500),
            'brand' =>$faker->randomElement(['Aarong', 'Cats Eye','Dorjibari', 'Richman', 'Yellow']),
            'single_dye' => $faker->word,
            'double_dye' => $faker->word,
            'wash' => $faker->word,
            'roll' => $faker->word,
            'finished' => $faker->word,
            'gsm' => $faker->word,
            'source' => $faker->word,
            'cone' => $faker->word,
            'production_type' => $faker->word,
            'csp' => $faker->word,
            'twist' => $faker->word,
            'image' =>'asset/placeholder_190x140c.png',
            'unit_price' => $faker->numberBetween(400, 500),
            'unit_price_for_salary' => $faker->numberBetween(500, 1000),
            'main_unit_id' => 2,
            'sub_unit_id' => 1,
            // 'stock' => 0,
            // 'main_unit_stock' => 0,
            // 'sub_unit_stock' => 0,
            'show_variation' =>0,
            'note' => $faker->sentence,
        ]);

        $item_size= ItemSize::create([
            'item_id' =>1,
            'size' => "X",
        ]);

        $item_size= ItemSize::create([
            'item_id' =>1,
            'size' => "L",
        ]);

        $item_color= ItemColor::create([
            'item_id' =>1,
            'color' => "Red",
        ]);

        $item_color= ItemColor::create([
            'item_id' =>1,
            'color' => "Black",
        ]);

        $item_color= ItemColor::create([
            'item_id' =>1,
            'color' => "Blue",
        ]);

        $item_variation= ItemVariation::create([
            'item_id' =>1,
            'item_size_id' => 1,
            'item_color_id' => 1,
        ]);

        $item_variation= ItemVariation::create([
            'item_id' =>1,
            'item_size_id' => 1,
            'item_color_id' => 2,
        ]);

        $item_variation= ItemVariation::create([
            'item_id' =>1,
            'item_size_id' => 1,
            'item_color_id' => 3,
        ]);

        $item_variation= ItemVariation::create([
            'item_id' =>1,
            'item_size_id' => 2,
            'item_color_id' => 1,
        ]);

        $item_variation= ItemVariation::create([
            'item_id' =>1,
            'item_size_id' => 2,
            'item_color_id' => 2,
        ]);

        $item_variation= ItemVariation::create([
            'item_id' =>1,
            'item_size_id' => 2,
            'item_color_id' => 3,
        ]);
        
     
    }
}
