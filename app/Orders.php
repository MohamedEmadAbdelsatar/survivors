<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    public function hospital()
    {
        return $this->belongsTo('App/Hospital');
    }

    public function admin()
    {
        return $this->belongsRo('App/User');
    }
}
