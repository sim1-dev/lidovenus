<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	//PRODOTTI:
        //rand(1, 99)

    	DB::table('products')->insert([
    		'name' => 'Pizza_rossa',
    		'category' => 'Pizzas',
    		'price' => 1.50,
    		'description' => 'una bella pizza',
    		'quantitystock' => 45,
    		'brand' => 2,
    		'created_at' => date('2019-03-22')
    	]);


    	$faker = Faker::create();
    	foreach (range(0,1) as $index) {
    		DB::table('products')->insert([
    			'name' => Str::random(10),
    			'category' => 'Ice creams',
    			'price' => rand(1, 9999) / 100,
    			'description' => Str::random(20),
    			'quantitystock' => 100,
    			'brand' => 1,
    			'created_at' => $faker->dateTime,
    			'updated_at' => $faker->dateTime
    		]);
    	}


    	foreach (range(1,2) as $index) {
    		DB::table('products')->insert([
    			'name' => Str::random(10),
    			'category' => 'Drinks',
    			'price' => rand(1, 9999) / 100,
    			'description' => Str::random(20),
    			'quantitystock' => 100,
    			'brand' => 1,
    			'created_at' => $faker->dateTime,
    			'updated_at' => $faker->dateTime
    		]);
    	}

    	foreach (range(1,2) as $index) {
    		DB::table('products')->insert([
    			'name' => Str::random(10),
    			'category' => 'Pizzas',
    			'price' => rand(1, 9999) / 100,
    			'description' => Str::random(20),
    			'quantitystock' => 100,
    			'brand' => 1,
    			'created_at' => $faker->dateTime,
    			'updated_at' => $faker->dateTime
    		]);
    	}

    	foreach (range(1,7) as $index) {
    		DB::table('products')->insert([
    			'name' => Str::random(10),
    			'category' => 'Desk',
    			'price' => rand(1, 9999) / 100,
    			'description' => Str::random(20),
    			'quantitystock' => 100,
    			'brand' => 1,
    			'created_at' => $faker->dateTime,
    			'updated_at' => $faker->dateTime
    		]);
    	}

        


    }
}
