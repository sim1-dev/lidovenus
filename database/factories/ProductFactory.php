<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    return [
		'name' => Str::random(10),
		'category' => 'Bevande',
		'price' => rand(1, 9999) / 100,
		'description' => Str::random(20),
		'quantitystock' => rand(1, 99),
		'brand' => 1,
		'created_at' => $faker->dateTime,
		'updated_at' => $faker->dateTime
	
    ];
});
/*
    DB::table('users')->insert([
        'name' => 'ciao',
        'surname'=>'Admin',
        'email'=>'ciccia@gmail.com',
        'address'=>'prova',
        'municipality'=>'prova',
        'cap'=>'prova',
        'is_admin'=>'0',
        'password'=> bcrypt('123456'),
        'idumbrella'=>'5'
    ]);
    */

