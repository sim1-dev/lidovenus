<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDelete extends Model
{
    //protected $table = 'comune';
    
    //N A N
    public function products()
    {                                                       //prima id classe                                     
        return $this->belongsToMany('App\BeachUmbrella', 'orders_delete_products', 'id_order', 'id_product');
    }
}
