<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Subscription;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = [
    		[
    			'name'=>'Admin',
                'surname'=>'Admin',
    			'email'=>'simonetenisci10@gmail.com',
                'address'=>'adminaddress',
                'municipality'=>'adminmunicipality',
                'cap'=>'admincap',
    			'is_admin'=>'1',
    			'password'=> bcrypt('123456'),
    		],

    		[
    			'name'=>'Mario',
                'surname'=>'Rossi',
    			'email'=>'simone.tenisci@hotmail.it',
                'address'=>'prova',
                'municipality'=>'prova',
                'cap'=>'prova',
    			'is_admin'=>'0',
                //'idumbrella'=>'1',
    			'password'=> bcrypt('123456'),
    		],

            [
                'name'=>'luigi',
                'surname'=>'bianchi',
                'email'=>'luigibianchi@gmail.com',
                'address'=>'prova',
                'municipality'=>'prova',
                'cap'=>'prova',
                'is_admin'=>'0',
                //'idumbrella'=>'2',
                'password'=> bcrypt('123456'),
            ],


    	];

    	foreach ($user as $key => $value) {

    		User::create($value);

    	}
            $user = User::find(2);

            $sub = new Subscription;
            $sub->idumbrella = 1;
            $sub->from = date("2020.07.10");
            $sub->to = date("Y.m.d");
            $sub->save();

            $subscri = Subscription::find(1);
            $user->subscriptions()->attach($subscri);



            $user = User::find(3);

            $sub = new Subscription;
            $sub->idumbrella = 1;
            $sub->from = date("2020.09.12");
            $sub->to = date("2020.09.22");
            $sub->save();

            $subscri = Subscription::find(2);
            $user->subscriptions()->attach($subscri);


    }
}
