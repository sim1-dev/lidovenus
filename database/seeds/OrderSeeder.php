<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
use App\Order;
use App\BeachUmbrella;
use App\Product;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //ORDINI LEGATI AD UN UTENTE:
    	$i=1;
    	foreach (range(1,5) as $index) {
    		DB::table('orders')->insert([
    			'id_products' => '{
                    "1": {
                        "id": 1,
                        "name": "Pizza_rossa",
                        "price": 1.5,
                        "quantity": 4,
                        "attributes": [],
                        "conditions": [],
                        "associatedModel": "Product"
                    }
                }',
                'delivered' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $order = Order::find($i);
            //utente ordine
            $user = User::find(2);
            $user->orders()->attach($order);
            //ordine ombrellone
            $umbrella = BeachUmbrella::find(1);
            $order->umbrellas()->attach($umbrella);

            //ordine prodotto
            $listaprodottinellordine = json_decode($order->id_products, true);
            foreach ($listaprodottinellordine as $key =>$value) {
                $prodottoid = Product::find($value['id']);
                $order->products()->attach($prodottoid,['quantity' => $value['quantity']]);
            }

            $i++;
        }
        unset($i);

        $i = 6;
        foreach (range(1,5) as $index) {
          DB::table('orders')->insert([
             'id_products' => '{
                "1": {
                    "id": 1,
                    "name": "Pizza_rossa",
                    "price": 1.5,
                    "quantity": 4,
                    "attributes": [],
                    "conditions": [],
                    "associatedModel": "Product"
                }
            }',
            'delivered' => 1,
            'created_at' => date('2019-03-22'),
            'updated_at' => date('2019-03-23')
        ]);
          $user = User::find(2);
          $order = Order::find($i);
          $user->orders()->attach($order);

          $umbrella = BeachUmbrella::find(1);
          $order->umbrellas()->attach($umbrella);

          //ordine prodotto
          $listaprodottinellordine = json_decode($order->id_products, true);
          foreach ($listaprodottinellordine as $key =>$value) {
            $prodottoid = Product::find($value['id']);
            $order->products()->attach($prodottoid,['quantity' => $value['quantity']]);
        }
        $i++;
    }
    unset($i);

      //qualche dato
      //$faker = Faker::create();
    $i=11;
    foreach (range(1,5) as $index) {
        DB::table('orders')->insert([
          'id_products' => '{
            "1": {
                "id": 1,
                "name": "Pizza_rossa",
                "price": 1.5,
                "quantity": 4,
                "attributes": [],
                "conditions": [],
                "associatedModel": "Product"
            }
        }',
        'delivered' => 0,
        'created_at' => now(),
        'updated_at' => null
    ]);

        $order = Order::find($i);
            //utente ordine
        $user = User::find(2);
        $user->orders()->attach($order);
            //ordine ombrellone
        $umbrella = BeachUmbrella::find(1);
        $order->umbrellas()->attach($umbrella);

            //ordine prodotto
        $listaprodottinellordine = json_decode($order->id_products, true);
        foreach ($listaprodottinellordine as $key =>$value) {
            $prodottoid = Product::find($value['id']);
            $order->products()->attach($prodottoid,['quantity' => $value['quantity']]);
        }

        $i++;
    }
    unset($i);



        $i=16;
        
            DB::table('orders')->insert([
              'id_products' => '{
                "1": {
                    "id": 1,
                    "name": "Pizza_rossa",
                    "price": 1.5,
                    "quantity": 4,
                    "attributes": [],
                    "conditions": [],
                    "associatedModel": "Product"
                }
            }',
            'delivered' => 1,
            'created_at' => now(),
            'updated_at' => null
        ]);

            $order = Order::find($i);
                //utente ordine
            $user = User::find(2);
            $user->orders()->attach($order);
                //ordine ombrellone
            $umbrella = BeachUmbrella::find(1);
            $order->umbrellas()->attach($umbrella);

                //ordine prodotto
            $listaprodottinellordine = json_decode($order->id_products, true);
            foreach ($listaprodottinellordine as $key =>$value) {
                $prodottoid = Product::find($value['id']);
                $order->products()->attach($prodottoid,['quantity' => $value['quantity']]);
            }

            
        
        unset($i);

    }
}
