<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','description','price','quantitystock'];
    public function brands()
    {
        return $this->belongsTo('App\Brand');

    }

    public function orders()
    {
        return $this->belongsToMany('App\Order', 'orders_products', 'id_product', 'id_order');
    }

    public function ordersdelete()
    {
        return $this->belongsToMany('App\OrderDelete', 'orders_delete_products', 'id_product', 'id_order');
    }
}
