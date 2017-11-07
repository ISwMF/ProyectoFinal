<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class report extends Model
{

  protected $table = 'reports';
  protected $primaryKey = 'id';
  protected $fillable =[
     'title', 'URL', 'description',
  ];
  public function user(){
    return $this->belongsTo('App\User', 'id_user');
  }
  public function comments(){
    return $this->hasMany('App\comment');
  }
  public function favorite(){
    return $this->belongsToMany('App\favorite');
  }
}
