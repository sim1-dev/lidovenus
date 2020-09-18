<?php

use Illuminate\Database\Seeder;

class BrandSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
        'name' => 'Uliveto',
        'address' => 'non ne ho idea',
        'description' => 'acqua buonissima',
        'image' => 'store.png',
        ]);

        DB::table('brands')->insert([
        'name' => 'Dalla casa',
        'address' => 'via dello stabilimento',
        'description' => 'con amore',
        'image' => 'store.png',
        ]);

    }
}
