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
        'name' => 'Algida',
        'address' => 'via di prova 51',
        'description' => 'ennesima marca di gelati',
        'image' => 'algida.png',
        ]);

        DB::table('brands')->insert([
        'name' => 'KM 0',
        'address' => 'via di test 123',
        'description' => 'prodotti della casa',
        'image' => 'handmade.png',
        ]);

    }
}
