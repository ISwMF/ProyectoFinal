<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class favorite extends Model
{
    protected $table = 'favorites';
    public function reports(){
      return $this->belongsToMany('App\report', 'id','id');
    }
    public function users(){
      return $this->belongsToMany('App\User', 'id','id');
    }
}
