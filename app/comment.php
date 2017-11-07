<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_user', 'id_new', 'points', 'created_at', 'updated_at',
    ];
    public function user(){
      return $this->belongsTo('App\User', 'id','id');
    }
    public function report(){
      return $this->belongsTo('App\report', 'id','id');
    }

  }
