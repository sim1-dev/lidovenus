<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BeachUmbrella extends Model
{
    public function orders()
    {                                                       
                                                //prima id classe                                     
        return $this->belongsToMany('App\Order', 'orders_umbrellas', 'id_umbrella', 'id_order');
    }

    public function subscription()
    {
        return $this->hasMany('App\Subscription');

        
    }

}
