<?php

use Illuminate\Database\Seeder;

class UmbrellaSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
    	DB::table('beach_umbrellas')->insert([
    		'type' => 'normal umbrella'
    	]);

    	DB::table('beach_umbrellas')->insert([
    		'type' => 'big umbrella'
    	]);
    	
    	/*
    	
    	foreach (range(1,5) as $index) {
    		DB::table('beach_umbrellas')->insert([
    			'type' => 'normal umbrella'
    		]);
    	}

    	 */
    }
}
