<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //N A N
    //php artisan make:migration create_orders_users_table --create=orders_users
    public function products()
    {                                   //nomet,idprima,idseconda                                                                 
        return $this->belongsToMany('App\Product', 'orders_products', 'id_order', 'id_product');
    }

    //N A N
    public function users()
    {                                                       //prima id classe                                     
        return $this->belongsToMany('App\User', 'orders_users', 'id_order', 'id_user');
    }

    //N A N
    public function umbrellas()
    {                                                       //prima id classe                                     
        return $this->belongsToMany('App\BeachUmbrella', 'orders_umbrellas', 'id_order', 'id_umbrella');
    }

    
    
}
