<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function products()
    {
        return $this->belongsToMany('App\Product', 'orders_products', 'id_order', 'id_product');
    }

    //N A N
    public function users()
    {
        return $this->belongsToMany('App\User', 'orders_users', 'id_order', 'id_user');
    }

    //N A N
    public function umbrellas()
    {
        return $this->belongsToMany('App\BeachUmbrella', 'orders_umbrellas', 'id_order', 'id_umbrella');
    }



}
