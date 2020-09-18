<?php

use Illuminate\Database\Seeder;
use App\Order;
use Illuminate\Support\Facades\DB;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(BrandSeeds::class);
        $this->call(UmbrellaSeeds::class);
        $this->call(UserSeed::class);
        $this->call(ProductSeeder::class);
        $this->call(OrderSeeder::class);
        //$product = factory(App\Product::class, 5)->create();
    }
}