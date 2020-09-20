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
    		'type' => 'Ombrellone piccolo (2 posti)'
    	]);

    	DB::table('beach_umbrellas')->insert([
    		'type' => 'Ombrellone grande (4 posti)'
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
