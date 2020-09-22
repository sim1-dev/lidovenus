<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public function umbrellas()
    {
        return $this->belongsTo('App\BeachUmbrella');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'users_subscriptions', 'id_subsc', 'id_users');
    }
}
