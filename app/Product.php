<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','description','price','quantitystock'];
    //N A 1
    public function brands()
    {
        return $this->belongsTo('App\Brand');//1
        
    }

    //N A N
    public function orders()
    {
    //nomet,idprima,idseconda                                                                 
        return $this->belongsToMany('App\Order', 'orders_products', 'id_product', 'id_order');
    }

    //N A N
    public function ordersdelete()
    {
    //prima id classe                                     
        return $this->belongsToMany('App\OrderDelete', 'orders_delete_products', 'id_product', 'id_order');
    }
} 
