<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDelete extends Model
{
    public function products()
    {
        return $this->belongsToMany('App\BeachUmbrella', 'orders_delete_products', 'id_order', 'id_product');
    }
}
