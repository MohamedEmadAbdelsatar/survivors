<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    public function admins(){
        return $this->hasMany('App/User');
    }
    public function balance(){
        return $this->hasOne('App/Blood');
    }
}
